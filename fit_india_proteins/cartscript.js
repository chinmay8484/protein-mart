// Empty cart array
let cart = [];

// Add product to cart
function addToCart(item, price) {
    // Check if item is already in cart to update quantity
    let existingItem = cart.find(product => product.item === item);
    if (existingItem) {
        existingItem.quantity++;
        existingItem.total = existingItem.quantity * existingItem.price;
    } else {
        cart.push({ item: item, price: price, quantity: 1, total: price });
    }

    updateCartTable();
}

// Update the cart table on the page
function updateCartTable() {
    const table = document.getElementById('cart-table');

    // Clear existing rows (except the header)
    table.innerHTML = `
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    `;

    let totalPrice = 0;

    cart.forEach(product => {
        totalPrice += product.total;
        table.innerHTML += `
            <tr>
                <td>${product.item}</td>
                <td>$${product.price}</td>
                <td>${product.quantity}</td>
                <td>$${product.total}</td>
            </tr>
        `;
    });

    document.getElementById('total-price').innerText = `Total: $${totalPrice}`;
}

// Checkout button action
function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
    } else {
        alert('Thank you for your purchase!');
        cart = [];
        updateCartTable();
        document.getElementById('total-price').innerText = 'Total: $0';
    }
}
