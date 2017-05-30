<form action="/paymentRedirect" method="post">
{{csrf_field()}}
<!-- 	If you want the values in the payment page to be prefilled, you need to request them from the customer and POST them to the payment gateway. If not, the customer will have to fill them in the secure page on mobilpay.ro -->
    <fieldset>
        <legend>{!! $meta->getMeta('payment_title_fact') !!}</legend>
        <label>Prenume:</label><input type="text" name="billing_first_name" style="width: 200px;"/><br/>
        <label>Nume:</label><input type="text" name="billing_last_name" style="width: 200px;"/><br/>
        <label>Adresa:</label><textarea type="text" name="billing_address" style="width: 200px; height: 150px;"></textarea><br/>
        <label>E-mail:</label><input type="text" name="billing_email" style="width: 200px;"/><br/>
        <label>Telefon mobil:</label><input type="text" name="billing_mobile_phone" style="width: 200px;"/><br/>
    </fieldset>
    <fieldset>
        <legend>Completeaza datele pentru livrare</legend>
        <label>Prenume:</label><input type="text" name="shipping_first_name"  style="width: 200px;"/><br/>
        <label>Nume:</label><input type="text" name="shipping_last_name" style="width: 200px;"/><br/>
        <label>Adresa:</label><textarea type="text" name="shipping_address" style="width: 200px; height: 150px;"></textarea><br/>
        <label>E-mail:</label><input type="text" name="shipping_email" style="width: 200px;"/><br/>
        <label>Telefon mobil:</label><input type="text" name="shipping_mobile_phone" style="width: 200px;"/><br/>
    </fieldset>
    <input type="submit" value="Plateste">
</form>