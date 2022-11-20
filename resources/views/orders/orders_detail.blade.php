@extends('crudbooster::admin_template')
@section('content')

{{-- <form method='post' action='{{CRUDBooster::mainpath('add-save')}}'> --}}
{{-- {{ csrf_field() }} --}}
    <div class='panel panel-default'>
        <div class='panel-body'>
            <div class='col-md-3'>
                <div class='form-group'>
                    <label>Order Number</label>
                    <input type='text' class='form-control' value="{{$get_orders->order_number}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Branch</label>
                    <input type='text' class='form-control' value="{{$get_orders->branch_name}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Customer</label>
                    <input type='text' class='form-control' value="{{$get_orders->customer_name}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Car</label>
                    <input type='text' class='form-control' value="{{$get_orders->car_name}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Year</label>
                    <input type='text' class='form-control' value="{{$get_orders->year}}" readonly/>
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    <label>Registration Number</label>
                    <input type='text' class='form-control' value="{{$get_orders->registration_number}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Price</label>
                    <input type='text' class='form-control' value="{{$get_orders->price}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Additional Cost</label>
                    <input type='text' class='form-control' value="{{$get_orders->additional_cost}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Description Additional Cost</label>
                    <input type='text' class='form-control' value="{{$get_orders->description_add_cost}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Booking Date</label>
                    <input type='text' class='form-control' value="{{$get_orders->booking_date}}" readonly/>
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    <label>Rent Type</label>
                    <input type='text' class='form-control' value="{{$get_orders->rent_type}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Rent Type</label>
                    <input type='text' class='form-control' value="{{$get_orders->rent_type}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Ordered From</label>
                    <input type='text' class='form-control' value="{{$get_orders->vendor}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Delivered</label>
                    <input type='text' class='form-control' value="{{$get_orders->delivered}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Delivery Address</label>
                    <input type='text' class='form-control' value="{{$get_orders->delivery_address}}" readonly/>
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    <label>Discount</label>
                    <input type='text' class='form-control' value="{{$get_orders->discount}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Pickup Time</label>
                    <input type='text' class='form-control' value="{{$get_orders->pickup_time}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Back Hour</label>
                    <input type='text' class='form-control' value="{{$get_orders->back_hour}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Return Date</label>
                    <input type='text' class='form-control' value="{{$get_orders->return_date}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Total Hour</label>
                    <input type='text' class='form-control' value="{{$get_orders->total_hour}}" readonly/>
                </div>
            </div>
            <div class='col-md-3'>
                <div class='form-group'>
                    <label>Total Day</label>
                    <input type='text' class='form-control' value="{{$get_orders->total_days}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Total Week</label>
                    <input type='text' class='form-control' value="{{$get_orders->total_week}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Total Month</label>
                    <input type='text' class='form-control' value="{{$get_orders->total_month}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Total Price</label>
                    <input type='text' class='form-control' value="{{$get_orders->total}}" readonly/>
                </div>
                <div class='form-group'>
                    <label>Status</label>
                    <input type='text' class='form-control' value="{{$get_orders->pay_status}}" readonly/>
                </div>
            </div>
        </div>
        {{-- <div class='panel-footer text-right'>

        </div> --}}
    </div>
{{-- </form> --}}
@endsection
