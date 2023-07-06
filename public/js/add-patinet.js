// wrapper box
const moreInfoBtn = document.querySelectorAll(".more-info");

moreInfoBtn.forEach((ele) => {
  ele.addEventListener("click", (e) => {
    e.target.classList.toggle("active")
    const dataContent = e.target.nextElementSibling;
    if (dataContent.style.maxHeight) {
      dataContent.style.maxHeight = null;
    } else {
      dataContent.style.maxHeight = dataContent.scrollHeight + "px";
    }
    e.preventDefault();
  });
});
