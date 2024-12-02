/* Retrieves the basket from locastorage as an array */
let basket = JSON.parse(localStorage.getItem("cart"));

/* Ensures the the functions only start running once the document is loaded */
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', start)
} else {
    start()
}

function start() {
    /* If the basket is emty, the content of the basket is removed and replace with a message for the user */
    if (basket === undefined || basket == null || basket.length < 1) {
        console.log("empty basket is running");
        let content = document.getElementsByClassName("cart-container")[0];
        while (content.hasChildNodes()) {
            content.removeChild(content.lastChild);
        }
        content.innerHTML = "Handlekurven er tom";
    }
    else {
        /* Clears the table before the contents are loaded */
        let table = document.getElementById("cartElements");
        var rowLength = table.rows.length;
        for (let index = rowLength-1; index >= 0; index--) {
            table.deleteRow(index); 
            
        }
        addCartItems(table);
    }
    cartTotal();
};

/* Loads the contents of the basket into a table */
function addCartItems(table) {
    let i = 0; /* used to keep track of the index value of the basket array */
    basket.forEach(element => {
    let row = table.insertRow(i);
    let cellID = row.insertCell(0);
    let cellName = row.insertCell(1);
    let cellPrice = row.insertCell(2);
    let cellQTY = row.insertCell(3);
    let cellDEL = row.insertCell(4);

    cellID.innerHTML = basket[i].id;
    cellName.innerHTML = basket[i].name;
    cellPrice.innerHTML = basket[i].price;
    /* Loads the quantity of the item and adds buttons for increasing and decreasing the quantity. The index value is used to ID the item */
    cellQTY.innerHTML = `<button class="QTY" type="button" onclick="decrement(${i})">-</button> ${basket[i].qty} <button class="QTY" type="button" onclick="increment(${i})">+</button>`;
    /* Adds a button for deleting items */
    cellDEL.innerHTML = `<button class="deleteCartItem" type="button" onclick="deleteCartItem(${i})">X</button>`;
    i += 1;
    });
    
    
};

/* Deletes cart items by creating a temporary arrat without the deleted item and replacing the basket array with the temporary arry. */
function deleteCartItem(id) {
    let selectedItem = id;
    let temp = [];
    for (let index = 0; index < basket.length; index++) {
        if (index != id) {
            temp.push({
                id: basket[index].id, 
                name: basket[index].name,
                price: basket[index].price,
                qty: basket[index].qty,
            })
        }
        
    }
    basket = temp;
    localStorage.setItem("cart", JSON.stringify(basket));
    start();
}

/* Increases the qunatity of an item */
function increment(id) {
    let selectedItem = id;
    /* We set the maximum allowed qunatity of any item to 10. This is because larger orders should go through the catering service */
    if (basket[selectedItem].qty > 9) {
        alert("Max tillatte antall er 10. Kontakt catering service for større ordrer.");
        return;
    }
    else {
        basket[selectedItem].qty += 1;
    }
    localStorage.setItem("cart", JSON.stringify(basket));
    start();

}

/* Decreases the quantity of an item */
function decrement(id) {
    let selectedItem = id;
    /* The quantity cannot go below 1, if the user attempts to decrease below 1, the function terminates */
    if (basket[selectedItem].qty === 1) {
        return;
    }
    else {
        basket[selectedItem].qty -= 1;
    }
    localStorage.setItem("cart", JSON.stringify(basket));
    start();
}

/* Keeps track of the total sum for the basket. */
function cartTotal() {
    let total = 0;
    for (let index = 0; index < basket.length; index++) {
        let rawtext = basket[index].price;
        /* For each item, the currency "Kr" is removed from the string */
        let result = rawtext.replace("kr", "");
        /* The price is converted to an integer and multiplied with the quantity of the item */
        let linetotal = Number(result.trim()) * Number(basket[index].qty);
        total += linetotal;
    }
    document.getElementById("cartTotal").innerHTML = "SUM " + total + " kr";
}