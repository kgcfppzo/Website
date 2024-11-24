function insight(element) {
    setActiveButton(element);
    document.getElementById('insights').style.display = 'flex';
    document.getElementById('events').style.display = 'none';
    document.getElementById('testi').style.display = 'none';
    document.getElementById('payment').style.display = 'none';
    document.getElementById('contac').style.display = 'none';
}

function evet(element) {
    setActiveButton(element);
    document.getElementById('events').style.display = 'flex';
    document.getElementById('insights').style.display = 'none';
    document.getElementById('testi').style.display = 'none';
    document.getElementById('payment').style.display = 'none';
    document.getElementById('contac').style.display = 'none';
}

function testi(element) {
    setActiveButton(element);
    document.getElementById('testi').style.display = 'flex';
    document.getElementById('insights').style.display = 'none';
    document.getElementById('events').style.display = 'none';
    document.getElementById('payment').style.display = 'none';
    document.getElementById('contac').style.display = 'none';
}

function payy(element) {
    setActiveButton(element);
    document.getElementById('payment').style.display = 'flex';
    document.getElementById('insights').style.display = 'none';
    document.getElementById('testi').style.display = 'none';
    document.getElementById('events').style.display = 'none';
    document.getElementById('contac').style.display = 'none';
}

function mailss(element) {
    setActiveButton(element);
    document.getElementById('contac').style.display = 'flex';
    document.getElementById('insights').style.display = 'none';
    document.getElementById('testi').style.display = 'none';
    document.getElementById('payment').style.display = 'none';
    document.getElementById('events').style.display = 'none';
}

function setActiveButton(activeElement) {
    var buttons = document.querySelectorAll('.mob span, .dex span');
    buttons.forEach(function(button) {
        button.classList.remove('activve');
    });
    activeElement.classList.add('activve');
}

document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault(); 

    const confirmLogout = confirm("Are you sure you want to log out?");

    if (confirmLogout) {
        window.location.href = this.href;
    }
});