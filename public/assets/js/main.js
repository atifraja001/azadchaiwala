
	// owl carousel
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        autoplayTimeout:4000,
        paginationSpeed : 800,
        rewindSpeed : 1000,
        autoplayHoverPause:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:2
            }
        }
    });
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    // mobile menu close click anywhere in screen
    $(document).ready(function () {
    $(document).click(function (event) {
        var clickover = $(event.target);
        var _opened = $(".collapse").hasClass("collapse show");
       var open = $(".collapse").attr("aria-expanded");
       
        if (_opened === true && !clickover.hasClass("navbar-toggler")) {
            $("button.navbar-toggler").click();
        }
	    });
	});


// accordian new
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}


// form validation


// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {

          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

// Input Masker
    $(document).ready(function(){
        $("#validationTooltip05").inputmask({"placeholder": "", 'mask':"99999-9999999-9"});
        $("#validationTooltip06").inputmask({"placeholder": "", 'mask':"0399-9999999"});
        $("input").inputmask({"placeholder": ""});
    });
//console.log(appurl);
    //ajax request
    $(document).ready(function () {
        $('#contact').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: appurl + '/add-contact',
                type: 'post',
                data: $(this).serialize(),
                success: function (r) {
                    let data = JSON.parse(r);
                    if (data['response'] == 'success') {
                        $('#success').show();
                        $('#contact').hide();
                        $('#error').hide();
                        $('#success_msg').text(data['msg']);
                    } else {
                        $('#error').show();
                        $('#success').hide();
                        $('#error_msg').text(data['msg']);
                    }
                }
            });
        });
    });


$(document).ready(function(){
    $('#suggestion_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: appurl + '/add-suggestion',
            type: 'post',
            data: $(this).serialize(),
            success:function(r){
                let data = JSON.parse(r);
                if (data['response'] == 'success') {
                    $('#success').show();
                    $('#suggestion_form').hide();
                    $('#error').hide();
                    $('#success_msg').text(data['msg']);
                } else {
                    $('#error').show();
                    $('#success').hide();
                    $('#error_msg').text(data['msg']);
                }
            }
        });
    });
});

// Reviews
    // vars
    'use strict'
    var	testim = document.getElementById("testim"),
        testimDots = Array.prototype.slice.call(document.getElementById("testim-dots").children),
        testimContent = Array.prototype.slice.call(document.getElementById("testim-content").children),
        testimLeftArrow = document.getElementById("left-arrow"),
        testimRightArrow = document.getElementById("right-arrow"),
        testimSpeed = 4500,
        currentSlide = 0,
        currentActive = 0,
        testimTimer,
        touchStartPos,
        touchEndPos,
        touchPosDiff,
        ignoreTouch = 30;
    ;

    window.onload = function() {

        // Testim Script
        function playSlide(slide) {
            for (var k = 0; k < testimDots.length; k++) {
                testimContent[k].classList.remove("active");
                testimContent[k].classList.remove("inactive");
                testimDots[k].classList.remove("active");
            }

            if (slide < 0) {
                slide = currentSlide = testimContent.length-1;
            }

            if (slide > testimContent.length - 1) {
                slide = currentSlide = 0;
            }

            if (currentActive != currentSlide) {
                testimContent[currentActive].classList.add("inactive");
            }
            testimContent[slide].classList.add("active");
            testimDots[slide].classList.add("active");

            currentActive = currentSlide;

            clearTimeout(testimTimer);
            testimTimer = setTimeout(function() {
                playSlide(currentSlide += 1);
            }, testimSpeed)
        }

        testimLeftArrow.addEventListener("click", function() {
            playSlide(currentSlide -= 1);
        })

        testimRightArrow.addEventListener("click", function() {
            playSlide(currentSlide += 1);
        })

        for (var l = 0; l < testimDots.length; l++) {
            testimDots[l].addEventListener("click", function() {
                playSlide(currentSlide = testimDots.indexOf(this));
            })
        }

        playSlide(currentSlide);

        // keyboard shortcuts
        document.addEventListener("keyup", function(e) {
            switch (e.keyCode) {
                case 37:
                    testimLeftArrow.click();
                    break;

                case 39:
                    testimRightArrow.click();
                    break;

                case 39:
                    testimRightArrow.click();
                    break;

                default:
                    break;
            }
        })

        testim.addEventListener("touchstart", function(e) {
            touchStartPos = e.changedTouches[0].clientX;
        })

        testim.addEventListener("touchend", function(e) {
            touchEndPos = e.changedTouches[0].clientX;

            touchPosDiff = touchStartPos - touchEndPos;

            console.log(touchPosDiff);
            console.log(touchStartPos);
            console.log(touchEndPos);


            if (touchPosDiff > 0 + ignoreTouch) {
                testimLeftArrow.click();
            } else if (touchPosDiff < 0 - ignoreTouch) {
                testimRightArrow.click();
            } else {
                return;
            }

        })
    }


