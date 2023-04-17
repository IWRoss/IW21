import { get } from "../utils/utils";

import { extract } from "@extractus/feed-extractor";

export default async function () {
  const rssElement = get(".block-rss");

  if (!rssElement) {
    return false;
  }

  const result = await extract("https://news.google.com/rss");

  console.log(result);
}
