<?php

abstract class Controller {
    protected $model;

    // function __construct($model) {
    //     $this->model = $model;
    // }

    abstract protected function index($params = []);
}

class HomeController extends Controller {
    public function index($params = []) {
        return null;
    }
}

class AboutController extends Controller {
    public function index($params = []) {
        return null;
    }
}

class ContactController extends Controller {
    public function index($params = []) {
        return null;
    }
}

class RoomsController extends Controller {
    public function index($params = []) : RoomsModel {
        $this->model = new RoomsModel();
        return $this->model->selectAllRooms();
    }

    public function check($params = []) : RoomsModel {

        // init model
        $this->model = new RoomsModel();

        $period_from = $_POST['check-in'];
        $period_to = $_POST['check-out'];

        $adultCount = $_POST['adult-select'];
        $childrenCount = $_POST['children-select'];

        $roomCount = $_POST['room-select'];

        // last search
        $_SESSION['period_from'] = $period_from;
        $_SESSION['period_to'] = $period_to;
        $_SESSION['adult'] = $adultCount;
        $_SESSION['children'] = $childrenCount;

        return $this->model->checkReservation($period_from, $period_to, $adultCount, $childrenCount);
    }
}

class BookingController extends Controller {
    public function index($params = []) : Model { return null; }

    public function addBooking($params = []) {
        $this->model = new BookingModel();
        return $this->model->selectOneRoom($params[0]);
    }

    public function saveBooking($params = []) {
        $this->model = new BookingModel();

        // guest info array
        $guest['firstName'] = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
        $guest['lastName'] = filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
        $guest['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

        // room info array
        $room['id'] = $params[0];
        $room['from'] = $_POST['check-in'];
        $room['to'] = $_POST['check-out'];
        $room['adult'] = $_POST['adult-select'];
        $room['children'] = $_POST['children-select'];

        return $this->model->saveBooking($guest, $room);
    }
}

?>