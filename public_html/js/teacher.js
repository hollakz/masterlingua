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



// Popups

// Book a lesson popup

const bookBtns = document.querySelectorAll('.book-btn');
const popupScreen = document.querySelector('.popup-screen'); // Popup wrapper
const bookLessonPopup = document.querySelector('#book-lesson-popup');
const crossLessonPopup = document.querySelector('.book-lesson-popup__cross');
const inputTeacherName = document.querySelector('#bl-ct');

// Open lesson popup
for (let bookBtn of bookBtns) {
  bookBtn.onclick = function () {
    console.log('this', this.dataset.teacher);
    inputTeacherName.value = this.dataset.teacher;
    popupScreen.style.display = "flex";
    bookLessonPopup.style.display = "block";
    html.classList.toggle("no-scroll");
  }
}

// Close lesson popup
crossLessonPopup.onclick = function () {
  popupScreen.style.display = "none";
  bookLessonPopup.style.display = "none";
  html.classList.toggle("no-scroll");
  bflForm.classList.remove("form-sended");
  blpDel.style.visibility = "visible";
};



// Become a teacher popup

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


// Videos popup

const videoPopup = document.querySelector('#video-popup');
const closeVideoPopup = document.querySelector('.video-popup__cross');
const videoPopupButtons = document.querySelectorAll('.teacher-box__video-btn');
const videoWrapper = document.querySelector(".video-wrapper");
const videoHeader = document.querySelector(".video-popup__header");

for (const videoPopupButton of videoPopupButtons) {
  videoPopupButton.onclick = function () {
    videoPopup.classList.add("video-popup_opened");
    videoPopup.classList.remove("video-popup_closed");
    html.classList.add("no-scroll");

    const elemId = this.id;

    //for copy
    if (elemId === 'OlgaOconnor') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/0tzqCJhTGmg?modestbranding=1&controls=1&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Ольга О'Коннор";
      } else {
        videoHeader.innerText = "Teacher Olga O'Connor";
      };
    } else if (elemId === 'NataliaKazlovskaya') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/z8zg-cRYCbE?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Наталья Казловская";
      } else {
        videoHeader.innerText = "Teacher Natalia Kazlovskaya";
      };
    } else if (elemId === 'VeronikaFrolova') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/R_bV7Q0eV9I?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Вероника Фролова";
      } else {
        videoHeader.innerText = "Teacher Veronika Frolova";
      };
    } else if (elemId === 'MichaelSchlapp') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/NBs_it4PAuU?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Michael Schlapp";
      } else {
        videoHeader.innerText = "Teacher Michael Schlapp";
      };
    } else if (elemId === 'TatianaBazhanova') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/vC3-c03UleA?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Татьяна Бажанова";
      } else {
        videoHeader.innerText = "Teacher Tatiana Bazhanova";
      };
    } else if (elemId === 'JuliaFomina') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/yRjSjR28zc8?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Юлия Фомина";
      } else {
        videoHeader.innerText = "Teacher Julia Fomina";
      };
    } else if (elemId === 'JP') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/Qb8kEK2ya10?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Jan-Pieter van Wyngaardt (JP)";
      } else {
        videoHeader.innerText = "Teacher Jan-Pieter van Wyngaardt (JP)";
      };
    } else if (elemId === 'TatianaBiistrova') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/oPTrOtHby_0?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Татьяна Быстрова";
      } else {
        videoHeader.innerText = "Teacher Tatiana Biistrova";
      };
    } else if (elemId === 'DariaSologub') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/YG7LPGvKvaA?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Дарья Сологуб";
      } else {
        videoHeader.innerText = "Teacher Daria Sologub";
      };
    } else if (elemId === 'ElizavetaTretiakova') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/iK5UPSJFgEk?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Елизавета Третьякова";
      } else {
        videoHeader.innerText = "Teacher Elizaveta Tretiakova";
      };
    } else if (elemId === 'KristinaMorozova') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/xuLG9e1ze8c?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Морозова Кристина";
      } else {
        videoHeader.innerText = "Teacher Kristina Morozova";
      };
    } else if (elemId === 'RJ') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/_Ie2Mlx_CcI?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель RJ";
      } else {
        videoHeader.innerText = "Teacher RJ";
      };
    } else if (elemId === 'NadolskayaEkaterinaIt') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/YWm9zTi4yXA?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Екатерина Надольская";
      } else {
        videoHeader.innerText = "Teacher Nadolskaya Ekaterina";
      };
    } else if (elemId === 'NadolskayaEkaterinaFr') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/ZLrYglolmGQ?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Екатерина Надольская";
      } else {
        videoHeader.innerText = "Teacher Nadolskaya Ekaterina";
      };
    } else if (elemId === 'OlegSoloviev') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/rtiQ7Wo26GU?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Олег Соловьев";
      } else {
        videoHeader.innerText = "Teacher Oleg Soloviev";
      };
    } else if (elemId === 'DeanOconnor') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/5k-gjeXqVDg?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Дин О'Коннор";
      } else {
        videoHeader.innerText = "Teacher Dean O'Connor";
      };
    } else if (elemId === 'TamaraBohrer') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/IXbOvGK1B_A?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Tamara Bohrer";
      } else {
        videoHeader.innerText = "Teacher Tamara Bohrer";
      };
    } else if (elemId === 'KateLenkova') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/v88EnIKsqgk?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Екатерина Ленкова";
      } else {
        videoHeader.innerText = "Teacher Kate Lenkova";
      };
    } else {
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Видео еще монтируется";
      } else {
        videoHeader.innerText = "Coming soon";
      };
    }
    //for copy

    //Close video popup
    closeVideoPopup.onclick = function () {
      videoPopup.classList.add("video-popup_closed");
      videoPopup.classList.remove("video-popup_opened");
      html.classList.toggle("no-scroll");
      videoWrapper.innerHTML = "";
    };

  }
};
