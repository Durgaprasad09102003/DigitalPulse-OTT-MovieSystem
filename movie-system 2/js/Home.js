const menuToggle = document.getElementById('menuToggle');
const menu = document.getElementById("menu");
menuToggle.addEventListener('click', () => {
    menu.classList.toggle('active');
})


document.getElementById('monthly').addEventListener('click', function() {
    setActivePlan('monthly');
});

document.getElementById('yearly').addEventListener('click', function() {
    setActivePlan('yearly');
});

function setActivePlan(plan) {
    document.querySelector('.active').classList.remove('active');
    document.getElementById(plan).classList.add('active');

    const prices = document.querySelectorAll('.price');

    if (plan === 'yearly') {
        prices[0].innerHTML = "$99.99 <span>/year</span>";
        prices[1].innerHTML = "$129.99 <span>/year</span>";
        prices[2].innerHTML = "$149.99 <span>/year</span>";
    } else {
        prices[0].innerHTML = "$9.99 <span>/month</span>";
        prices[1].innerHTML = "$12.99 <span>/month</span>";
        prices[2].innerHTML = "$14.99 <span>/month</span>";
    }
}
