
<form action="{{ route('payment.post') }}" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $data['key']?>"
        data-amount="<?php echo $data['amount']?>"
        data-currency="INR"
        data-name="<?php echo $data['name']?>"
        data-image="<?php echo $data['image']?>"
        data-description="<?php echo $data['description']?>"
        data-prefill.name="<?php echo $data['prefill']['name']?>"
        data-prefill.email="<?php echo $data['prefill']['email']?>"
        data-prefill.contact="<?php echo $data['prefill']['contact']?>"
        data-notes.shopping_order_id="3456"
        data-order_id="<?php echo $data['order_id']?>"
    >
    </script>
    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
    <input type="hidden" name="shopping_order_id" value="3456">
    @csrf
</form>
