document.querySelectorAll(".order-status").forEach(select => {
    select.addEventListener("change", function () {
        const orderId = this.getAttribute("data-id");
        const newStatus = this.value;

        fetch("update_order_status.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ order_id: orderId, order_status: newStatus })
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => console.error("Error:", error));
    });
});

function deleteOrder(orderId) {
    if (confirm("Are you sure you want to delete this order?")) {
        fetch("delete_order.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ order_id: orderId })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(error => console.error("Error:", error));
    }
}
