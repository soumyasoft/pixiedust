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
                    <div  class="col-md-12 text-center" style="height: 20px;">
                        <span id="err_msg_booking" style="display:none;color: red;"></span>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAddress">Date</label>
                        <input type="date" class="form-control" id="inputDate" onchange="checkAvailableTime(this.value)">
                        <span id="err_msg" style="color: red; display: none;"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Time</label>
                        <select id="inputMins" class="form-control">
                            @foreach($getReadersPrices as $getReadersPrice)
                            <option value="{{date("i",strtotime($getReadersPrice->intutive_timing)) }}">{{ date("i",strtotime($getReadersPrice->intutive_timing)) }} Minute</option> 
                            @endforeach
                        </select>
                    </div>
                </div>       

                <div class="row" id="time_data"> 
                    <div id="old_data">
                        @foreach(getTimeFrame15Min() as $key=> $time15min)                    
                        <div class="col-md-3 time-box"><span style="cursor: pointer;" id="book_{{ $key+1 }}" onclick="checkBooking(this.id)" >{{ $time15min }}</span></div>
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

    function checkBooking(id) {
        var ID = id;
        var x = validateBook();
        if (x == true) {
            var bookTime = $("#" + id).html();
            $('.row .time-box span').removeClass('psychic_reading');
            $("#" + id).toggleClass("psychic_reading");
            // Current Time Check
            var today = new Date();
            //var time = today.getHours() + ":" + today.getMinutes();
            var time = "11:00";
            if (bookTime > time) {
                var bookTimeMins = $("#inputMins").val();
                var bookDate = $("#inputDate").val();
                var count = bookTimeMins / 15;
                var endTime = addMinutes(bookTime, bookTimeMins);
                var timeArray = new Array();
                var URL = "{{ url('/ajax-available-time') }}";
                if (endTime <= "17:00") {
                    for (var i = 0; i <= count - 1; i++) {
                        var x = addMinutes(bookTime, 15 * i);
                        timeArray.push(x);
                    }
                    if (timeArray != "") {
                        $("#ajax_loader").show();
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            data: {'bookDate': bookDate, 'timeArray': timeArray},
                            success: function (response) {
                                $("#ajax_loader").hide();
                                console.log(response);
                            }
                        });
                    }
                } else {
                    $("#" + id).removeClass("psychic_reading");
                    $("#err_msg_booking").delay(2000).fadeOut().html("Service time exceed.").show();
                }

            } else {
                $("#" + id).removeClass("psychic_reading");
                $("#err_msg_booking").delay(2000).fadeOut().html("Please select greater than current time.").show();
            }


        }
    }
    function addMinutes(time, minsToAdd) {
        function D(J) {
            return (J < 10 ? '0' : '') + J
        }
        ;
        var piece = time.split(':');
        var mins = piece[0] * 60 + +piece[1] + +minsToAdd;
        return D(mins % (24 * 60) / 60 | 0) + ':' + D(mins % 60);
    }

    $(function () {
        var today = new Date().toISOString().split('T')[0];
        $("#inputDate")[0].setAttribute('min', today);
        checkBooking();

    });

    function validateBook() {
        var inputDate = $("#inputDate").val();
        if (inputDate == "") {
            $("#err_msg").delay(2000).fadeOut().html("Please enter date.").show();
            return false;
        } else {
            //checkAvailableTime(inputDate);
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
            $("#err_msg_booking").delay(2000).fadeOut().html("Please enter booking time.").show();
        }
    }

    function checkAvailableTime(inputDate) {

        if (inputDate) {
            var data = {1: '10:00', 2: "10:15", 3: "10:30", 4: "10:45", 5: "11:00", 6: "11:15", 7: "11:30", 8: "11:45", 9: "12:00", 10: "12:15", 11: "12:30", 12: "12:45", 13: "13:00", 14: "13:15", 15: "13:30", 16: "13:45", 17: "14:00", 18: "14:15", 19: "14:30", 20: "14:45", 21: "15:00", 22: "15:15", 23: "15:30", 24: "15:45", 25: "16:00", 26: "16:15", 27: "16:30", 28: "16:45"};
            $("#ajax_loader").show();
            var url = "{{ url('/check-int-available-time') }}";
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {'date': inputDate},
                success: function (response) {
                    $("#ajax_loader").hide();
                    if (response.status == 'success') {
                        $("#time_data").empty();
                        $.each(data, function (index, value) {
                            $("#time_data").append('<div class="col-md-3 time-box"><span class="test"  onclick="checkBooking(this.id)" data-book=' + value + '  style="cursor: pointer;" id="book_' + index + '">' + value + '</span></div>');
                            if ($.inArray(value, response.bookedData) >= 0) {
                                //console.log('found');

                                $("#book_" + index).prop("onclick", null).off("click");
                                $("#book_" + index).css({"background-color": "lightgray", 'cursor': "auto"});
                            }
                        });
                    }
                }
            });
        }
    }



</script>

@endpush