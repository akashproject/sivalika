@extends('layouts.admin')

@section('content')


<div id="printDiv" class="card" style="width:80%;margin:auto;padding: 0 20px;overflow: hidden;">
    <style>
        .bg-light-gray{
            border-bottom: 1px solid #ccc;
            background: #f3f2f2;
        }
    </style>
    @php
        $total = $booking->amount;
    @endphp
    <div class="form-group row">
        <div for="name" class="col-sm-4 text-left control-label col-form-label"> 
            <img src="https://hotels.sivalikagroup.com/assets/img/logo.png" alt="homepage" class="light-logo" style="width: 80px;">
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            <span ><h4>{{ $hotel}} </h4></span >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 text-left control-label col-form-label">
            <p style="margin:0"> Invoice No : {{ rand(111111,999999) }} </p>
            <p style="margin:0"> Booking No : {{ $booking->booking_id}} </p>
            <p style="margin:0"> Customer Name : Akash Dutta </p>
            <p> Customer Mobile : 9836555023 </p>
        </div>
        <div class="col-sm-6 text-right control-label col-form-label">
            <p style="margin:0"> Invoice Date : {{ date("d/m/Y") }} </p>
            <p style="margin:0"> Check in Date : {{ date("d M, Y",strtotime($booking->checkin)) }} </p>
            <p style="margin:0"> Check out Date : {{ date("d M, Y",strtotime($booking->checkout)) }} </p>
        </div>
    </div>
    <div class="row" style="border-bottom: 1px solid #ccc;background: #f3f2f2;">
        <div class="col-sm-4 text-left control-label col-form-label">
            <h4 >Item</h4 >
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            <h4 >Qty</h4 >
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            <h4 >Price</h4 >
        </div>
    </div>
    @foreach(json_decode($booking->rooms) as $key => $value)
        @if(!empty($value))
        <div class="row">
            <div class="col-sm-4 text-left control-label col-form-label">
                <span >{{get_room_by_id($key)->name}}</span >
            </div>
            <div class="col-sm-4 text-left control-label col-form-label">
                <span >{{ count((array)$value) }}</span >
            </div>
            <div class="col-sm-4 text-left control-label col-form-label">
                <span >₹{{get_room_by_id($key)->cost*count((array)$value)}}/-</span >
            </div>
        </div>
        @endif
    @endforeach
    @if($diningMeta !== null)
    @php
        $diningData = json_decode($diningMeta->meta_value,true);
        $total += array_sum($diningData['price'])
    @endphp
    <div class=" row">
        <div class="col-sm-4 text-left control-label col-form-label">
            @foreach($diningData['name'] as $value)
                <p> {{$value}} </p>
            @endforeach
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            @foreach($diningData['qty'] as $value)
                <p> {{$value}} </p>
            @endforeach
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            @foreach($diningData['price'] as $value)
                <p> ₹{{$value}}/- </p>
            @endforeach
        </div>
    </div>
    @endif
    @if($additionalCharge !== null)
    @php
        $additionalChargeData = json_decode($additionalCharge->meta_value,true);
        $total += array_sum($additionalChargeData['price'])
    @endphp
    <div class="row">
        <div class="col-sm-4 text-left control-label col-form-label">
            @foreach($additionalChargeData['service'] as $value)
                <p> {{$value}} </p>
            @endforeach
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            1
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            @foreach($additionalChargeData['price'] as $value)
                <p> ₹{{$value}}/- </p>
            @endforeach
        </div>
    </div>
    @endif
    <div class="form-group row">
        <div class="col-sm-4 text-left control-label col-form-label">
            <p style="margin:0">GST NO : 19AEMPJ0819C2ZN</p>
            <p style="margin:0">Prepered by : SISIR</p>
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            <p style="margin:0">Paid : <strong>₹{{$paidAmount}}</strong>/-</p>
            <p style="margin:0">Due : <strong>₹{{$total-$paidAmount}}</strong>/-</p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4 text-left control-label col-form-label">
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            <h4 >Total Price</h4 >
            <h4>  ₹{{number_format($total)}}/- </h4 >
        </div>
    </div>
    <div class="form-group row" style="border: 1px solid #ccc;background: #f3f2f2;">
        <div class="col-sm-12 text-left control-label col-form-label">
            <h4> Amount in Words : {{ ucfirst(numberToWords($total)) }}</h4 >
        </div>
    </div>

    <div class="form-group row mt-5">
        <div class="col-sm-4 text-left control-label col-form-label">
            <p>Signeture of Customer</p>
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
        </div>
        <div class="col-sm-4 text-left control-label col-form-label">
            <p>Signeture of Cashier</p>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-12 text-center control-label col-form-label">
            <h4><strong>Thank you for staying with us<strong></h4>
        </div>
    </div>
</div>
<div class="col-sm-2 text-left control-label col-form-label"> <a href="javascript:void(0)" onclick="printDiv('printDiv');" class="btn btn-success"> Print </a> </div>
@endsection
@section('script')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection

