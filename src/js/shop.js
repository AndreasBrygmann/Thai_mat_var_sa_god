/* The following ensures that the code doesn't run iuntil the document is fully loaded */
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', start)
} else {
    start()
}

function start() {
    /* Adds the onclick function to the addToCart button. */
    let addToCartButtons = document.getElementsByClassName('submit-btn')
    for (let i = 0; i < addToCartButtons.length; i++) {
        let button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }
}
//This function will first atempt to retrieve an existing array from localstorage. Failling that, it will create an empty array.
let basket = JSON.parse(localStorage.getItem("cart")) || [];

function addToCartClicked(event) {
    /* retrieves the product info */
    let itemID = document.getElementsByClassName('varenr')[0].innerText
    let name = document.getElementsByClassName('navn')[0].innerText
    let price = document.getElementsByClassName('pris')[0].innerText
    try {
        /* If the product has a "Tilpass" function it forces the user to select a value from "Tilpass" */
        let select = document.getElementsByClassName('select-box')[0].value
        if (select != null) {
            if (select === "") {
                alert("Vennligst tilpass produkt");
                return;
            }
            /* Once the value has been selected, the value is added on to the name of the product */
            else {
                name = name + " - " + select;
            }
        }
    } catch (error) { }

    addItemToCart(itemID, name, price);
}

function addItemToCart(itemID, name, price) {
    /* Before the item is added to the basket we first check ti see if the item is alredy added */
    let search = searchBasketItem(name);
    if (search != null) {
        /* If the item is alredy in the basket, the quantity of that item is increased by 1 */
        basket[search].qty += 1;
    }
    else {
        /* Otherwise, the item is added to the basket */
        basket.push({
            id: itemID,
            name: name,
            price: price,
            qty: 1,
        })
    }
    /* The basket is stored in an array stored in locastorage */
    /* locastorage ensures that the basket is stored regardless of how the users navigates the site. */
    localStorage.setItem("cart", JSON.stringify(basket));
    alert("Produktet er lagt til handlekurven.");
}
/* searches the basket for a name and returns the index in the array */
function searchBasketItem(name) {
    for (let index = 0; index < basket.length; index++) {
        if (name == basket[index].name) {
            return index;
        }
    }
    return null;
}

