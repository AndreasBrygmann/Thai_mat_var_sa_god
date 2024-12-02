const hamburgerMenu = () => {
    const hamburger = document.getElementById('hamburger');
    const navUL = document.getElementById('nav-ul');

    hamburger.addEventListener('click', () => {
        navUL.classList.toggle('show');
    });
}

//Not in use, changed from js to php
/* const activeButtons = () => {
    const menuBtns = document.querySelector("#menu-btns");
    const buttons = menuBtns.querySelectorAll("li button");

    const btnArrays = Array.from(buttons);

    btnArrays.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const currentBtn = e.target;
            const activeBtn = menuBtns.querySelector(".active");

            // Remove "active" class from previously active button, if any
            if (activeBtn) {
                activeBtn.classList.remove("active");
            }

            // Add "active" class to clicked button
            currentBtn.classList.add("active");
        });
    });
}
 */
