(function ($) {
  'use strict';

  $(document).ready(function () {
    stickyHeader();
    swiperActivation();
    cartNumberIncDec();
    filter();
    niceSelect();
    sideMenu();

    // Optional calls – check if defined before calling
    if (typeof searchOption === 'function') {
      searchOption();
    }
    if (typeof modalOver === 'function') {
      modalOver();
    }
  });

  function stickyHeader() {
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 150) {
        $('.header--sticky').addClass('sticky');
      } else {
        $('.header--sticky').removeClass('sticky');
      }
    });
  }

  function swiperActivation() {
    let defaults = {
      spaceBetween: 30,
      slidesPerView: 2
    };

    function initSwipers(defaults = {}, selector = ".swiper-data") {
      let swipers = document.querySelectorAll(selector);
      swipers.forEach((swiper) => {
        let optionsData = swiper.dataset.swiper
          ? JSON.parse(swiper.dataset.swiper)
          : {};
        let options = { ...defaults, ...optionsData };
        new Swiper(swiper, options);
      });
    }

    initSwipers(defaults);

    var sliderThumbnail = new Swiper(".slider-thumbnail", {
      spaceBetween: 20,
      slidesPerView: 3,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
      breakpoints: {
        991: {
          spaceBetween: 30,
        },
        320: {
          spaceBetween: 15,
        }
      },
    });

    new Swiper(".swiper-container-h12", {
      thumbs: {
        swiper: sliderThumbnail,
      },
    });
  }

  function cartNumberIncDec() {
    $(".button").on("click", function () {
      var $button = $(this);
      var $parent = $button.parents('.quantity-edit');
      var oldValue = $parent.find('.input').val();

      var newVal = oldValue;
      if ($button.text() === "+") {
        newVal = parseFloat(oldValue) + 1;
      } else {
        newVal = oldValue > 1 ? parseFloat(oldValue) - 1 : 1;
      }

      $parent.find('a.add-to-cart').attr('data-quantity', newVal);
      $parent.find('.input').val(newVal);
    });

    $(".coupon-click").on('click', function () {
      $(this).parents('.coupon-input-area-1').find(".coupon-input-area").toggleClass('show');
    });

    $('.close-c1').on('click', function () {
      $(this).parents('.cart-item-1').addClass('deactive');
    });
  }

  function filter() {
    $(document).on('click', '.filter-btn', function () {
      var show = $(this).data('show');
      $(show).removeClass("hide").siblings().addClass("hide");
      $(this).addClass('active').siblings().removeClass('active');
    });
  }

  function niceSelect() {
    $('select').niceSelect(); // Plugin must already be included
  }

  function sideMenu() {
    $(document).on('click', '.menu-btn', function () {
      $("#side-bar").addClass("show");
      $("#anywhere-home").addClass("bgshow");
    });
    $(document).on('click', '.close-icon-menu, #anywhere-home, .onepage .mainmenu li a', function () {
      $("#side-bar").removeClass("show");
      $("#anywhere-home").removeClass("bgshow");
    });

    $('#mobile-menu-active').metisMenu();
    $('#category-active-four').metisMenu();
    $('#category-active-menu').metisMenu();
    $('.category-active-menu-sidebar').metisMenu();
  }

})(jQuery);
