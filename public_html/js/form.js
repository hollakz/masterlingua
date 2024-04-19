const firstLessonFormWrap = document.querySelector(".book-first-lesson__form");
const bflDel = document.querySelector(".book-first-lesson__del-wrap");

$(document).ready(function () {

	//E-mail Ajax Send
	$("#form-first-lesson").submit(function () { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function () {
			bflDel.style.display = "grid";
			firstLessonFormWrap.classList.toggle("form-sended");
			ym(91722697, 'reachGoal', 'formFirstLessonSent');
			setTimeout(function () {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
});

const confWrap = document.querySelector(".bring-friend__confirmation-wrapper");
const brFrDel = document.querySelector(".bring-friend__del-wrap");


$(document).ready(function () {

	//E-mail Ajax Send
	$("#form-bring-friend").submit(function () { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function () {
			brFrDel.style.display = "grid";
			confWrap.classList.toggle("form-sended");
			ym(91722697, 'reachGoal', 'formBringFriendSent');
			setTimeout(function () {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
});

const bflForm = document.querySelector(".book-lesson-popup");
const blpDel = document.querySelector(".book-lesson-popup__del-wrap");

$(document).ready(function () {

	//E-mail Ajax Send
	$("#form-book-lesson").submit(function () { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function () {
			blpDel.style.visibility = "hidden";
			bflForm.classList.add("form-sended");
			ym(91722697, 'reachGoal', 'formBookLessonSent');
			setTimeout(function () {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
});

const FQForm = document.querySelector(".faq-form-popup");
const FQDel = document.querySelector(".faq-form-popup__del-wrap");

$(document).ready(function () {

	//E-mail Ajax Send
	$("#faq-form").submit(function () { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function () {
			FQDel.style.display = "grid";
			FQForm.classList.add("form-sended");
			ym(91722697, 'reachGoal', 'faqFormSend');
			setTimeout(function () {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
});


const btPopup = document.querySelector(".become-teacher-popup");
const btDel = document.querySelector(".form-become-teacher");
const btPopupTitle = document.querySelector(".become-teacher-popup__title");

$(document).ready(function () {

	//E-mail Ajax Send
	$("#form-become-teacher").submit(function () { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function () {
			btDel.style.visibility = "hidden";
			btPopupTitle.style.visibility = "hidden";
			btPopup.classList.add("form-sended");
			ym(91722697, 'reachGoal', 'formBecomeTeacherSent');
			setTimeout(function () {
				// Done Functions
				th.trigger("reset");
			}, 1000);
			// return true;
		});
		return false;
	});
});

