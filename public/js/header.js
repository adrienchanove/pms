const burgerButton = document.querySelector('#headerBurgerButton');
const burgerMenu = document.querySelector('#headerBurgerMenu');


burgerButton.addEventListener('click', () => {
    burgerMenu.classList.toggle('hidden');
}
);



