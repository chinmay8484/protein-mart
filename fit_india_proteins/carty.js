let cart = []; // Array to store cart items

// Function to update cart UI
function updateCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const viewCartButton = document.getElementById('view-cart');
    const checkoutButton = document.getElementById('checkout-button');

    // Update the cart UI
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
        checkoutButton.style.display = 'none';
    } else {
        let cartContent = '<ul>';
        cart.forEach(item => {
            cartContent += `<li>${item.name} - $${item.price}</li>`;
        });
        cartContent += '</ul>';
        cartItemsContainer.innerHTML = cartContent;
        checkoutButton.style.display = 'inline-block';
    }

    // Update view cart button
    viewCartButton.textContent = `View Cart (${cart.length})`;
}

// Add item to cart
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        const productId = button.getAttribute('data-product-id');
        const productName = button.getAttribute('data-product-name');
        const productPrice = parseFloat(button.getAttribute('data-product-price'));

        // Add product to cart
        cart.push({ id: productId, name: productName, price: productPrice });

        // Update cart UI
        updateCart();
    });
});

// View cart functionality
document.getElementById('view-cart').addEventListener('click', () => {
    document.getElementById('cart').style.display = 'block';
});

// Close cart
document.getElementById('close-cart').addEventListener('click', () => {
    document.getElementById('cart').style.display = 'none';
});

// Clear cart
document.getElementById('clear-cart-button').addEventListener('click', () => {
    cart = [];
    updateCart();
});

// Checkout button (just for demonstration)
document.getElementById('checkout-button').addEventListener('click', () => {
    alert('Proceeding to checkout...');
    // Add actual checkout logic here
});

<section id="cart" class="cart-container" style="display:none;">
        <h2>Your Shopping Cart</h2>
        <div id="cart-items">
            <p>Your cart is empty.</p>
        </div>
        <button id="checkout-button" style="display:none;">Checkout</button>
        <button id="clear-cart-button">Clear Cart</button>
        <button id="close-cart">Close Cart</button>
    </section>

#cart {
    padding: 20px;
    background-color: #f4eeee;
}

#cart-items {
    margin-bottom: 20px;
}

button {
    padding: 10px 20px;
    cursor: pointer;
    border: none;
}

#checkout-button, #clear-cart-button, #close-cart {
    background-color: #5cb85c;
    color: rgb(235, 122, 16);
    margin-top: 10px;
}

#cart {
    display: none;
}