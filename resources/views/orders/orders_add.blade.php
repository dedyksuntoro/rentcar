@extends('crudbooster::admin_template')
@section('content')

<form method='post' action='{{CRUDBooster::mainpath('add-save')}}'>
{{ csrf_field() }}
    <div class='panel panel-default'>
        <div class='panel-body'>
            <div class='form-group'>
                <label>Order Number</label>
                <input type='text' name='order_number' class='form-control' required value="{{time()}}" readonly/>
            </div>
            <div class="form-group">
                <label for="id_branch">Branch</label>
                <select class="form-control" name="id_branch" required style="{{($get_branch[0]->id == CRUDBooster::me()->id_branch ? 'pointer-events: none' : '')}}">
                    <option value="" selected disabled>-- Select Branch --</option>
                    @foreach ($get_branch as $row)
                        <option value="{{$row->id}}" {{($row->id == CRUDBooster::me()->id_branch ? 'selected' : '')}}>{{$row->branch_name}} - {{$row->address}}, {{$row->city}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_customer">Customer</label>
                <select class="form-control" name="id_customer" required>
                    <option value="" selected disabled>-- Select Customer --</option>
                    @foreach ($get_customer as $row)
                        <option value="{{$row->id}}">{{$row->customer_name}} - {{$row->address}} {{($row->customer_rentcar_name == null ? '' : '('.$row->customer_rentcar_name.')')}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ordered_from">Ordered From</label>
                <select class="form-control" name="ordered_from" id="ordered_from" required>
                    <option value="" selected disabled>-- Select Ordered From --</option>
                    @foreach ($get_ordered_from as $row)
                        <option value="{{$row->id}}">{{$row->vendor}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rent_type">Rental Type</label>
                <select class="form-control" name="rent_type" id="rent_type" required>
                    <option value="" selected disabled>-- Select Rental Type --</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Daily">Daily</option>
                    <option value="Hourly">Hourly</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_car">Car</label>
                <select class="form-control" name="id_car" id="id_cars" required disabled>
                    <option value="" selected disabled>-- Select Car --</option>
                    @foreach ($get_car as $row)
                        <option value="{{$row->idcar}}">{{$row->brand}} - {{$row->manufacturer}} | MONTHLY Rp. {{number_format($row->pricepermonth, 0, ',' ,'.')}} | WEEKLY Rp. {{number_format($row->priceperweek, 0, ',' ,'.')}} | DAILY Rp. {{number_format($row->priceperday, 0, ',' ,'.')}} | HOURLY Rp. {{number_format($row->priceperhour, 0, ',' ,'.')}} {{($row->onduty == 1 ? '(ON DUTY)' : '')}}</option>
                    @endforeach
                    <input type='hidden' name='price' id="price" class='form-control' required value="" readonly/>
                </select>
            </div>

            <div class='form-group booking_date'>
                <label>Booking Date</label>
                <input type='date' name='booking_date' id="booking_date" class='form-control' required value=""/>
            </div>

            <div class='form-group pickup_time'>
                <label>Pickup Time</label>
                <input type='time' name='pickup_time' id="pickup_time" class='form-control' required value=""/>
            </div>

            {{-- Daily --}}
            {{-- <div class='form-group start_days' style="display: none;">
                <label>Start Date</label>
                <input type='date' name='datemin' id="datemin"class='form-control' required value="" disabled/>
            </div>
            <div class='form-group end_days' style="display: none;">
                <label>End Date</label>
                <input type='date' name='datemax' id="datemax"class='form-control' required value="" disabled/>
            </div> --}}

            {{-- Hourly --}}
            {{-- <div class='form-group start_hour' style="display: none;">
                <label>Start Hour</label>
                <input type='time' name='hourmin' id="hourmin"class='form-control' required value="" disabled/>
            </div>
            <div class='form-group end_hour' style="display: none;">
                <label>End Hour</label>
                <input type='time' name='hourmax' id="hourmax"class='form-control' required value="" disabled/>
            </div> --}}

            <div class='form-group total_month' style="display: none;">
                <label>Total Month</label>
                <input type='number' name='total_month' id="total_month" class='form-control' required value=""/>
            </div>

            <div class='form-group total_week' style="display: none;">
                <label>Total Week</label>
                <input type='number' name='total_week' id="total_week"class='form-control' required value=""/>
            </div>

            <div class='form-group total_days' style="display: none;">
                <label>Total Days</label>
                <input type='number' name='total_days' id="total_days" class='form-control' required value=""/>
            </div>

            <div class='form-group total_hour' style="display: none;">
                <label>Total Hour</label>
                <input type='number' name='total_hour' id="total_hour"class='form-control' required value=""/>
            </div>

            <div class='form-group return_date'>
                <label>Return Date</label>
                <input type='date' name='return_date' id="return_date"class='form-control' required value="" readonly/>
            </div>
            <div class='form-group back_hour'>
                <label>Back Hour</label>
                <input type='time' name='back_hour' id="back_hour"class='form-control' required value="" readonly/>
            </div>

            <div class="form-group">
                <label for="delivered">Delivered</label>
                <select class="form-control" name="delivered" id="delivered" required>
                    <option value="" selected disabled>-- Select Delivered --</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class='form-group delivery_address' style="display: none;">
                <label>Delivery Address</label>
                <input type='text' name='delivery_address' id="delivery_address" class='form-control' required value=""/>
            </div>

            <div class='form-group'>
                <label>Discount</label>
                <input type='number' name='discount' id="discount"class='form-control inputMoney' value=""/>
                <p class='help-block'>Discount in percent</p>
            </div>
            <div class='form-group'>
                <label>Total Payment</label>
                <input type='text' name='total' id="total"class='form-control inputMoney' required value="" readonly/>
            </div>
        </div>
        <div class='panel-footer text-right'>
            <input type='submit' class='btn btn-primary' value='Order now!'/>
        </div>
    </div>
</form>
@endsection
