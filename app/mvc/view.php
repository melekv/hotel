<?php

abstract class View {
    protected $model;

    protected function topPic() {
        $result = '';

        $result = '
            <div id="top-pic">
                <div class="top-cover-bg">
                    <p>Welcome to our hotel!</p>
                    <p>Home > ' .$this->getTitle(). '</p>
                </div>
            </div>
        ';

        return $result;
    }

    abstract public function getTitle();
    abstract public function output($var = []);
}

class HomeView extends View {
    
    public function getTitle() {
        return 'Hotel | Home';
    }

    public function output($model = null) {
        $result = '';

        include(PATH_TEMPLATE . 'home.php');

        return $result;
    }
}

class AboutView extends View {
    
    public function getTitle() {
        return 'About';
    }

    public function output($var = []) {
        $result = '';

        include(PATH_TEMPLATE . 'about.php');

        return $result;
    }
}

class ContactView extends View {
    
    public function getTitle() {
        return 'Contact';
    }

    public function output($var = []) {
        $result = '';

        include(PATH_TEMPLATE . 'contact.php');

        return $result;
    }
}

class RoomsView extends View {
    
    public function getTitle() {
        return 'Rooms';
    }

    public function output($model = null) {
        $result = '';
        $btnVisible = '';

        $result = $this->topPic();

        $rooms = $model->getRecord();

        if (count($rooms) == 0) {
            $result .= $this->addRoomAvailabilityInfo();
        }

        if ($model->getReservationCheck() == false) $btnVisible = 'btnDisplay';

        include(PATH_TEMPLATE . 'rooms.php');

        return $result;
    }

    private function addRoomAvailabilityInfo() : string {
        if (isset($_SESSION['period_from']) && isset($_SESSION['period_to'])){
            return '
                <div class="info-box">
                    <p>No rooms available between ' .$_SESSION['period_from']. ' and ' .$_SESSION['period_to']. '.</p>
                    <p><a href="/">New search</a></p>
                </div>
            ';
        }
    }
}

class BookingView extends View {
    public function getTitle() {
        return 'Booking';
    }

    public function output($model = null) {
        $result = '';
        $selectAdult = '';
        $selectChildren = '';

        for ($i=1; $i<=5; $i++) {
            if ($_SESSION['adult'] == $i) {
                $selectAdult .= '
                    <option value="' .$i. '" selected="selected">' .$i. '</option>
                ';
            } else {
                $selectAdult .= '
                    <option value="' .$i. '">' .$i. '</option>
                ';
            }
        }

        for ($i=0; $i<5; $i++) {
            if ($_SESSION['children'] == $i) {
                $selectChildren .= '
                    <option value="' .$i. '" selected="selected">' .$i. '</option>
                ';
            } else {
                $selectChildren .= '
                    <option value="' .$i. '">' .$i. '</option>
                ';
            }
        }

        $result = $this->topPic();

        $result .= '
            <div class="center50 center-text">Booking for room ' .$model->getRecord()['id']. '</div>
            <form id="guest-form" action="/booking/savebooking/' .$model->getRecord()['id']. '" method="POST" class="center50">
                <div class="container-flex-center">
                    <div class="margin">
                        <p>First name:</p><input type="text" name="fname" />
                        <p>Last name:</p><input type="text" name="lname" />
                        <p>Email:</p><input type="email" name="email" />
                    </div>
                    <div class="margin">
                        <p>Check in:</p><input type="date" name="check-in" value="' .$_SESSION['period_from']. '" />
                        <p>Check out:</p><input type="date" name="check-out" value="' .$_SESSION['period_to']. '" />
                        <div class="c-flex-center-start">
                            <div>
                                <p>Adult:</p>
                                <select name="adult-select" id="adult-select">
                                    ' .$selectAdult. '
                                </select>
                            </div>
                            <div>
                                <p>Children:</p>
                                <select name="children-select" id="children-select">
                                    ' .$selectChildren. '
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn center">Send</button>
            </form>
        ';

        if ($model->getSavedBooking()) $result .= $this->savedBookingInfo();

        return $result;
    }

    private function savedBookingInfo() {
        return '
            <div>Booking saved!</div>
        ';
    }
}

?>