"use strict";

// Changing background

const images = ['image01', 'image02'];
const backgroundBox = document.querySelector('.get-started');
const image = Math.floor(Math.random() * images.length);
window.onload = function () {
  backgroundBox.classList.add(images[image]);
};

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
  langBox.classList.add('arrow-up');
  langBox.classList.remove('arrow-down');
});

langBox.addEventListener('mouseleave', (e) => {
  langBox.classList.remove('language-change_opened');
  langBox.classList.add('arrow-down');
  langBox.classList.remove('arrow-up');
});



// Mobile menu

menuBurger.onclick = function () {
  menuBurger.classList.toggle("open");
  header.classList.toggle("mobile-menu-opened");
  headerNavList.classList.toggle("d-flex");
  html.classList.toggle("no-scroll");
  body.classList.toggle("no-scroll-body");
};


// Custom selector - choose language

const dropDownBtn = document.querySelector('.select-language');
const dropDownList = document.querySelector('.dropdown-list');
const dropDownListItems = dropDownList.querySelectorAll('.dropdown-list__item');
const getStartedButton = document.querySelector('.get-started__button');


// Switch link function
const switchLink = function (langValue) {
  switch (langValue) {
    case 'english':
      getStartedButton.href = "english-teachers.html";
      break;
    case 'chinese':
      getStartedButton.href = "chinese-teachers.html";
      break;
    case 'italian':
      getStartedButton.href = "italian-teachers.html";
      break;
    case 'japanese':
      getStartedButton.href = "japanese-teachers.html";
      break;
    case 'russian':
      getStartedButton.href = "russian-teachers.html";
      break;
    case 'spanish':
      getStartedButton.href = "spanish-teachers.html";
      break;
    case 'french':
      getStartedButton.href = "french-teachers.html";
      break;
    case 'german':
      getStartedButton.href = "german-teachers.html";
      break;
    default:
      getStartedButton.href = "english-teachers.html";
  };
}


// Toggle select list
dropDownBtn.addEventListener('click', function (e) {
  dropDownList.classList.toggle('dropdown-list_opened');
  this.classList.add('dropdown__button--active');
  dropDownBtn.classList.toggle("arrow-down");
  dropDownBtn.classList.toggle("arrow-up");
});

// Choose select list element
dropDownListItems.forEach(function (listItem) {
  listItem.addEventListener('click', function (e) {
    e.stopPropagation();
    dropDownBtn.innerText = this.innerText;

    dropDownBtn.classList.forEach(item => {
      if (item.endsWith('icon')) {
        dropDownBtn.classList.remove(item);
      }
    })

    const langValue = this.getAttribute('data-value');

    switchLink(langValue);
    dropDownBtn.classList.add(langValue + '-icon');
    dropDownList.classList.remove('dropdown-list_opened');
    dropDownBtn.classList.toggle("arrow-down");
    dropDownBtn.classList.toggle("arrow-up");

    // if (langValue === 'english') {
    //   getStartedButton.href = "english-teachers.html";
    // } else if (langValue === 'chinese') {
    //   getStartedButton.href = "chinese-teachers.html";
    // } else if (langValue === 'italian') {
    //   getStartedButton.href = "italian-teachers.html";
    // } else if (langValue === 'japanese') {
    //   getStartedButton.href = "japanese-teachers.html";
    // } else if (langValue === 'russian') {
    //   getStartedButton.href = "russian-teachers.html";
    // } else if (langValue === 'french') {
    //   getStartedButton.href = "french-teachers.html";
    // } else if (langValue === 'german') {
    //   getStartedButton.href = "german-teachers.html";
    // };

    // switch (langValue) {
    //   case 'english':
    //     getStartedButton.href = "english-teachers.html";
    //     break;
    //   case 'chinese':
    //     getStartedButton.href = "chinese-teachers.html";
    //     break;
    //   case 'italian':
    //     getStartedButton.href = "italian-teachers.html";
    //     break;
    //   case 'japanese':
    //     getStartedButton.href = "japanese-teachers.html";
    //     break;
    //   case 'russian':
    //     getStartedButton.href = "russian-teachers.html";
    //     break;
    //   case 'french':
    //     getStartedButton.href = "french-teachers.html";
    //     break;
    //   case 'german':
    //     getStartedButton.href = "german-teachers.html";
    //     break;
    //   default:
    //     getStartedButton.href = "english-teachers.html";
    // };

  });

  // Choose select by press Enter key
  listItem.addEventListener('keydown', function (e) {
    if (e.keyCode == 13) {
      e.stopPropagation();
      dropDownBtn.innerText = this.innerText;

      dropDownBtn.classList.forEach(item => {
        if (item.endsWith('icon')) {
          dropDownBtn.classList.remove(item);
        }
      })

      const langValue = this.getAttribute('data-value');

      switchLink(langValue);
      dropDownBtn.classList.add(langValue + '-icon');
      dropDownList.classList.remove('dropdown-list_opened');
      dropDownBtn.classList.toggle("arrow-down");
      dropDownBtn.classList.toggle("arrow-up");
      getStartedButton.focus();
    }
  });

});


// Click outside the select list for closing it
document.addEventListener('click', function (e) {
  if (e.target !== dropDownBtn) {
    dropDownBtn.classList.remove('dropdown__button--active');
    dropDownList.classList.remove('dropdown-list_opened');
    if (dropDownBtn.classList.contains("arrow-up")) {
      dropDownBtn.classList.remove("arrow-up");
      dropDownBtn.classList.add("arrow-down");
    }
  }
});

// Press Esc for close select list
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    dropDownBtn.classList.remove('dropdown__button--active');
    dropDownList.classList.remove('dropdown-list_opened');
  }
});




// Accordion

const faqItems = document.querySelectorAll('.faq__item');
const faqQuestion = document.querySelectorAll('.faq__question');
// const faqAnswers = document.querySelectorAll('.faq__answer');

for (const faqItem of faqItems) {
  faqItem.onclick = function () {
    faqItem.classList.toggle("faq-opened");
    const thisFaqQuestion = this.querySelector(".faq__question");
    thisFaqQuestion.classList.toggle("faq-up");
    thisFaqQuestion.classList.toggle("faq-down");
    const fQ = this.querySelector(".faq__question");

    const thisFaqAnswer = this.querySelector(".faq__answer");
    if (thisFaqAnswer.hasAttribute('tabindex')) {
      thisFaqAnswer.removeAttribute("tabindex");
    } else {
      thisFaqAnswer.setAttribute("tabindex", "0");
    };

    const ariaExpAttr = fQ.getAttribute("aria-expanded");
    if (ariaExpAttr === "false") {
      thisFaqQuestion.setAttribute("aria-expanded", "true");
    } else {
      thisFaqQuestion.setAttribute("aria-expanded", "false");
    };
  };
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
function becomeTeacherPopup(event) {
  // event.preventDefault();
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
    } else if (elemId === 'JuliaFomina') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/yRjSjR28zc8?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Юлия Фомина";
      } else {
        videoHeader.innerText = "Teacher Julia Fomina";
      };
    } else if (elemId === 'VictoriaKovalenko') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/kOJg6FQqeL8?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Виктория Коваленко";
      } else {
        videoHeader.innerText = "Teacher Victoria Kovalenko";
      };
    } else if (elemId === 'Jan-Pieter') {
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
    } else if (elemId === 'AnastasiaMironiuk') {
      videoWrapper.insertAdjacentHTML('afterbegin', '<iframe src="https://www.youtube.com/embed/Au0CGQAZWrA?modestbranding=1&controls=2&rel=0&playsinline=1" frameborder="0" allowfullscreen></iframe>');
      if (body.classList.contains('rus-lang')) {
        videoHeader.innerText = "Преподаватель Анастасия Миронюк";
      } else {
        videoHeader.innerText = "Teacher Anastasia Mironiuk";
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



// Teachers filter

const languageTabs = document.querySelectorAll('.tab-btn');
const teacherCards = document.querySelectorAll('.teacher-card');
const teachersTable = document.querySelector('.teachers-presentation__table');
const teachersButton = document.querySelector('.teachers__button');
const tabsList = document.querySelector('.tabs__list');

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



const moreTeacherBtn = document.querySelector('.more-teachers');

moreTeacherBtn.onclick = function(event) {

  event.preventDefault();

  for (let teacherCard of teacherCards) {
    teacherCard.style.display = "block";
    teachersTable.style.height = "auto";
    for (let languageTab of languageTabs) {
      languageTab.classList.remove('tab-btn_active');
      if (languageTab.getAttribute('data-languages').includes('all')) {
        languageTab.classList.add('tab-btn_active');
      }
    }
  }
  moreTeacherBtn.style.display = 'none';
};

for (let languageTab of languageTabs) {

  languageTab.addEventListener('keydown', function (e) {
    if (e.keyCode == 13 || e.keyCode == 32) {
      this.classList.add('tab-btn_active');
    }
  });

  languageTab.onclick = function () {

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
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-br-fl');
        }
      }
    } else if (lang === 'spanish') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('spanish')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-sp-fl');
        }
      }
    } else if (lang === 'italian') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('italian')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-it-fl');
        }
      }
    } else if (lang === 'japanese') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('japanese')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-jp-fl');
        }
      }
    } else if (lang === 'chinese') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('chinese')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-ch-fl');
        }
      }
    } else if (lang === 'russian') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('russian')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-rf-fl');
        }
      }
    } else if (lang === 'french') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('french')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-fr-fl');
        }
      }
    } else if (lang === 'german') {
      for (let teacherCard of teacherCards) {
        if (!teacherCard.getAttribute('data-languages').includes('german')) {
          teacherCard.style.display = "none";
          deleteFlagBg(teachersTable);
          teachersTable.classList.add('bg-ger-fl');
        }
      }
    } else {
      deleteFlagBg(teachersTable);
    };

  };
};

function deleteFlagBg(elem) {
  elem.classList.forEach(item => {
    if (item.startsWith('bg')) {
      teachersTable.classList.remove(item);
    }
  })
};



