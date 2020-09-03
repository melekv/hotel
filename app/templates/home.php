<?php
$result .= '
    <div id="welcome-pic">
        <div class="cover-bg">
            <p>Welcome to our hotel!</p>
        </div>
    </div>

    <form method="POST" action="/rooms/check" id="check-in-box" class="center80 shadow-box container-flex">
        <div>
            <p>Check in</p>
            <input
                id="input-checkin"
                type="date"
                name="check-in"
                min="' .date('Y-m-d'). '"
                value="' .date('Y-m-d'). '"
                max="' .date('Y-m-d', strtotime('+6 months')). '"
            />
        </div>
        <div>
            <p>Check out</p>
            <input
            id="input-checkout"
                type="date"
                name="check-out"
                min="' .date('Y-m-d', strtotime('tomorrow')). '"
                value="' .date('Y-m-d', strtotime('tomorrow')). '"
                max="' .date('Y-m-d', strtotime('+7 months')). '"
            />
            <p id="checkin-error"></p>
        </div>
        <div>
            <p>Room</p>
            <select name="room-select" id="room-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div>
            <p>Adult</p>
            <select name="adult-select" id="adult-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div>
            <p>Children</p>
            <select name="children-select" id="children-select">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div>
            <button id="checkin-btn" type="submit" class="btn">Check</button>
        </div>
    </form>

    <!-- krótki opis o nas -->
    <div id="short-desc" class="center80">
        <div id="short-desc1">
            <h1>Welcome to our hotel!</h1>
            <p>We welcome you to the best hotel in the world, we offer good rooms and we have a restaurant!</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Perspiciatis earum neque saepe temporibus harum reprehenderit facilis?
                Inventore obcaecati quod ullam itaque eum ipsum maiores ad, reprehenderit quia laboriosam enim? Voluptatum?</p>
        </div>
        <div id="short-desc2"><img src="' .PATH_IMG. 'vacation1.jpg" alt=""></div>
        <div id="short-desc3"><img src="' .PATH_IMG. 'vacation2.jpg" alt=""></div>
        <div id="short-desc4"><img src="' .PATH_IMG. 'vacation3.jpg" alt=""></div>
    </div>
';
?>