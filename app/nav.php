<ul>
    <li><a href="/" class="<?php if ($r->getPageName() == 'Home') { echo 'active'; } ?>">Home</a></li>
    <li><a href="/rooms" class="<?php if ($r->getPageName() == 'Rooms') { echo 'active'; } ?>">Rooms</a></li>
    <li><a href="/about" class="<?php if ($r->getPageName() == 'About') { echo 'active'; } ?>">About us</a></li>
    <li><a href="/contact" class="<?php if ($r->getPageName() == 'Contact') { echo 'active'; } ?>">Contact</a></li>
</ul>