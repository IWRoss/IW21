// Utils
export function get(selector, root = document, index = 0) {
  let qS = root.querySelectorAll(selector);
  return qS[index] === undefined ? null : qS[index];
}

export function getAll(selector, root = document) {
  return root.querySelectorAll(selector);
}

export function getDelay(str) {
  return str.split(" ").length * 80 + 300;
}

export function isScrolledIntoView(el) {
  const rect = el.getBoundingClientRect();
  const elemTop = rect.top;
  const elemBottom = rect.bottom;

  // Partially visible elements return true:
  const isVisible = elemTop < window.innerHeight && elemBottom >= 0;

  return isVisible;
}
