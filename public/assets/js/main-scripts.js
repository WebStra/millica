$(document).ready(function () {

    $("#img_01").elevateZoom({
        gallery: 'gal1',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
    });

//pass the images to Fancybox
    $("#thumbs").bind("click", function (e) {
        var ez = $('#img_01').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });


    $('.open_search_input').click(function (event) {
        event.preventDefault();

        if ($('#search_bar').is(':hidden')) {
            $('#search_bar').toggle(200);
        } else {
            $('#search_bar').hide(200);
        }
    });


    $('.first_slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1

    });
      $('.gallery_slide_res').slick({
        dots: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1

    });
    $('.products_slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 4,
        prevArrow: ".prev_products",
        nextArrow: ".next_products",
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]

    });
    $('.products_sale_slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 4,
        prevArrow: ".prev_products_sale",
        nextArrow: ".next_products_sale",
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]

    });
    $('.assorted_slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 4,
        prevArrow: ".prev_assorted",
        nextArrow: ".next_assorted",
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]

    });
    $('.similar_products_slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        speed: 300,
        slidesToShow: 4,
        prevArrow: ".prev_similar_products",
        nextArrow: ".next_similar_products",
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 4, // 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        arrows: false,
        centerMode: true,
        centerPadding: '50px',
        focusOnSelect: true
    });

});

jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function () {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });
});

// $(window).load(function () {
//
//     var preloaderDelay = 350,
//         preloaderFadeOutTime = 200;
//
//     function hidePreloader() {
//         var loadingAnimation = $('#loading-animation'),
//             preloader = $('#preloader');
//
//         loadingAnimation.fadeOut();
//         preloader.delay(preloaderDelay).fadeOut(preloaderFadeOutTime);
//     }
//
//     hidePreloader();
//
// });


$('.increment_value').click(function(){
    console.log();
    var element_obj = $(this).parents('div.handle-counter').children('input.quantity');
    var current_val = parseInt(element_obj.val(), 10);
    current_val = isNaN(current_val) ? 0 : current_val;

    if (current_val < element_obj.attr('max')) {
        current_val++;
        element_obj.val(current_val);
    }
});


$('.decrement_value').click(function(){

    var element_obj = $(this).parents('div.handle-counter').children('input.quantity');
    var current_val = parseInt(element_obj.val(), 10);
    current_val = isNaN(current_val) ? 0 : current_val;

    if (current_val > 1) {
        current_val--;
        element_obj.val(current_val);
    }
});


        
    