(function ($) {
  /**
   * Import ScrollTrigger
   */
  gsap.registerPlugin(ScrollTrigger);

  /**
   *
   */
  let active = 0, // Which chunk is in view
    loaded = 0; // What's the highest chunk loaded

  /**
   * Back off, browser, I got this... (if there's a history of scrolling)
   */
  if ("scrollRestoration" in history) {
    history.scrollRestoration = "manual";
  }

  /**
   * If there are any chunks already in the DOM, create a new ScrollTrigger for them
   */
  window.onload = function () {
    let targets = gsap.utils.toArray('.feed-item[data-index="1"]'),
      paged = urlParam("infsc");

    if (paged) {
      addPostsToFeed(paged);
    }

    for (let target of targets) {
      createNewScrollTrigger(target);
    }
  };

  /**
   *
   * @param {*} n
   */
  const urlParam = function (name) {
    var results = new RegExp("[?&]" + name + "=([^&#]*)").exec(
      window.location.href
    );

    if ($.isArray(results)) {
      return results[1];
    }

    return false;
  };

  /**
   *
   * @param {*} n
   */
  const updateURL = function (n) {
    if (!window.history.replaceState) {
      return false;
    }

    window.history.replaceState(n, n, "?infsc=" + n);
  };

  /**
   * Grab posts from database and add them to the feed
   * @param {*} n
   */
  const addPostsToFeed = function (n) {
    // Set up our HTTP request
    var xhr = new XMLHttpRequest();

    // Setup our listener to process completed requests
    xhr.onload = function () {
      let doc = new DOMParser().parseFromString(xhr.response, "text/html");

      const feed = document.getElementById("feed");

      let node = feed.appendChild(doc.body.children[0]);

      createNewScrollTrigger(node);

      while (doc.body.children.length > 0) {
        feed.appendChild(doc.body.children[0]);
      }
    };

    let data = {
      id: iw21Scroll.id,
      options: iw21Scroll.options,
      ppp: iw21Scroll.ppp,
      chunk: n,
    };

    let body = "body=" + JSON.stringify(data);

    xhr.open("POST", iw21Scroll.ajaxurl + "?action=ajax_feed_pagination");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(body);
  };

  /**
   *
   * @param {*} element
   */
  const createNewScrollTrigger = function (element) {
    ScrollTrigger.create({
      trigger: element,
      start: "top center",
      end: "bottom center",
      onEnter: () => {
        active = parseInt(element.dataset.chunk);

        if (active > loaded) {
          loaded = active;

          addPostsToFeed(active + 1);
        }

        updateURL(active);
      },
      onLeaveBack: () => {
        if (element == element.parentNode.firstElementChild) {
          return false;
        }

        active = parseInt(element.dataset.chunk) - 1;

        updateURL(active);
      },
    });
  };
})(jQuery);
