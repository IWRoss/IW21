/**
 * File main.js.
 */

(function ($) {
  /**
   * Smooth scroll on anchor click.
   *
   * @link https://stackoverflow.com/questions/7717527/smooth-scrolling-when-clicking-an-anchor-link
   */
  var $root = $("html, body");

  $("a[href*=\\#]").on("click", function (e) {
    if ($.attr(this, "href").indexOf(location.href) === -1) {
      return;
    }

    e.preventDefault();

    if (!$.attr(this, "rel") || $.attr(this, "rel") === "noopener noreferrer") {
      $root.animate(
        {
          scrollTop: $($.attr(this, "href")).offset().top,
        },
        300
      );
    }
  });

  $("[data-iw-modal]").on("click", function (e) {
    e.preventDefault();

    if ($(this).data("iw-modal") == "open") {
      $("#" + $.attr(this, "rel")).fadeIn();
    }

    if ($(this).data("iw-modal") == "close") {
      $(".iw-modal").fadeOut();
    }
  });

  $(window).on("click", function (e) {
    if ($(e.target).hasClass("iw-modal")) {
      $(e.target).fadeOut();
    }
  });

  /**
   * Masonry layout.
   *
   * External js: masonry.pkgd.min.js, imagesloaded.pkgd.min.js
   */
  var options = {
    itemSelector: ".grid-item",
    columnWidth: ".masonry-grid-sizer",
    gutter: ".masonry-gutter-sizer",
    percentPosition: true,
    transitionDuration: 0,
  };

  // We need to wait for the window to load before we start calculating heights
  $(window).load(function () {
    $(window).on("resize", function (e) {
      clearTimeout(resizeTimer);

      $(".site-tagline").css("opacity", "0");

      resizeTimer = setTimeout(function () {
        // $masonryGrid.masonry();

        $(".site-tagline").css("opacity", "1");

        textFit($(".equal-height-grid .path-item-mixed .path-item--content"), {
          maxFontSize: 20,
        });
      }, 500);
    });

    var $pathItems = $(".path-item");

    $pathItems.each(function (index) {
      $(this)
        .delay(300 * index + 500)
        .queue(function () {
          $(this).removeClass("path-item--hidden").dequeue();
        });
    });

    textFit($(".equal-height-grid .path-item-mixed .path-item--content"), {
      maxFontSize: 20,
    });
  });

  $("iframe").wrap('<div class="video-wrapper" />');

  // function fade() {
  //   return false;
  //   var animation_height = $(window).innerHeight() * 0.25;
  //   var ratio = Math.round((1 / animation_height) * 10000) / 10000;

  //   $(".fade, .block-media-text").each(function () {
  //     var $this = $(this);
  //     var objectTop = $(this).offset().top;
  //     var windowBottom = $(window).scrollTop() + $(window).innerHeight();

  //     if (objectTop < windowBottom - animation_height) {
  //       $this.addClass("visible");
  //     }
  //   });
  // }

  // /**
  //  * Fade sections in on scroll
  //  */
  // $(window).on("load", function () {
  //   // $( '.fade' ).css( 'opacity', 0 );

  //   fade();
  // });

  // $(window).on(
  //   "scroll",
  //   $.throttle(16, function () {
  //     fade();
  //   })
  // );

  $(".coblocks-field.coblocks-field--date").on("change", function () {
    $(this).val($(this).val().replace("S ", " "));
  });

  $("span[data-swap]").each(function () {
    var i = 0,
      el = this,
      swaps = $(this).data("swap").split("|"),
      totalSwaps = swaps.length;

    function animateText() {
      setTimeout(function () {
        $(el).animate(
          {
            maxWidth: 0,
            opacity: 0,
          },
          1000,
          function () {
            $(el).html(swaps[i % totalSwaps]);

            setTimeout(function () {
              $(el).animate(
                {
                  maxWidth: "50vw",
                  opacity: 1,
                },
                1000
              );
            }, 300);
          }
        );

        i++;
      }, 2000);
    }

    animateText();

    setInterval(function () {
      animateText();
    }, 4000);
  });

  $(".menu-item-has-children").on("mouseover", function () {
    var $parent = $(this).parent(".menu"),
      $child = $(this).find(".sub-menu");

    var itOverlaps =
      $child.offset().top +
        $child.height() -
        $parent.offset().top -
        $parent.height() >
      0;

    if (itOverlaps) {
      $(this).addClass("long-submenu");
    }
  });

  $(".entry-pinned-meta").each(function () {
    if (typeof ScrollTrigger == "undefined") {
      return;
    }

    ScrollTrigger.create({
      trigger: $(this).parent(),
      start: "top center",
      end: "bottom center",
      pin: $(this),
    });

    ScrollTrigger.create({
      trigger: ".entry-content",
      start: "top top",
      end: "bottom bottom",
      onEnter: () => $(this).addClass("visible"),
      onLeave: () => $(this).removeClass("visible"),
      onEnterBack: () => $(this).addClass("visible"),
      onLeaveBack: () => $(this).removeClass("visible"),
    });
  });

  let previousScroll = 0;

  $(window).on("scroll", function (e) {
    let currentScroll = $(this).scrollTop(),
      $nav = $(".main-navigation, .site-branding");

    if (currentScroll <= 100) {
      $nav.removeClass("we-have-scrolled");
    } else {
      $nav.addClass("we-have-scrolled");
    }

    if (currentScroll <= 100 || currentScroll < previousScroll) {
      $nav.removeClass("tucked-away-nicely");
    } else {
      $nav.addClass("tucked-away-nicely");
    }

    previousScroll = currentScroll;
  });
})(jQuery);
