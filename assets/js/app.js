const headerMobileIcon = document.querySelector('.header-mobile-icon');
const headerMobileList = document.querySelector('.header-mobile-list');

headerMobileIcon.addEventListener('click', () => {
    headerMobileList.classList.toggle('show');
})