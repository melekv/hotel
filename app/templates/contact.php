<?php
$result = $this->topPic();

$result .= '
    <section class="center80">
        <div class="container-flex-contact">
            <div>
                <i class="fas fa-phone"></i>
                <h1>Phone</h1>
                <p>+01 234 569 885</p>
            </div>
            <div>
                <i class="fas fa-map-marker-alt"></i>
                <h1>Address</h1>
                <p>Isis Watson, 283 Fusce Rd, NY</p>
            </div>
            <div>
                <i class="far fa-clock"></i>
                <h1>Open times</h1>
                <p>10:00 am to 23 pm</p>
            </div>
            <div>
                <i class="fas fa-envelope"></i>
                <h1>Email</h1>
                <p>info@gmail.com</p>
            </div>
        </div>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d71502.93061670118!2d-3.275377999266252!3d55.94128462745959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4887b800a5982623%3A0x64f2147b7ce71727!2sEdynburg%2C%20Wielka%20Brytania!5e0!3m2!1spl!2spl!4v1588157890829!5m2!1spl!2spl" width="100%" height="650" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>

    <section class="center60 margin-top-bottom">
        <div>
            <p id="contact-small-text" class="center-text">Contact us</p>
            <h1 class="center-text">Leave Message</h1>
        </div>
        <form action="" method="post" class="contact-grid">
            <input type="text" placeholder="Your name" class="grid-item1">
            <input type="email" placeholder="Your email" class="grid-item2">
            <textarea name="" id="" class="grid-item3">Your message...</textarea>
            <button id="btnSend" class="btn">Send Message</button>
        </form>
    </section>
';
?>