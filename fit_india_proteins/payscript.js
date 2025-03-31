document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("paymentForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission for validation

        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let pincode = document.getElementById("pincode").value.trim();
        let cardNumber = document.getElementById("card_number").value.trim();
        let expDate = document.getElementById("exp_date").value.trim();
        let cvv = document.getElementById("cvv").value.trim();
        let cardType = document.getElementById("card_type").value;
        
        if (!name || !email || !pincode || !cardNumber || !expDate || !cvv || !cardType) {
            alert("Please fill in all required fields.");
            return;
        }
        
        if (!/^[a-zA-Z ]+$/.test(name)) {
            alert("Name can only contain letters and spaces.");
            return;
        }
        
        if (!/^[0-9]{6}$/.test(pincode)) {
            alert("Pincode must be a 6-digit number.");
            return;
        }
        
        if (!/^[0-9]{16}$/.test(cardNumber)) {
            alert("Card Number must be a 16-digit number.");
            return;
        }
        
        if (!/^[0-9]{3,4}$/.test(cvv)) {
            alert("CVV must be a 3 or 4-digit number.");
            return;
        }
        
        alert("Payment Successful!");
        this.submit();
    });
});