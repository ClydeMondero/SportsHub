<style><?php include "../styles/check-out.css" ?></style>
<section>
    <div class="checkout-container">
        <div class="title">
            <h1>Order Summary</h1>
        </div>
        <div class="infos">
            <span id="totalAmount">Total: ₱<?php echo number_format($total, 2, '.', ','); ?></span>
            <span>Shipping: Free</span>
        </div>
        <div class="checkout">
            <button class="checkout-btn" onclick="submitForm()">Check out</button>
        </div>
    </div>
</section>

<script>
    function submitForm() {
        var checkboxes = document.querySelectorAll('.cart-checkbox:checked');
        
        if (checkboxes.length > 0) {
            document.getElementById("checkoutForm").submit();
        } else {
            alert('Please select at least one item before checking out.');
        }
    }
</script>