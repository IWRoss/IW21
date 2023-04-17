const jQuery = require("jquery");

/*! Lity - v2.2.2 - 2017-07-17
 * http://sorgalla.com/lity/
 * Copyright (c) 2015-2017 Jan Sorgalla; Licensed MIT */

!(function (a, b) {
  "function" == typeof define && define.amd
    ? define(["jquery"], function (c) {
        return b(a, c);
      })
    : "object" == typeof module && "object" == typeof module.exports
    ? (module.exports = b(a, require("jquery")))
    : (a.lity = b(a, a.jQuery || a.Zepto));
})("undefined" != typeof window ? window : this, function (a, b) {
  "use strict";
  function c(a) {
    var b = B();
    return (
      N && a.length
        ? (a.one(N, b.resolve), setTimeout(b.resolve, 500))
        : b.resolve(),
      b.promise()
    );
  }
  function d(a, c, d) {
    if (1 === arguments.length) return b.extend({}, a);
    if ("string" == typeof c) {
      if (void 0 === d) return void 0 === a[c] ? null : a[c];
      a[c] = d;
    } else b.extend(a, c);
    return this;
  }
  function e(a) {
    for (
      var b,
        c = decodeURI(a.split("#")[0]).split("&"),
        d = {},
        e = 0,
        f = c.length;
      e < f;
      e++
    )
      c[e] && ((b = c[e].split("=")), (d[b[0]] = b[1]));
    return d;
  }
  function f(a, c) {
    return a + (a.indexOf("?") > -1 ? "&" : "?") + b.param(c);
  }
  function g(a, b) {
    var c = a.indexOf("#");
    return -1 === c ? b : (c > 0 && (a = a.substr(c)), b + a);
  }
  function h(a) {
    return b('<span class="lity-error"/>').append(a);
  }
  function i(a, c) {
    var d =
        (c.opener() && c.opener().data("lity-desc")) ||
        "Image with no description",
      e = b('<img src="' + a + '" alt="' + d + '"/>'),
      f = B(),
      g = function () {
        f.reject(h("Failed loading image"));
      };
    return (
      e
        .on("load", function () {
          if (0 === this.naturalWidth) return g();
          f.resolve(e);
        })
        .on("error", g),
      f.promise()
    );
  }
  function j(a, c) {
    var d, e, f;
    try {
      d = b(a);
    } catch (a) {
      return !1;
    }
    return (
      !!d.length &&
      ((e = b('<i style="display:none !important"/>')),
      (f = d.hasClass("lity-hide")),
      c.element().one("lity:remove", function () {
        e.before(d).remove(),
          f && !d.closest(".lity-content").length && d.addClass("lity-hide");
      }),
      d.removeClass("lity-hide").after(e))
    );
  }
  function k(a) {
    var c = J.exec(a);
    return (
      !!c &&
      o(
        g(
          a,
          f(
            "https://www.youtube" + (c[2] || "") + ".com/embed/" + c[4],
            b.extend({ autoplay: 1 }, e(c[5] || ""))
          )
        )
      )
    );
  }
  function l(a) {
    var c = K.exec(a);
    return (
      !!c &&
      o(
        g(
          a,
          f(
            "https://player.vimeo.com/video/" + c[3],
            b.extend({ autoplay: 1 }, e(c[4] || ""))
          )
        )
      )
    );
  }
  function m(a) {
    var c = M.exec(a);
    return (
      !!c &&
      (0 !== a.indexOf("http") && (a = "https:" + a),
      o(
        g(
          a,
          f(
            "https://www.facebook.com/plugins/video.php?href=" + a,
            b.extend({ autoplay: 1 }, e(c[4] || ""))
          )
        )
      ))
    );
  }
  function n(a) {
    var b = L.exec(a);
    return (
      !!b &&
      o(
        g(
          a,
          f("https://www.google." + b[3] + "/maps?" + b[6], {
            output: b[6].indexOf("layer=c") > 0 ? "svembed" : "embed",
          })
        )
      )
    );
  }
  function o(a) {
    return (
      '<div class="lity-iframe-container"><iframe frameborder="0" allowfullscreen src="' +
      a +
      '"/></div>'
    );
  }
  function p() {
    return z.documentElement.clientHeight
      ? z.documentElement.clientHeight
      : Math.round(A.height());
  }
  function q(a) {
    var b = v();
    b &&
      (27 === a.keyCode && b.options("esc") && b.close(),
      9 === a.keyCode && r(a, b));
  }
  function r(a, b) {
    var c = b.element().find(G),
      d = c.index(z.activeElement);
    a.shiftKey && d <= 0
      ? (c.get(c.length - 1).focus(), a.preventDefault())
      : a.shiftKey ||
        d !== c.length - 1 ||
        (c.get(0).focus(), a.preventDefault());
  }
  function s() {
    b.each(D, function (a, b) {
      b.resize();
    });
  }
  function t(a) {
    1 === D.unshift(a) &&
      (C.addClass("lity-active"), A.on({ resize: s, keydown: q })),
      b("body > *")
        .not(a.element())
        .addClass("lity-hidden")
        .each(function () {
          var a = b(this);
          void 0 === a.data(F) && a.data(F, a.attr(E) || null);
        })
        .attr(E, "true");
  }
  function u(a) {
    var c;
    a.element().attr(E, "true"),
      1 === D.length &&
        (C.removeClass("lity-active"), A.off({ resize: s, keydown: q })),
      (D = b.grep(D, function (b) {
        return a !== b;
      })),
      (c = D.length ? D[0].element() : b(".lity-hidden")),
      c.removeClass("lity-hidden").each(function () {
        var a = b(this),
          c = a.data(F);
        c ? a.attr(E, c) : a.removeAttr(E), a.removeData(F);
      });
  }
  function v() {
    return 0 === D.length ? null : D[0];
  }
  function w(a, c, d, e) {
    var f,
      g = "inline",
      h = b.extend({}, d);
    return (
      e && h[e]
        ? ((f = h[e](a, c)), (g = e))
        : (b.each(["inline", "iframe"], function (a, b) {
            delete h[b], (h[b] = d[b]);
          }),
          b.each(h, function (b, d) {
            return (
              !d ||
              !(!d.test || d.test(a, c)) ||
              ((f = d(a, c)), !1 !== f ? ((g = b), !1) : void 0)
            );
          })),
      { handler: g, content: f || "" }
    );
  }
  function x(a, e, f, g) {
    function h(a) {
      (k = b(a).css("max-height", p() + "px")),
        j.find(".lity-loader").each(function () {
          var a = b(this);
          c(a).always(function () {
            a.remove();
          });
        }),
        j.removeClass("lity-loading").find(".lity-content").empty().append(k),
        (m = !0),
        k.trigger("lity:ready", [l]);
    }
    var i,
      j,
      k,
      l = this,
      m = !1,
      n = !1;
    (e = b.extend({}, H, e)),
      (j = b(e.template)),
      (l.element = function () {
        return j;
      }),
      (l.opener = function () {
        return f;
      }),
      (l.options = b.proxy(d, l, e)),
      (l.handlers = b.proxy(d, l, e.handlers)),
      (l.resize = function () {
        m && !n && k.css("max-height", p() + "px").trigger("lity:resize", [l]);
      }),
      (l.close = function () {
        if (m && !n) {
          (n = !0), u(l);
          var a = B();
          if (
            g &&
            (z.activeElement === j[0] || b.contains(j[0], z.activeElement))
          )
            try {
              g.focus();
            } catch (a) {}
          return (
            k.trigger("lity:close", [l]),
            j.removeClass("lity-opened").addClass("lity-closed"),
            c(k.add(j)).always(function () {
              k.trigger("lity:remove", [l]),
                j.remove(),
                (j = void 0),
                a.resolve();
            }),
            a.promise()
          );
        }
      }),
      (i = w(a, l, e.handlers, e.handler)),
      j
        .attr(E, "false")
        .addClass("lity-loading lity-opened lity-" + i.handler)
        .appendTo("body")
        .focus()
        .on("click", "[data-lity-close]", function (a) {
          b(a.target).is("[data-lity-close]") && l.close();
        })
        .trigger("lity:open", [l]),
      t(l),
      b.when(i.content).always(h);
  }
  function y(a, c, d) {
    a.preventDefault
      ? (a.preventDefault(),
        (d = b(this)),
        (a = d.data("lity-target") || d.attr("href") || d.attr("src")))
      : (d = b(d));
    var e = new x(
      a,
      b.extend({}, d.data("lity-options") || d.data("lity"), c),
      d,
      z.activeElement
    );
    if (!a.preventDefault) return e;
  }
  var z = a.document,
    A = b(a),
    B = b.Deferred,
    C = b("html"),
    D = [],
    E = "aria-hidden",
    F = "lity-" + E,
    G =
      'a[href],area[href],input:not([disabled]),select:not([disabled]),textarea:not([disabled]),button:not([disabled]),iframe,object,embed,[contenteditable],[tabindex]:not([tabindex^="-"])',
    H = {
      esc: !0,
      handler: null,
      handlers: {
        image: i,
        inline: j,
        youtube: k,
        vimeo: l,
        googlemaps: n,
        facebookvideo: m,
        iframe: o,
      },
      template:
        '<div class="lity" role="dialog" aria-label="Dialog Window (Press escape to close)" tabindex="-1"><div class="lity-wrap" data-lity-close role="document"><div class="lity-loader" aria-hidden="true">Loading...</div><div class="lity-container"><div class="lity-content"></div><button class="lity-close" type="button" aria-label="Close (Press escape to close)" data-lity-close>&times;</button></div></div></div>',
    },
    I = /(^data:image\/)|(\.(png|jpe?g|gif|svg|webp|bmp|ico|tiff?)(\?\S*)?$)/i,
    J =
      /(youtube(-nocookie)?\.com|youtu\.be)\/(watch\?v=|v\/|u\/|embed\/?)?([\w-]{11})(.*)?/i,
    K = /(vimeo(pro)?.com)\/(?:[^\d]+)?(\d+)\??(.*)?$/,
    L = /((maps|www)\.)?google\.([^\/\?]+)\/?((maps\/?)?\?)(.*)/i,
    M = /(facebook\.com)\/([a-z0-9_-]*)\/videos\/([0-9]*)(.*)?$/i,
    N = (function () {
      var a = z.createElement("div"),
        b = {
          WebkitTransition: "webkitTransitionEnd",
          MozTransition: "transitionend",
          OTransition: "oTransitionEnd otransitionend",
          transition: "transitionend",
        };
      for (var c in b) if (void 0 !== a.style[c]) return b[c];
      return !1;
    })();
  return (
    (i.test = function (a) {
      return I.test(a);
    }),
    (y.version = "2.2.2"),
    (y.options = b.proxy(d, y, H)),
    (y.handlers = b.proxy(d, y, H.handlers)),
    (y.current = v),
    b(z).on("click.lity", "[data-lity]", y),
    y
  );
});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var isIe = /(trident|msie)/i.test(navigator.userAgent);

  if (isIe && document.getElementById && window.addEventListener) {
    window.addEventListener(
      "hashchange",
      function () {
        var id = location.hash.substring(1),
          element;

        if (!/^[A-z0-9_-]+$/.test(id)) {
          return;
        }

        element = document.getElementById(id);

        if (element) {
          if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
            element.tabIndex = -1;
          }

          element.focus();
        }
      },
      false
    );
  }
})();

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  var container, button, menu, links, i, len;

  container = document.getElementById("site-navigation");
  if (!container) {
    return;
  }

  button = container.getElementsByTagName("button")[0];
  if ("undefined" === typeof button) {
    return;
  }

  menu = container.getElementsByTagName("ul")[0];

  // Hide menu toggle button if menu is empty and return early.
  if ("undefined" === typeof menu) {
    button.style.display = "none";
    return;
  }

  menu.setAttribute("aria-expanded", "false");
  if (-1 === menu.className.indexOf("nav-menu")) {
    menu.className += " nav-menu";
  }

  button.onclick = function () {
    if (-1 !== container.className.indexOf("toggled")) {
      container.className = container.className.replace(" toggled", "");
      button.setAttribute("aria-expanded", "false");
      menu.setAttribute("aria-expanded", "false");
    } else {
      container.className += " toggled";
      button.setAttribute("aria-expanded", "true");
      menu.setAttribute("aria-expanded", "true");
    }
  };

  // Get all the link elements within the menu.
  links = menu.getElementsByTagName("a");

  // Each time a menu link is focused or blurred, toggle focus.
  for (i = 0, len = links.length; i < len; i++) {
    links[i].addEventListener("focus", toggleFocus, true);
    links[i].addEventListener("blur", toggleFocus, true);
  }

  /**
   * Sets or removes .focus class on an element.
   */
  function toggleFocus() {
    var self = this;

    // Move up through the ancestors of the current link until we hit .nav-menu.
    while (-1 === self.className.indexOf("nav-menu")) {
      // On li elements toggle the class .focus.
      if ("li" === self.tagName.toLowerCase()) {
        if (-1 !== self.className.indexOf("focus")) {
          self.className = self.className.replace(" focus", "");
        } else {
          self.className += " focus";
        }
      }

      self = self.parentElement;
    }
  }

  /**
   * Toggles `focus` class to allow submenu access on tablets.
   */
  (function (container) {
    var touchStartFn,
      i,
      parentLink = container.querySelectorAll(
        ".menu-item-has-children > a, .page_item_has_children > a"
      );

    if ("ontouchstart" in window) {
      touchStartFn = function (e) {
        var menuItem = this.parentNode,
          i;

        if (!menuItem.classList.contains("focus")) {
          e.preventDefault();
          for (i = 0; i < menuItem.parentNode.children.length; ++i) {
            if (menuItem === menuItem.parentNode.children[i]) {
              continue;
            }
            menuItem.parentNode.children[i].classList.remove("focus");
          }
          menuItem.classList.add("focus");
        } else {
          menuItem.classList.remove("focus");
        }
      };

      for (i = 0; i < parentLink.length; ++i) {
        parentLink[i].addEventListener("touchstart", touchStartFn, false);
      }
    }
  })(container);
})();

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
})(jQuery);
