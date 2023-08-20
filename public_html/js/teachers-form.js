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
		});
		return false;
	});
});


$(document).ready(function () {

	//E-mail Ajax Send
	$("#form-gift-certificate").submit(function () { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function () {
			blpDel.style.visibility = "hidden";
			bflForm.classList.add("form-sended");
			ym(91722697, 'reachGoal', 'formGiftCertificateSent')
			setTimeout(function () {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});
});

