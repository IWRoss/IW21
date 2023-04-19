import { get } from "../utils/utils";

import ajaxRequest from "../xhr/xhr";

export default async function () {
  const rssElement = get(".block-podcast-feed");

  if (!rssElement) {
    return false;
  }

  let payload = new FormData();

  // Add the nonce
  payload.append("nonce", iw.nonce);

  payload.append("url", iw.rssUrl);

  // Convert the form data to a string
  payload = new URLSearchParams(payload).toString();

  ajaxRequest(
    iw.ajaxUrl,
    "process_ajax_rss_feed_get_request",
    payload,
    () => {
      rssElement.innerHTML = '<span class="rss-loader">Loading...</span>';
    },
    (error) => {
      rssElement.innerHTML = error.data.message;
    },
    (response) => {
      rssElement.innerHTML = response.data.join("");
    }
  );
}
