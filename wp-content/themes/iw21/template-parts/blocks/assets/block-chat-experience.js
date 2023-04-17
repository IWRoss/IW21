(function () {
  const chatExperienceElement = get(".block-chat-experience-reveal");

  let chatExperience = new Reveal(chatExperienceElement, {
    embedded: true,
    controls: false,
    keyboard: true,
    touch: false,
    maxScale: 1,
    progress: false,
    center: false,
  });

  window.addEventListener("scroll", (event) => {
    if (
      !isScrolledIntoView(chatExperienceElement) ||
      chatExperience.isReady()
    ) {
      return false;
    }

    chatExperience.initialize().then(() => {
      printScript(slides[0].text).then(() => {
        printResponses(slides[0].responses);
      });

      chatExperience
        .getRevealElement()
        .querySelectorAll(".next-button")
        .forEach((el) =>
          el.addEventListener("click", () => chatExperience.next())
        );
    });
  });

  chatExperience.on("slidechanged", (event) => {
    const chatbox = get(".block-chat-pane", document, event.indexh);

    if (chatbox && chatbox.childNodes.length) {
      return false;
    }

    printScript(slides[event.indexh].text, event.indexh).then(() => {
      printResponses(slides[event.indexh].responses, event.indexh);
    });
  });

  const timer = (ms) => new Promise((res) => setTimeout(res, ms));

  async function printScript(script, slide = 0) {
    for (let msg of script) {
      let index = chatExperience.getIndices();

      if (index.h === slide) {
        await timer(200);

        appendMessage(msg.side, "...", slide, true);

        await timer(getDelay(msg.text));

        get(".loading-msg", get(".block-chat-pane", document, slide)).remove();
      }

      appendMessage(msg.side, msg.text, slide);
    }
  }

  async function printResponses(responses, slide = 0) {
    for (let response of responses) {
      appendResponse(response, slide);
    }

    getAll(
      ".btn-bubble",
      get(".block-chat-responses", document, slide)
    ).forEach((btn) =>
      btn.addEventListener("click", (event) => {
        chatExperience[event.target.dataset.revealAction]();
      })
    );
  }

  function appendMessage(side, text, slide, loading = false) {
    const msgHTML = `
        <div class="block-chat-msg ${side}-msg ${loading ? "loading-msg" : ""}">
          <div class="block-chat-bubble">
            <div class="block-chat-text">${text}</div>
          </div>
        </div>
      `;

    const msgerChat = get(".block-chat-pane", document, slide);
    msgerChat.insertAdjacentHTML("beforeend", msgHTML);
    msgerChat.scrollTop += 500;
  }

  function appendResponse(response, slide) {
    const responseHTML = `
        <button class="btn-bubble" data-reveal-action="${response.action}">
          ${response.text}
        </button>
      `;

    const msgerReponses = get(".block-chat-responses", document, slide);
    msgerReponses.insertAdjacentHTML("beforeend", responseHTML);
  }

  // Utils
  function get(selector, root = document, index = 0) {
    let qS = root.querySelectorAll(selector);
    return qS[index] === undefined ? null : qS[index];
  }

  function getAll(selector, root = document) {
    return root.querySelectorAll(selector);
  }

  function getDelay(str) {
    return str.split(" ").length * 80 + 300;
  }

  function isScrolledIntoView(el) {
    const rect = el.getBoundingClientRect();
    const elemTop = rect.top;
    const elemBottom = rect.bottom;

    // Partially visible elements return true:
    const isVisible = elemTop < window.innerHeight && elemBottom >= 0;

    return isVisible;
  }
})();
