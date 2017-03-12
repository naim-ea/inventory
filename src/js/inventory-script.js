var inventory = {};

inventory.searchBar = document.querySelector("input.search-bar");
inventory.selectPastry = document.querySelector("select.select-pastry");
inventory.selectCountry = document.querySelector("select.select-country");
inventory.sortBy = document.querySelector("select.sort-by");

inventory.form = document.querySelectorAll("form.form-cart");

inventory.pastryName = document.querySelectorAll("input.pastry-name");
inventory.countryName = document.querySelectorAll("input.country-name");
inventory.quantity = document.querySelectorAll("input.quantity");

inventory.modifyButton = document.querySelectorAll("a.modify-button");

inventory.cancelButton = document.createElement("a");
inventory.cancelButton.innerHTML = "Cancel";
inventory.cancelButton.setAttribute("href", "#");
inventory.cancelButton.classList.add("cancel-button");

inventory.confirmButton = document.createElement("button");
inventory.confirmButton.setAttribute("type", "submit")
inventory.confirmButton.innerHTML = "Confirm";
inventory.confirmButton.classList.add("confirm-button");

inventory.deleteButton = document.querySelectorAll("a.delete-button");
inventory.noButton = document.querySelectorAll("a.delete-conf-n");

inventory.addProduct = document.querySelector("div.new-item");
inventory.addButton = document.querySelector("a.add-product");



//SEARCH OF PRODUCTS BY PASTRY NAME INPUT
inventory.searchBar.addEventListener("keyup", function () {
    for (var i = 0; i < inventory.pastryName.length; i++) {
        if (inventory.pastryName[i].value.lastIndexOf(inventory.searchBar.value) == -1) {
            inventory.pastryName[i].parentElement.parentElement.parentElement.style.display = "none";
        } else if (inventory.searchBar.value == "") {
            inventory.pastryName[i].parentElement.parentElement.parentElement.style.display = "inline-block";
        } else {
            inventory.pastryName[i].parentElement.parentElement.parentElement.style.display = "inline-block";
        }
    }
});

//SEARCH OF PRODUCTS BY PASTRY NAME SELECT
inventory.selectPastry.addEventListener("change", function () {
    for (var i = 0; i < inventory.pastryName.length; i++) {
        if ((inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == inventory.pastryName[i].value && inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == inventory.countryName[i].value) || (inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == inventory.pastryName[i].value && inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == "") || (inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == "" && inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == inventory.countryName[i].value) || (inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == "" && inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == "")) {
            inventory.pastryName[i].parentElement.parentElement.parentElement.style.display = "inline-block";
        } else {
            inventory.pastryName[i].parentElement.parentElement.parentElement.style.display = "none";
        }
    }
})

//SEARCH OF PRODUCTS BY COUNTRY NAME SELECT
inventory.selectCountry.addEventListener("change", function () {
    for (var i = 0; i < inventory.countryName.length; i++) {
        if ((inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == inventory.countryName[i].value && inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == inventory.pastryName[i].value) || (inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == inventory.countryName[i].value && inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == "") || (inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == "" && inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == inventory.pastryName[i].value) || (inventory.selectPastry.options[inventory.selectPastry.selectedIndex].value == "" && inventory.selectCountry.options[inventory.selectCountry.selectedIndex].value == "")) {
            inventory.countryName[i].parentElement.parentElement.parentElement.style.display = "inline-block";
        } else {
            inventory.countryName[i].parentElement.parentElement.parentElement.style.display = "none";
        }
    }
})


//MODIFY ITEMS -> MAKE THE INPUTS CHANGEABLE + CHANGE THE ACTION OF THE FORM
for (var j = 0; j < inventory.modifyButton.length; j++) {
    inventory.modifyButton[j].addEventListener("click", function (e) {
        e.preventDefault();
        this.style.display = "none";
        this.parentElement.querySelector("a.delete-button").style.display = "none";
        this.parentElement.appendChild(inventory.cancelButton);
        this.parentElement.appendChild(inventory.confirmButton);
        inventory.modifyInputs = this.parentElement.querySelectorAll(".modify-input");
        for (var i = 0; i < inventory.modifyInputs.length; i++) {
            inventory.modifyInputs[i].disabled = false;
            inventory.modifyInputs[i].style.border = "1px solid #e6e6e6";
        }
        this.parentElement.parentElement.parentElement.querySelector("div.pastry-img input").style.display = "block";
    });
}

//CANCEL MODIFICATION
inventory.cancelButton.addEventListener("click", function (e) {
    e.preventDefault();
    this.parentElement.querySelector("a.delete-button").style.display = "inline-block";
    this.parentElement.querySelector("a.modify-button").style.display = "inline-block";
    this.parentElement.parentElement.parentElement.querySelector("div.pastry-img input.photo").style.display = "none";
    inventory.cancelButton.remove();
    inventory.confirmButton.remove();
    for (var i = 0; i < inventory.modifyInputs.length; i++) {
        inventory.modifyInputs[i].disabled = true;
        inventory.modifyInputs[i].style.border = "none";
    }
    location.reload();

});

//DELETE CONFIRMATION POP
for (var j = 0; j < inventory.deleteButton.length; j++) {
    inventory.deleteButton[j].addEventListener("click", function (e) {
        e.preventDefault();
        inventory.modifyInputs = this.parentElement.parentElement.querySelectorAll("input.modify-input");
        for (var i = 0; i < inventory.modifyInputs.length; i++) {
            inventory.modifyInputs[i].disabled = false;
        }
        this.parentElement.parentElement.parentElement.querySelector("div.delete-confirmation").style.display = "block";
        this.parentElement.parentElement.parentElement.setAttribute("action", "src/php_scripts/delete.php");
    });
}

//DON'T DELETE
for (var j = 0; j < inventory.noButton.length; j++) {
    inventory.noButton[j].addEventListener("click", function (e) {
        inventory.modifyInputs = this.parentElement.parentElement.querySelectorAll("input.modify-input");
        for (var i = 0; i < inventory.modifyInputs.length; i++) {
            inventory.modifyInputs[i].disabled = true;
        }
        e.preventDefault();
        this.parentElement.parentElement.style.display = "none";
        this.parentElement.parentElement.parentElement.setAttribute("action", "src/php_scripts/change.php");
    });
}

//ADD NEW PRODUCT
inventory.addButton.addEventListener("click", function (e) {
    e.preventDefault();
    inventory.newProduct = "<form action='src/php_scripts/add_product.php' method='post' class='form-cart' enctype='multipart/form-data'><div class='pastry-img'>   <input required type='file' name='photo' class='add-photo'><label for='photo'>Upload a photo</label></div><div class='pastry-info'>    <div class='container'>        <input required type='text' name='pastry' class='modify-input pastry-name' placeholder='Pastry name'>        <input required type='text' name='country'  class='modify-input country-name' placeholder='Country'> <textarea required name='description' class='modify-input' placeholder='Description'></textarea>       <input required type='number' name='quantity' class='modify-input quantity' placeholder='Quantity'>        <input required type='number' name='price' class='modify-input' placeholder='Price'>   <a href='#' class='stop-add'>Cancel</a>        <button type='submit' class='confirm-add'>Add</button></div></div></form>";
    inventory.addProduct.innerHTML = inventory.newProduct;
    inventory.addProduct.scrollIntoView();
    inventory.stopAdd = document.querySelector("a.stop-add");
    inventory.stopAdd.addEventListener("click", function (e) {
        e.preventDefault();
        inventory.addProduct.innerHTML = " ";
    });
});