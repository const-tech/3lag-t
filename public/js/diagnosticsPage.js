const previewBtn = document.querySelector("#preview-btn");
const popupBg = document.querySelector(".popup-bg");
const sendBtn = document.querySelector(".send-btn");
const closePopupBtn = document.querySelector(".popup-close-btn");

// create the popup
previewBtn.addEventListener("click", () => setPopup());
sendBtn.addEventListener("click", () => revPopup());
closePopupBtn.addEventListener("click", () => revPopup());

document.body.addEventListener("click", (e) => {
  // check if user want to close the popup by clicked the popup bg layout
  if (e.target.classList.contains("popup-bg")) {
    revPopup();
  }
});

function setPopup() {
  popupBg.classList.add("popupBg-active");
  document.body.style.overflow = "hidden";
}
function revPopup() {
  popupBg.classList.remove("popupBg-active");
  document.body.style.overflow = "auto";
}
