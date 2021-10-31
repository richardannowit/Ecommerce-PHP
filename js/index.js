//----------Details------//
let addToCart = (id, quantity) => {
    let productPackage = {
        "id": id,
        "quantity": quantity
    }
    let cartFromStorage = JSON.parse(window.localStorage.getItem('cart')) || [];
    let productIndex = cartFromStorage.findIndex((obj => obj.id === id));
    if (productIndex !== -1) {
        cartFromStorage[productIndex].quantity = quantity;
    } else {
        cartFromStorage.push(productPackage);
    }
    window.localStorage.setItem('cart', JSON.stringify(cartFromStorage));
}

let successSnackbar = () => {
    return new Snackbar({
        message: "Message Here",
        status: "success"
    });
}
$(document).ready(function () {
    $("#add_to_cart").click(function () {
        var id = $("#product_id").val();
        var quantity = $("#quantity").val();
        addToCart(id, quantity);
        Snackbar.show({ text: 'Thêm vào giỏ hàng thành công.' });
    });
});