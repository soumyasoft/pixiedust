@extends('layouts.master')
@section('title') {{ 'Psychic Reading' }} @stop
@section('keywords'){{ 'Psychic Reading' }} @stop
@section('description'){!! 'Psychic Reading' !!} @stop
@section('content')



<div class="container mtb50">
    <div class="time-scdle">
        <div class="row"> 
            <div class="col-md-12">
                <h1 class="title"><span style="color:#000; font-size:20px;">Psysichic Reading Time Schedule</span></h1><br>
            </div>
            <div class="col-md-12">
                <div class="col-md-6 wk">
                    {!! $getReaders->description !!}
                </div>

                <div class="col-md-6" style="padding-right:6px;">                
                    <table width="100%" border="1" cellspacing="5" cellpadding="5" class="time-tbl">
                        <tr>
                            <th width="50%" style="background:#f0f8ff;">Timing</th>
                            <th width="50%" style="background:#f0f8ff;">Price</th>
                        </tr>

                        @foreach($getReadersPrices as $getReadersPrice)
                        <tr>
                            <td>{{ date("i",strtotime($getReadersPrice->intutive_timing)) }} Mins</td>
                            <td>${{ $getReadersPrice->price }}</td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
        <hr>        
        <form>
            <div class="time-scdle-fm">
                <div class="row mb15"> 
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Date</label>
                        <input type="date" class="form-control" id="inputDate" onchange="checkAvailableTime(this.value)">
                        <span id="err_msg" style="color: red; display: none;"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Time</label>
                        <select id="inputState" class="form-control">
                            <option selected="">15 Minute</option>
                            <option>30 Minute</option>
                            <option>45 Minute</option>
                        </select>
                    </div>
                </div>     


                <div class="row">
                    <div class="col-md-12">                                
                        @foreach(getTimeFrame15Min() as $key=> $time15min)   
                        <label class="st">
                            <input type="radio" id="book_{{ $key+1 }}"  name="radio" value="{{ $time15min }}"><span class="st-text">{{ $time15min }}</span>
                            <span class="checkmark"></span>
                        </label>
                        @endforeach
                    </div>
                </div>   

                <button type="button" id="book_btn" class="btn btn-primary pull-right mt10" onclick="return bookingIntutiveReading()">Book</button>
                <div class="clearfix"></div>
            </div> 
        </form>

    </div>
</div>
<div id="ajax_loader" class="loader">
    <span style="position:relative; top:50%;">        
        <div class="spinner"></div>
    </span>
</div>

@endsection

@push('script')
<script>


    $(function () {
        var today = new Date().toISOString().split('T')[0];
        $("#inputDate")[0].setAttribute('min', today);
        $('label input[id^="book"]').click(function () {

            var x = validateBook();
            if (x == true) {
                var clickedTime = $(this).val();
                var url = "{{ url('/') }}";
                console.log(clickedTime);
            }
        })

    });

    function validateBook() {
        var inputDate = $("#inputDate").val();
        if (inputDate == "") {
            $("#err_msg").delay(2000).fadeOut().html("Please enter date.").show();
            return false;
        } else {
            checkAvailableTime(inputDate);
            return true;
        }

    }

    function bookingIntutiveReading() {
        var x = validateBook();
        var sessId = "{{ session()->get('user_id') }}";
        if (sessId == "") {
            window.location.href = "user-login";
        }
        if (x == true) {
            $('label input[id^="book"]').click(function () {
                var clickedTime = $(this).val();
                var url = "{{ url('/') }}";
                console.log(clickedTime);
            });
        }
    }

    function checkAvailableTime(inputDate) {
        if (inputDate) {
            $("#ajax_loader").show();
            var url = "{{ url('/check-int-available-time') }}";
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {'date': inputDate},
                success: function (response) {

                }
            });
        }
    }

</script>

@endpush