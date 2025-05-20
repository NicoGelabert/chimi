function animateElement(element, delay) {
    setTimeout(() => {
        element.classList.add('active');
    }, delay);
}
var hr = document.querySelector('.animate-hr');
var h3 = document.querySelector('.animate-h3');
var h1 = document.querySelector('.animate-h1');
var p = document.querySelector('.animate-p');
var arrow = document.querySelector('.animate-arrow');
var serviceItems = document.querySelectorAll('.animate-service-item');
var buttons = document.querySelectorAll('.animate-button');

animateElement(hr, 800); // 0.2 segundos después
animateElement(h3, 500); // 0.5 segundos después
animateElement(h1, 750); // 0.75 segundos después
animateElement(p, 1000); // 1 segundo después
animateElement(arrow, 1250); // 2.5 segundos después (flecha)
// Animar secuencialmente los items del servicio
serviceItems.forEach((item, index) => {
    animateElement(item, 1500 + index * 250); // 1.5 segundos + 0.25 segundos por cada item
});
buttons.forEach((item, index) => {
    animateElement(item, 2750 + index * 250);
});
