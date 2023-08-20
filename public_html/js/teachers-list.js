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


// Book a lesson popup

const bookBtns = document.querySelectorAll('.book-btn');
const popupScreen = document.querySelector('.popup-screen'); // Popup wrapper
const bookLessonPopup = document.querySelector('#book-lesson-popup');
const crossLessonPopup = document.querySelector('.book-lesson-popup__cross');
const inputTeacherName = document.querySelector('#bl-ct');

// Open lesson popup
for (let bookBtn of bookBtns) {
  bookBtn.onclick = function () {
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



// Teachers filter

const languageTabs = document.querySelectorAll('.tab-btn');
const teacherCards = document.querySelectorAll('.teacher-card');
const teachersTable = document.querySelector('.teachers-presentation__table');
const teachersButton = document.querySelector('.teachers__button');
const tabsList = document.querySelector('.tabs__list');
const teachersTitle = document.querySelector('.teachers__title');  // Only for this page

teachersButton.onclick = function () {
  tabsList.classList.toggle('tabs__list_opened');
  teachersButton.classList.add('arrow-up');
  teachersButton.classList.remove('arrow-down');

  languageTabs.forEach(function (listItem) {
    listItem.addEventListener('click', function () {
      teachersButton.innerText = this.innerText;
      tabsList.classList.remove('tabs__list_opened');
      teachersButton.classList.remove('arrow-up');
      teachersButton.classList.add('arrow-down');
    })
  });
};


for (let teacherCard of teacherCards) {

  if (teachersTable.classList.contains('eng')) {
    if (!teacherCard.getAttribute('data-languages').includes('english')) {
      teacherCard.style.display = "none";
    }
  } else if (teachersTable.classList.contains('chi')) {
    if (!teacherCard.getAttribute('data-languages').includes('chinese')) {
      teacherCard.style.display = "none";
    }
  } else if (teachersTable.classList.contains('it')) {
    if (!teacherCard.getAttribute('data-languages').includes('italian')) {
      teacherCard.style.display = "none";
    }
  } else if (teachersTable.classList.contains('jp')) {
    if (!teacherCard.getAttribute('data-languages').includes('japanese')) {
      teacherCard.style.display = "none";
    }
  } else if (teachersTable.classList.contains('ru')) {
    if (!teacherCard.getAttribute('data-languages').includes('russian')) {
      teacherCard.style.display = "none";
    }
  } else if (teachersTable.classList.contains('fr')) {
    if (!teacherCard.getAttribute('data-languages').includes('french')) {
      teacherCard.style.display = "none";
    }
  } else if (teachersTable.classList.contains('ger')) {
    if (!teacherCard.getAttribute('data-languages').includes('german')) {
      teacherCard.style.display = "none";
    }
  }
};

const moreTeacherBtn = document.querySelector('.more-teachers');

moreTeacherBtn.onclick = function () {
  for (let teacherCard of teacherCards) {
    teacherCard.style.display = "block";
    if (body.classList.contains('rus-lang')) {
      teachersTitle.innerText = "Наши преподаватели";
    } else {
      teachersTitle.innerText = "All our teachers";
    };
    moreTeacherBtn.style.display = "none";
    teachersTable.classList.forEach(item => {
      if (item.startsWith('bg')) {
        teachersTable.classList.remove(item);
      }
    })
  }
}


for (let languageTab of languageTabs) {

  languageTab.addEventListener('keydown', function (e) {
    if (e.keyCode == 13 || e.keyCode == 32) {
      this.classList.add('tab-btn_active');
    }
  });

  languageTab.onclick = function () {

    teachersTable.classList.forEach(item => {
      if (item.startsWith('bg')) {
        teachersTable.classList.remove(item);
      }
    })

    for (let languageTab of languageTabs) {
      languageTab.classList.remove('tab-btn_active');

    }

    this.classList.add('tab-btn_active');

    teachersTable.style.height = "auto";

    for (let teacherCard of teacherCards) {
      teacherCard.style.display = "block";
    }

    const lang = languageTab.getAttribute('data-languages');

    if (lang === 'english') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('english')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-br-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели английского языка";
          } else {
            teachersTitle.innerText = "Our english teachers";
          };

        }
      }
    } else if (lang === 'spanish') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('spanish')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-sp-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели испанского языка";
          } else {
            teachersTitle.innerText = "Our spanish teachers";
          };

        }
      }
    } else if (lang === 'italian') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('italian')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-it-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели итальянского языка";
          } else {
            teachersTitle.innerText = "Our italian teachers";
          };

        }
      }
    } else if (lang === 'japanese') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('japanese')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-jp-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели японского языка";
          } else {
            teachersTitle.innerText = "Our japanese teachers";
          };

        }
      }
    } else if (lang === 'chinese') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('chinese')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-ch-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели китайского языка";
          } else {
            teachersTitle.innerText = "Our chinese teachers";
          };

        }
      }
    } else if (lang === 'russian') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('russian')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-rf-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели русского языка";
          } else {
            teachersTitle.innerText = "Our russian teachers";
          };

        }
      }
    } else if (lang === 'french') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('french')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-fr-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели французского языка";
          } else {
            teachersTitle.innerText = "Our french teachers";
          };

        }
      }
    } else if (lang === 'german') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('german')) {
          teacherCard.style.display = "none";
          teachersTable.classList.add('bg-ger-fl');

          if (body.classList.contains('rus-lang')) {
            teachersTitle.innerText = "Наши преподаватели немецкого языка";
          } else {
            teachersTitle.innerText = "Our german teachers";
          };

        }
      }
    } else if (lang === 'all') {
      for (let teacherCard of teacherCards) {
        teacherCard.style.display = "block";
        teachersTable.classList.forEach(item => {
          if (item.startsWith('bg')) {
            teachersTable.classList.remove(item);
          }
        })
        if (body.classList.contains('rus-lang')) {
          teachersTitle.innerText = "Наши преподаватели";
        } else {
          teachersTitle.innerText = "All our teachers";
        };


      }
    };

  };
};




// Videos popup

const videoPopup = document.querySelector('#video-popup');
const closeVideoPopup = document.querySelector('.video-popup__cross');
const videoPopupButtons = document.querySelectorAll('.teacher-card__video-button');
const teacherCardsImg = document.querySelectorAll('.teacher-card__img');
const videoWrapper = document.querySelector(".video-wrapper");
const videoHeader = document.querySelector(".video-popup__header");

for (const teacherCardImg of teacherCardsImg) {
  teacherCardImg.onclick = function () {
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


