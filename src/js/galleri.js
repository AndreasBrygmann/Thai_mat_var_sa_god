const imgModal = () => {

    let modalEle = document.querySelector(".modal");
    let modalImage = document.querySelector(".modal-content");
    let captionText = document.querySelector(".caption");
    Array.from(document.querySelectorAll(".single-picture")).forEach(pic => {
        pic.addEventListener("click", (e) => {
            modalEle.style.display = "block";
            modalImage.src = e.target.src;
            captionText.innerHTML = e.target.alt;
        });
    });

    document.querySelector(".close").addEventListener("click", () => {
        modalEle.style.display = "none";
    });

}