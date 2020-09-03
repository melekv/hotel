<?php

class Model {
    protected $pdo = null;
    protected $errors = [];
    protected $record = [];

    function __construct($record = [], $errors = []) {

        $this->record = $record;
        $this->errors = $errors;

        try {
            $this->pdo = new PDO('mysql:host=' .SERVERNAME. ';dbname=' .DBNAME, USERNAME, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->errors[] = 'PDO connection failed: ' . $e->getMessage();
        }
    }

    public function selectAllRooms() : RoomsModel {
        $sql = "SELECT * FROM rooms ";

        try {
            // return new updated Model
            $result = $this->pdo->query($sql)->fetchAll();
            return new RoomsModel($result);
        } catch(PDOException $e) {
            // return empty Model with error array
            $error = 'Fetch All Error : ' . $e->getMessage();
            return new RoomsModel($this->record, $error);
        }
    }

    public function getRecord() : array {
        return $this->record;
    }

    public function getErrors() {
        return $this->errors;
    }
}

// class HomeModel extends Model { }

// class AboutModel extends Model { }

// class ContactModel extends Model { }

class RoomsModel extends Model {
    private $reservationCheck = false;

    function __construct($record = [], $errors = [], $reservationCheck = false) {
        parent::__construct($record, $errors);
        $this->reservationCheck = $reservationCheck;
    }

    public function checkReservation($period_from, $period_to, $adult, $children) : self {

        $condition = "
            WHERE id NOT IN (
                SELECT room_id
                FROM reservation
                WHERE ('$period_from' BETWEEN period_from AND period_to)
                AND ('$period_to' BETWEEN period_from AND period_to)
            )
            AND capacity >= '$adult' + '$children'
        ";

        return $this->selectRooms($condition);
    }

    public function selectRooms($condition) : self {
        $sql = "SELECT * FROM rooms " . $condition;

        try {
            // return new updated Model
            $result = $this->pdo->query($sql)->fetchAll();
            $check = true;
            return new self($result, $this->errors, $check);

        } catch(PDOException $e) {
            // return empty Model with error array
            $error = 'Fetch All Error : ' . $e->getMessage();
            return new self($this->record, $error);
        }
    }

    public function getReservationCheck() {
        return $this->reservationCheck;
    }
}

class BookingModel extends Model {

    private $savedBooking = false;

    function __construct($record = [], $errors = [], $savedBooking = false) {
        parent::__construct($record, $errors);
        $this->savedBooking = $savedBooking;
    }
    
    public function selectOneRoom($roomID) {
        $sql = "SELECT id FROM rooms WHERE id=?";

        try {
            // return new updated Model
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$roomID]);
            $result = $stmt->fetch();
            return new self($result);
        } catch(PDOException $e) {
            // return empty Model with error array
            $error = 'Fetch All Error : ' . $e->getMessage();
            return new self($this->record, $error);
        }
    }

    public function saveBooking($guest, $room) {
        // commented -> no new records added to DB
        // if ($this->saveRoom($room) && $this->saveGuest($guest)) {
            $saved = true;
            $result = $this->getLastReservation();
            return new self($result, $this->errors, $saved);
        // }
    }

    private function saveRoom($room) {

        $sql = "INSERT INTO reservation (room_id, guest_id, period_from, period_to) VALUES (?, ?, ?, ?)";
        try {
            $this->pdo->prepare($sql)->execute([$room['id'], ($this->getLastID('guests') + 1), $room['from'], $room['to']]);
            return true;
        } catch (PDOException $e) {
            $this->errors[] = 'Insert error [reservation]: ' . $e->getMessage();
            return false;
        }
    }

    private function saveGuest($guest) {

        $name = $guest['firstName'] . ' ' . $guest['lastName'];
        $sql = "INSERT INTO guests (name, email, reservation_id) VALUES (?, ?, ?)";
        try {
            $this->pdo->prepare($sql)->execute([$name, $guest['email'], $this->getLastID('reservation')]);
            return true;
        } catch (PDOException $e) {
            $this->errors[] = 'Insert error [guests]: ' . $e->getMessage();
            return false;
        }
    }

    private function getLastID($tableName) {
        $sql = "SELECT MAX(id) as lastInsert FROM $tableName";
        $result = $this->pdo->query($sql)->fetch();
        if (empty($result['lastInsert'])) $result['lastInsert'] = 0;

        return $result['lastInsert'];
    }

    private function getLastReservation() : array {
        $sql = "SELECT * FROM reservation ORDER BY id DESC LIMIT 1";
        return $this->pdo->query($sql)->fetch();
    }

    public function getSavedBooking() {
        return $this->savedBooking;
    }
}

?>