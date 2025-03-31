document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Extract form data
        const formData = new FormData(form);
        let message = "Thank you for submitting your form!";
        
        alert(message);
        form.reset();  // Optionally reset the form after submission
    });
});

let cart = [];

function addToCart(productName, price) {
    const existingProduct = cart.find(item => item.name === productName);
    if (existingProduct) {
        existingProduct.quantity++;
        existingProduct.total = existingProduct.quantity * existingProduct.price;
    } else {
        cart.push({
            name: productName,
            price: price,
            quantity: 1,
            total: price
        });
    }
    alert(`${productName} added to cart!`);
    saveCart();
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
    }
}
loadCart();


function calculateBMI() {
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value) / 100;
  
    if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
      alert("Please enter valid weight and height values.");
      return;
    }
  
    const bmi = (weight / (height * height)).toFixed(2);
  
    document.getElementById('bmiValue').textContent = bmi;
    document.getElementById('result').style.display = 'block';
  
    let category = "";
    if (bmi < 18.5) {
      category = "Underweight";
    } else if (bmi >= 18.5 && bmi < 24.9) {
      category = "Normal weight";
    } else if (bmi >= 25 && bmi < 29.9) {
      category = "Overweight";
    } else {
      category = "Obesity";
    }
  
    document.getElementById('bmiCategory').textContent = `Category: ${category}`;
}

let trendfoods = document.querySelectorAll(".trendfoods");
let productcard = document.querySelectorAll(".productcard");

let count = 0;

trendfoods.forEach((imgs, index) => {
    imgs.style.left = `${index * 100}%`;
});

const myfun = () => {
    trendfoods.forEach((curImg) => {
        curImg.style.transform = `translateX(-${count * 100}%)`;
    });
};

setInterval(() => {
    count++;
    if (count == trendfoods.length) {
        count = 0;
    }
    myfun();
}, 4000);

productcard.forEach((curcard) => {
    curcard.addEventListener("click", function () {
        let div = document.createElement("div");
        div.classList.add("cardDetails");
        div.innerHTML = `
            <i id="icon" class="fa-solid fa-xmark"></i>
            <img src=${curcard.firstElementChild.src} alt="">
            <h2>Food Details</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>    
        `;
        document.querySelector("body").appendChild(div);
        document.querySelector("#icon").addEventListener("click", function () {
            div.remove();
        });
    });
});
