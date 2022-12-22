//set html class to 'js'
document.querySelector('.no-js').classList.add('js');
document.querySelector('.no-js').classList.remove('no-js');


/*set 'fullheight' elements to be 100vh minus the header height*/
fullHeight();
function fullHeight(){
    const windowHeight = window.innerHeight;
    const windowWidth = window.innerWidth;
	const headerHeight = document.querySelector('.header-main').offsetHeight;
    let fullHeight = windowHeight - headerHeight ;
    if(windowHeight > windowWidth && fullHeight > 700){ //if the screen is portrait and the height is greater than 700px, limit the fullheight value (useful for portrait desktops)
        fullHeight = 700
    };
	document.querySelector('.page-title ').style.marginTop = headerHeight + 'px';
    document.querySelectorAll('.full-height').forEach(div => {
        div.style.minHeight = fullHeight + 'px'
    });
}
window.addEventListener("resize", fullHeight);

/* When Mobile Menu Toggle*/
var burger = document.querySelector("div.burger");
burger.addEventListener("click", function() {
  burger.classList.toggle("is-active");
});


/*Slick Slider*/
$(document).ready(function(){

    $('.testimonial-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
		autoplay: true,
        adaptiveHeight: true
      });

	$(".slider").slick({
	infinite: true,
	arrows: false,
	dots: false,
	autoplay: false,
	speed: 800,
	slidesToShow: 1,
	slidesToScroll: 1,
	});

	//ticking machine
	var percentTime;
	var tick;
	var time = 1;
	var progressBarIndex = 0;

	$('.progressBarContainer .progressBar').each(function(index) {
	    var progress = "<div class='inProgress inProgress" + index + "'></div>";
	    $(this).html(progress);
	});

	function startProgressbar() {
	    resetProgressbar();
	    percentTime = 0;
	    tick = setInterval(interval, 10);
	}

	function interval() {
	    if (($('.slider .slick-track div[data-slick-index="' + progressBarIndex + '"]').attr("aria-hidden")) === "true") {
	        progressBarIndex = $('.slider .slick-track div[aria-hidden="false"]').data("slickIndex");
	        startProgressbar();
	    } else {
	        percentTime += 1 / (time + 5);
        $('.inProgress').parent().parent().removeClass("yellow-text");
		$('.inProgress' + progressBarIndex).parent().parent().addClass("yellow-text");
	        $('.inProgress' + progressBarIndex).css({
	            width: percentTime + "%"
	        });
	        if (percentTime >= 100) {
	            $('.single-item').slick('slickNext');
	            progressBarIndex++;
	            if (progressBarIndex > 2) {
	                progressBarIndex = 0;
	            }
	            startProgressbar();
	        }
	    }
	}

	function resetProgressbar() {
	    $('.inProgress').css({
	        width: 0 + '%'
	    });
	    clearInterval(tick);
	}
	startProgressbar();
	// End ticking machine

	$('.progressBarContainer div').click(function () {
		clearInterval(tick);
		var goToThisIndex = $(this).find("span").data("slickIndex");
		$('.single-item').slick('slickGoTo', goToThisIndex, false);
		startProgressbar();
	});	
});

