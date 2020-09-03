<?php
foreach ($rooms as $room) {
    $result .= '
        <section class="container-grid-rooms center60 margin-top-bottom">
            <div class="grid-pic">
                <img class="image-fit" src="' .PATH_IMG. '' .$room['image'].  '" alt="">
            </div>
            <div class="grid-title">
                <h1>' .$room['name']. '</h1>
                <p><span class="text-important">' .$room['price']. ' zł</span> / noc</p>
            </div>
            <div class="grid-button">
                <a href="/booking/addbooking/' .$room['id']. '" class="btn btnAnchor ' .$btnVisible. '">Book!</a>
            </div>
            <div class="grid-info1">
                <h3>Size:</h3> 
                <p>' .$room['size']. 'm<sup>2</sup></p>
                <h3>Capacity:</h3>
                <p>' .$room['capacity']. '</p>
                <h3>Beds:</h3>
                <p>' .$room['beds']. '</p>
            </div>
            <div class="grid-info2">
                <h3>Services:</h3>
                <p>' .$room['services']. '</p>
            </div>
        </section>
    ';
}
?>