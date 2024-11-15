document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.querySelector(".menu-toggle");
  const links = document.querySelector(".links");

  menuToggle.addEventListener("click", function () {
    // Toggle the "active" class on both the menu toggle and links
    menuToggle.classList.toggle("active");
    links.classList.toggle("active");

    // Optionally toggle a separate "open" class if needed
    this.classList.toggle("open");
  });
});


(function ($) {
    "use strict";

    new WOW().init();
// navbar cart
    $(".cart_link > a").on("click", function (e) {  
        e.preventDefault();
        $(".mini_cart").addClass("active");
    });

    $(".mini_cart_close > a").on("click", function (e) {
        e.preventDefault();
        $(".mini_cart").removeClass("active");
    });

    // sticky navbar
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
        } else {
            $(".sticky-header").addClass("sticky");
        }

    });
    // background image
    function databackgroundimage() {
        $("[data-bgimg]").each(function () {  
            var bgImgUrl = $(this).data("bgimg");  
            $(this).css({
                "background-image": "url(" + bgImgUrl + ")"  
            });
        });
    }
    
    $(window).on("load", function () {
        databackgroundimage();
    });
    
    // Carousel slider settings
    $(".slider_area").owlCarousel({
        animateOut: "fadeOut",  
        autoplay: true,
        loop: true,
        nav: false,
        autoplayTimeout: 5000,
        items: 1,
        dots: true,
    });
    
  
  
})(jQuery);
