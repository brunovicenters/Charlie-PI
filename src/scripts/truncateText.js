function truncateText(selector, maxLength) {
  var element = document.querySelector(selector),
    truncated = element.innerText;

  if (truncated.length > maxLength) {
    truncated = truncated.substr(0, maxLength) + "...";
  }
  return truncated;
}
document.querySelector(".card-text").innerText = truncateText(
  ".card-text",
  200
);
