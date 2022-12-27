jQuery(document).ready(function ($) {
    /*BTN ICON Location*/
    $('.btn_main.btn_blue,.btn_main.btn_white-f').append('<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<path d="M6.33325 14.1667L14.6666 5.83337" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
        '<path d="M6.33325 5.83337H14.6666V14.1667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>\n' +
        '</svg>');
    $('.btn_main.btn_contact').prepend('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 448C48 456.8 55.16 464 64 464H384C392.8 464 400 456.8 400 448V192H48V448z"/></svg>');
    $('.btn-cube').prepend('<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 13L14 1" stroke="#003359" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 1H14V13" stroke="#003359" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>');
    /*END*/
    function scrollNav() {
        if ($(window).scrollTop() >= 20) {
            $('.header_fluid').addClass('fade_shadow')
        } else {
            $('.header_fluid').removeClass('fade_shadow')
        }
    }

    scrollNav();
    $(window).scroll(function () {
        scrollNav()
    })

    $("html").on("click", ".anchor_link", function (event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1000);
    });
    $('#hamb_button').click(function () {
        if ($(this).hasClass('is-active')) {
            $('.bg').removeClass('active')
            $('.mobile_menu').removeClass('active')
            $('#hamb_button').removeClass('is-active')
            $('.header_fluid').removeClass('bg_color')

        } else {
            $('.bg').addClass('active')
            $('.mobile_menu').addClass('active')
            $('#hamb_button').addClass('is-active')
            $('.header_fluid').addClass('bg_color')
        }
    })
    $(window).resize(function () {

        if ($(window).width() >= 768) {
            $('.bg').removeClass('active')
            $('.mobile_menu').removeClass('active')
            $('#hamb_button').removeClass('is-active')
        } else {
            $('#menu-header-menu .parent span').html('<i class="fal fa-angle-left"></i>')
        }
    })
    $('.bg').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            $('.mobile_menu').removeClass('active')
            $('#hamb_button').removeClass('is-active')
        }

    })
    $('li.has-child span').click(function () {
        if (
            $(this).closest("li.has-child").hasClass("active")) {
            $(this).closest("li.has-child").removeClass("active");
            $(this).closest("li.has-child").find(".sub-menu").slideUp();
        } else {
            $('li.has-child').removeClass("active");
            $(this).closest("li.has-child").toggleClass("active");
            $('li.has-child span').closest("li.has-child").find(".sub-menu").slideUp();
            $(this).closest("li.has-child").find(".sub-menu").slideDown();
        }
    })
    /*SLIDER IMAGES*/
    $('.slider_images.slider_blog').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        pauseOnFocus:false,
        pauseOnHover:false,
        infinite:true,
        touchMove: false,
        swipeToSlide: true,
        draggable:true,
        arrows: true,
        dots: true,
        touchThreshold: 18,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });


    $('.slider_images').slick({
        centerMode: true,
        centerPadding: '100px',
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite:true,
        touchMove: false,
        swipeToSlide: true,
        autoplay: true,
        draggable:true,
        autoplaySpeed: 4000,
        pauseOnFocus:false,
        pauseOnHover:false,
        arrows: false,
        dots: false,
        touchThreshold: 18,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '40px',
                }
            },
        ]
    });

    /*END*/
/*ANIMATION SVG GRAPH*/
    var controller = new ScrollMagic.Controller();
    $(function () {
        let revealElements = document.getElementsByClassName("number-count");
        let numbers = document.querySelector(".section_numbers");
        function pathPrepare ($el=null) {
            let lineLength = $el[0].getTotalLength();
            $el.css("stroke-dasharray", lineLength);
            $el.css("stroke-dashoffset", lineLength);
        }
        // prepare SVG
        if ($("path#path_line")){
            let $word = $("path#path_line");
            pathPrepare($word);
        }
        var scene = new ScrollMagic.Scene({
            triggerElement: ".col_svg_line",
            offset: 100,
            reverse:false,
        })
            .setClassToggle(".col_svg_line","show_line")
            .addTo(controller); //scene svg
        for (let i=0; i<revealElements.length; i++) {
            let start = revealElements[i].innerHTML;
            let end = revealElements[i].dataset.max;
            var scene_1 = new ScrollMagic.Scene({
                triggerElement: numbers,
                offset: -100,
                reverse:false,
            })
                .on("enter", function () {
                    let interval = setInterval(function() {
                        revealElements[i].innerHTML = ++start;
                        if(start == end) {
                            clearInterval(interval);
                        }
                    }, 7);
                })
                .addTo(controller);
        }
});
    // Animation
    var controller = new ScrollMagic.Controller();
    $(function () {
        let revealElements = document.querySelectorAll(".col-c-v");
        for (let i=0; i<revealElements.length; i++) { // create a scene for each element
            new ScrollMagic.Scene({
                triggerElement: revealElements[i], //  value not modified, so we can use element as trigger as well
                offset: -200,												 // start a little later
            })
                .on("enter" , function (){
                    revealElements[i].classList.add('visible_'+ i);
                })
                // 							.addIndicators({name: "digit " + (i+1) }) // add indicators (requires plugin)
                .addTo(controller);
        }
    });

});
/*SCROLL SECTION*/
if (document.documentElement.clientWidth > 768) {
    const scrollContainer = document.querySelector(".slider_reviews_8");
    if(scrollContainer){
        scrollContainer.addEventListener("wheel", (evt) => {
            evt.preventDefault();
            scrollContainer.scrollLeft += evt.deltaY;
        });
    }
}




