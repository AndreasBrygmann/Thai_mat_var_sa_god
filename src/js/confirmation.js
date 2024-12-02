let basket = JSON.parse(localStorage.getItem("cart"));

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', start)
} else {
    start()
}

function start() {

    let breakNode = document.createElement("br");
    document.getElementById("ordercount").setAttribute("value", basket.length);

    for (let index = 0; index < basket.length; index++) {
        let varenr = document.createElement("INPUT");
        varenr.setAttribute("type", "hidden");
        varenr.setAttribute("name", "varenr_" + index.toString());
        varenr.setAttribute("value", basket[index].id);

        let qty = document.createElement("INPUT");
        qty.setAttribute("type", "hidden");
        qty.setAttribute("name", "antall_" + index.toString());
        qty.setAttribute("value", basket[index].qty);

        document.getElementById("confirmationData").appendChild(varenr);
        document.getElementById("confirmationData").appendChild(qty);
        document.getElementById("confirmationData").appendChild(breakNode);
    }
}