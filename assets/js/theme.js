"use strict"; // Start of use strict


//Contact Form Validation
function contactFormValidation () {
    if($('.contact_us_form').length){
        $('.contact_us_form').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true
                },
                subject: {
                    required: true
                }
            },
            submitHandler: function (form) { 
                // sending value with ajax request
                $.post($(form).attr('action'), $(form).serialize(), function (response) {
                    $(form).parent('div').append(response);
                    $(form).find('input[type="text"]').val('');
                    $(form).find('input[type="email"]').val('');
                    $(form).find('textarea').val('');
                });
                return false;
            }
        });
    }
}
contactFormValidation ();

// add your custom functions 
function serviceCarosule () {
    if ($('.service_box_area .owl-carousel').length) {
        $('.service_box_area .owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            height:300,
            margin:30,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items:1
                },
                480:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                },
                1200:{
                    items:3
                },
                1920:{
                    items:3
                },
            }
        });
    }
}

// add your custom functions 
function projectCarosule () {
    if ($('#project .owl-carousel').length) {
        $('#project .owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            height:300,
            margin:10,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            autoplay: true,
            smartSpeed: 1500,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items:1
                },
                480:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:4
                },
                1200:{
                    items:4
                },
                1920:{
                    items:4
                },
            }
        });
    }
}
projectCarosule();

// add your custom functions 
function testimonialsCarosule () {
    if ($('#testimonials .owl-carousel').length) {
        $('#testimonials .owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: true,
            autoplay: false,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items:1
                },
                480:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                },
                1200:{
                    items:1
                },
                1920:{
                    items:1
                }
            }
        });
    }
}
// add your custom functions 
function CounterNumberChanger () {
    var timer = $('.timer');
    if(timer.length) {
        timer.appear(function () {
            timer.countTo();
        })
    }

}
// add your custom functions 
function clientCarosule () {
    if ($('#clients .owl-carousel').length) {
        $('#clients .owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            margin:70,
            autoWidth: true,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items:1
                },
                480:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                },
                1200:{
                    items:5
                }
            }
        });
    }
}

// wow activator
function wowActivator () {
    var wow = new WOW ({
        offset: 0
    });
    wow.init();
}

// instance of fuction while Document ready event   
jQuery(document).on('ready', function() {
    (function($) {
        serviceCarosule();
        testimonialsCarosule();
        clientCarosule();
        CounterNumberChanger();
        contactFormValidation();
        wowActivator();

    })(jQuery);
});


