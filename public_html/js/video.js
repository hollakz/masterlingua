// Video presentation

const windowWidth = window.innerWidth;
const videoContainer = document.querySelector(".popup-presentation");

if (windowWidth < 576) {
  videoContainer.classList.add('popup-presentation_mobile');
};

if (!localStorage.getItem("visited")) {

  const video = document.querySelector("#popup-presentation-video");
  const playVideoBtn = document.querySelector(".video-prev");
  const videoPrev = document.querySelector(".video-prev");
  const closeVideoBtn = document.querySelector(".popup-presentation-close-btn");
  const videoInner = document.querySelector(".popup-presentation-inner");

  video.removeAttribute("controls");

  setTimeout(function() {
    videoContainer.classList.add('popup-presentation_opened');
  }, 1000);

  playVideoBtn.onclick = function() {
    videoContainer.classList.add('popup-presentation_extended');
    video.setAttribute("controls", "");
    videoPrev.classList.add('video-prev_closed');
    video.play();
  };

  closeVideoBtn.onclick = function() {
    videoContainer.classList.remove('popup-presentation_opened');
    videoContainer.classList.remove('popup-presentation_extended');
    closeVideoBtn.classList.remove('btn-show')
    video.pause();
  };

  video.addEventListener("ended", function() {
    videoContainer.classList.remove('popup-presentation_opened');
    videoContainer.classList.remove('popup-presentation_extended');
  });

  videoContainer.addEventListener('mouseover', function(event) {
    closeVideoBtn.classList.add('btn-show');
    if (windowWidth > 576) {
    setTimeout( function() { closeVideoBtn.classList.remove('btn-show') }, 2000);
    };
  });

localStorage.setItem("visited", "true");

};

