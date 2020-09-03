const path = window.location.pathname;
const pathArray = path.split('/');
const btnNewsletter = document.getElementById('btn-newsletter');

window.onscroll = function() {
    if (pathArray[1] == '') {
        document.getElementById('welcome-pic').style.position = 'relative';
        document.getElementById('welcome-pic').style.backgroundPosition = 
            '0 ' + (80 - Math.round(window.scrollY*0.1)) + '%';

        if (window.scrollY >= 200) {
            document.getElementById('short-desc').style.opacity = 1;
        } else if (window.scrollY == 0) {
            document.getElementById('short-desc').style.opacity = 0;
        }
        
    } else {
        document.getElementById('top-pic').style.position = 'relative';
        document.getElementById('top-pic').style.backgroundPosition = 
            '0 ' + (80 - Math.round(window.scrollY*0.4)) + '%';
    }
}

// checkin validate date
if (pathArray[1] == '') {
    
    // variables
    const input_checkin = document.getElementById('input-checkin');
    const input_checkout = document.getElementById('input-checkout');
    const input_error = document.getElementById('checkin-error');
    const checkin_btn = document.getElementById('checkin-btn');

    input_checkout.addEventListener('change', () => {
        if (input_checkin.value >= input_checkout.value) {
            input_error.innerHTML = 'Check out can not be smaller then check in!';
            console.log(checkin_btn.disabled);
            checkin_btn.disabled = true;
        } else {
            input_error.innerHTML = '';
            checkin_btn.disabled = false;
        }
    });
}

btnNewsletter.addEventListener('click', () => {
    const email = document.getElementById('email-newsletter').value;
    const answer = document.getElementById('newsletter-answer');
    
    fetch('/newsletter.php?email=' + email)
        .then(response => response.json())
        .then(response => {
            answer.innerHTML = response.status;
        });
});