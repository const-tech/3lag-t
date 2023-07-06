// Click tog-show
if (document.querySelector(".tog-show")) {
    let togglesShow = document.querySelectorAll(".tog-show");
    togglesShow.forEach((e) => {
        let togg = true;
        e.addEventListener("click", (evt) => {
            let listItem = document.querySelector(e.getAttribute("data-show"));
            if (togg == true) {
                listItem.style.display = "flex";
                togg = false;
            } else {
                listItem.style.display = "none";
                togg = true;
            }
        });
    });
}

// scroll top effect
const upBtn = document.querySelector(".up-btn");

if(upBtn) {
    window.addEventListener("scroll", () =>
        this.scrollY >= 160
            ? upBtn.classList.add("show")
            : upBtn.classList.remove("show")
    );

    upBtn.addEventListener("click", () =>
        this.scrollTo({
            top: 0,
            behavior: "smooth",
        })
    );
}

// print
if (document.getElementById("prt-content")) {
    var btnPrtContent = document.getElementById("btn-prt-content");
    btnPrtContent.addEventListener("click", printDiv);

    function printDiv() {
        var prtContent = document.getElementById("prt-content");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(prtContent.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
}

// loader window
if (document.querySelector(".loader-container")) {
    document.body.classList.add("overflow-hidden");
    const loaderContainer = document.querySelector(".loader-container");
    window.addEventListener("load", () => {
        setTimeout(() => {
            loaderContainer.classList.add("hidden-loader");
            document.body.classList.remove("overflow-hidden");
        }, 200);
    });
}
