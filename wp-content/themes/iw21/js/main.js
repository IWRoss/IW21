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

  $("a[href*=#]").click(function (e) {
    e.preventDefault();

    if (!$.attr(this, "rel")) {
      $root.animate(
        {
          scrollTop: $($.attr(this, "href")).offset().top,
        },
        300
      );
    }
  });

  $("[data-iw-modal]").click(function (e) {
    e.preventDefault();

    if ($(this).data("iw-modal") == "open") {
      $("#" + $.attr(this, "rel")).fadeIn();
    }

    if ($(this).data("iw-modal") == "close") {
      $(".iw-modal").fadeOut();
    }
  });

  $(window).click(function (e) {
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
    var $dynamicTextCache = [
      $(".site-tagline-first-line").html(),
      $(".site-tagline-second-line").html(),
    ];

    // Initialise Dynamo
    $(".dynamic-text").dynamo();

    var $masonryGrid = $(".masonry-grid")
      .imagesLoaded(function () {
        // init Masonry after all images have loaded
        $masonryGrid.masonry(options);
      })
      .progress(function (instance, image) {
        // If any images break, we need to make sure it doesn't break the layout
        if (!image.isLoaded) {
          // Let's add a broken image replacement
          // image.img.src = templateDir + '/imgs/nosrc.png';

          // Reset layout
          $masonryGrid.masonry(options);
        }
      });

    /**
     * Infinite scroll.
     *
     * Loads more posts when user reaches the bottom.
     */
    var currentPage = 1,
      bufferPage = 2,
      $feed = $("#feed");

    var loadPosts = function () {
      if (
        $feed.length &&
        $(window).scrollTop() + $(window).height() > $(document).height() - 100
      ) {
        if (currentPage < bufferPage) {
          currentPage++;

          $.ajax({
            url: ajaxpagination.ajaxurl,
            type: "post",
            data: {
              action: "ajax_feed_pagination",
              id: ajaxpagination.id,
              options: ajaxpagination.options,
              paged: bufferPage,
            },
            beforeSend: function () {
              $("#loader").show();
            },
            success: function (result) {
              $masonryGrid.append(result);

              $masonryGrid.masonry("reloadItems").masonry("layout");

              $("#loader").hide();

              if ($(result).filter(".grid-item").length == ajaxpagination.ppp) {
                bufferPage++;
              }
            },
          });
        }
      }
    };

    $(window).on("scroll", loadPosts);

    var resizeTimer;

    $(window).on("resize", function (e) {
      clearTimeout(resizeTimer);

      resizeTimer = setTimeout(function () {
        $masonryGrid.masonry();

        // Dynamo functions
        $(".site-tagline-first-line").html($dynamicTextCache[0]);

        $(".site-tagline-second-line").html($dynamicTextCache[1]);

        $(".dynamic-text").dynamo();

        textFit($(".equal-height-grid .path-item-mixed .path-item--content"), {
          maxFontSize: 20,
        });
      }, 1000);
    });

    if ($(window).height() === $(document).height()) {
      loadPosts();
    }

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

  // Parallax functions
  $(window).scroll(function () {
    var windowHeight = $(this).height(),
      scrollTop = $(this).scrollTop();

    // $( '.parallax' ).css( 'backgroundPosition', '50% ' + scrollTop / 4 + 'px' );
  });

  $("iframe").wrap('<div class="video-wrapper" />');
})(jQuery);
