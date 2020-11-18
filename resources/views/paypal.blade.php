@extends('layouts.master')

@section('content')

<div class="container" style="background:#fff; padding-top:150px; padding-bottom:150px; margin-top:20px;">
    <div class="row">

        <div class="col-md-12">

            <p class="text-center" style="color:#006eb7; font-size:25px; line-height:30px;">
                <img class="irc_mi" src="http://gifimage.net/wp-content/uploads/2018/04/please-wait-gif-transparent-13.gif" width="50"><br>
                Please Wait....<br>

                Please do not refresh the page while we're redirecting you to Paypal.</p>

            <form action="{{ $URL }}" method="post" name="frm_paypal" id="frm_paypal">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value="1">
                <input type="hidden" name="business" value="{{ $paymentSetting->paypal_email }}">	
                @foreach($orderedItems as $orderedItem)
                <input type="hidden" name="item_number_{{ $loop->iteration }}" value="{{ $orderedItem->id }}">
                <input type="hidden" name="item_name_{{ $loop->iteration }}" value="{{ $orderedItem->products->name }}">
                <input type="hidden" name="quantity_{{ $loop->iteration }}" value="{{ $orderedItem->quantity }}">
                <input type="hidden" name="amount_{{ $loop->iteration }}" value="{{ $orderedItem->unit_price }}">		
                @endforeach	
                <input type="hidden" name="shipping_1" value="{{ $getMasterOrders->shipping_amount }}">
                <input type="hidden" name="discount_amount_cart" value="{{ $getMasterOrders->discount_amount }}">
                <input type="hidden" name="tax_cart" value="0.00">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="custom" value="{{ $getMasterOrders->id }}">
                <!--<input type="hidden" name="notify_url" value="{{ url('/api/notify-paypal') }}">-->
                <input type="hidden" name="return" value="{{ url('/thankyou') }}">
                <input type="hidden" name="cancel_return" value="{{ url('/') }}">
            </form>

        </div>
    </div>
</div>
<script type="text/javascript">
    document.frm_paypal.submit();
</script>

@endsection