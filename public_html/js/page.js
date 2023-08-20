'use strict';


const dropdown = document.querySelector('.dropdown');
const dropdownMenu = document.querySelector('.dropdown-menu');
const lastChildDropdMenu = document.querySelector('.dropdown-menu__link_last');
const menuBurger = document.querySelector('.header__burger');
const headerNavList = document.querySelector('.header-nav__list');
const header = document.querySelector('.header');
const html = document.querySelector('.html');
const body = document.querySelector('.body');
const tabButtons = document.querySelectorAll('.tab-btn');
const teachersList = document.querySelector('.teachers-presentation__table');


// Dropdown Menu

dropdown.onclick = function () {

  if (header.classList.contains('mobile-menu-opened')) {
    dropdownMenu.classList.toggle("dropdown-menu_opened");
    dropdown.classList.toggle("arrow-down");
    dropdown.classList.toggle("arrow-up");
  }
};

dropdown.onfocus = function () {
  if (!header.classList.contains('mobile-menu-opened')) {
    dropdownMenu.classList.add("dropdown-menu_opened");
    dropdown.classList.remove("arrow-down");
    dropdown.classList.add("arrow-up");
  }
};

lastChildDropdMenu.onblur = function () {
  if (!header.classList.contains('mobile-menu-opened')) {
    dropdownMenu.classList.remove("dropdown-menu_opened");
    dropdown.classList.add("arrow-down");
    dropdown.classList.remove("arrow-up");
  }
};

dropdown.addEventListener('mouseenter', (e) => {
  if (!header.classList.contains('mobile-menu-opened')) {
    dropdownMenu.classList.add("dropdown-menu_opened");
    dropdown.classList.remove("arrow-down");
    dropdown.classList.add("arrow-up");
  }
});

dropdown.addEventListener('mouseleave', (e) => {
  if (!header.classList.contains('mobile-menu-opened')) {
    dropdownMenu.classList.remove("dropdown-menu_opened");
    dropdown.classList.add("arrow-down");
    dropdown.classList.remove("arrow-up");
  }
});

// Choose language menu

const langBox = document.querySelector('.language-change');
const langToggle = document.querySelector('.language-change__toggle');
const langLastChild = document.querySelector('.language-change__last');

langToggle.onfocus = function () {
  langBox.classList.add('language-change_opened');
};

langLastChild.onblur = function () {
  langBox.classList.remove('language-change_opened');
};

langBox.addEventListener('mouseenter', (e) => {
  langBox.classList.add('language-change_opened');
});

langBox.addEventListener('mouseleave', (e) => {
  langBox.classList.remove('language-change_opened');
});


// Mobile menu

menuBurger.onclick = function () {
  menuBurger.classList.toggle("open");
  header.classList.toggle("mobile-menu-opened");
  headerNavList.classList.toggle("d-flex");
  html.classList.toggle("no-scroll");
  body.classList.toggle("no-scroll-body");
};



// Become a teacher popup

const popupScreen = document.querySelector('.popup-screen'); // Popup wrapper
const becomeTPopup = document.querySelector('#become-teacher-popup');
const becomeTPopupCross = document.querySelector('.become-teacher-popup__cross');
const btLinks = document.querySelectorAll('.become-teacher-link');

// Function become a teacher popup
function becomeTeacherPopup() {
  popupScreen.style.display = "flex";
  becomeTPopup.style.display = "block";
  html.classList.toggle("no-scroll");
}

// Open by Enter
for (let btLink of btLinks) {
  btLink.addEventListener('keydown', function (e) {
    if (e.keyCode == 13) {
      popupScreen.style.display = "flex";
      becomeTPopup.style.display = "block";
      html.classList.toggle("no-scroll");
    }
  });
}
// Close become a teacher popup
becomeTPopupCross.onclick = function () {
  popupScreen.style.display = "";
  becomeTPopup.style.display = "";
  html.classList.toggle("no-scroll");
  btPopup.classList.remove("form-sended");
  btDel.style.visibility = "";
  btPopupTitle.style.visibility = "";
}

