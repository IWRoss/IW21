import navigation from "./navigation/navigation";
import $ from "jquery";
import lity from "lity";
import skipLinkFocusFix from "./skip-link-focus-fix/skip-link-focus-fix";
import chatExperience from "./chat-experience/chat-experience";
import rss from "./rss/rss";

/**
 * Initialize all scripts.
 */
navigation();

skipLinkFocusFix();

chatExperience();

rss();

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

/**
 * When the user clicks on a modal button, open the related modal
 */
$("[data-iw-modal]").on("click", function (e) {
  e.preventDefault();

  if ($(this).data("iw-modal") == "open") {
    $("#" + $.attr(this, "rel")).fadeIn();
  }

  if ($(this).data("iw-modal") == "close") {
    $(".iw-modal").fadeOut();
  }
});

/**
 * Fade out the modal when the user clicks outside of it
 */
$(window).on("click", function (e) {
  if ($(e.target).hasClass("iw-modal")) {
    $(e.target).fadeOut();
  }
});

let resizeTimer;

// We need to wait for the window to load before we start calculating heights
$(window).on("resize", function (e) {
  clearTimeout(resizeTimer);

  $(".site-tagline").css("opacity", "0");

  resizeTimer = setTimeout(function () {
    $(".site-tagline").css("opacity", "1");
  }, 500);
});

/**
 * Wrap iframes in a div for responsive styling
 */
$("iframe").wrap('<div class="video-wrapper" />');

/**
 * Remove the S from the date field
 */
$(".coblocks-field.coblocks-field--date").on("change", function () {
  $(this).val($(this).val().replace("S ", " "));
});

/**
 * Swap text in the hero
 */
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

/**
 * Add a class to the menu item if the submenu overflows the menu
 */
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

/**
 * Pin the meta on scroll
 */
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

/**
 * Tuck the menu away when scrolling down
 */
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
