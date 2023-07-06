// Click tog-nav
if (document.querySelector(".tog-nav")) {
    let togNav = document.querySelectorAll(".tog-nav"),
        app = document.querySelector(".app");
    togNav.forEach((tog) => {
        tog.addEventListener("click", function () {
            app.classList.toggle("colse-and-open");
        });
    });
}

// Click add active
if (document.querySelector(".tog-active")) {
    let togglesShow = document.querySelectorAll(".tog-active");
    togglesShow.forEach((e) => {
      e.addEventListener("click", (evt) => {
        let divActive = document.querySelector(e.getAttribute("data-active"));
        divActive.classList.toggle("active");
      });
    });
  }
