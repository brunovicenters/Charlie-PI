function truncateText(selector, maxLength) {
  var element = document.querySelector(selector),
    truncated = element.innerText;

  if (truncated.length > maxLength) {
    truncated = truncated.substr(0, maxLength) + "...";
  }
  return truncated;
}
let cards = document.querySelectorAll(".card-text");
cards.forEach((card) => {
  let c = `.${card.classList[1]}`;
  document.querySelector(c).innerText = truncateText(c, 200);
});
