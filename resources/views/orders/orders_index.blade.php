@extends('crudbooster::admin_template')
@section('content')

<table class='table table-striped table-bordered'>
  <thead>
      <tr>
        <th>Order Number</th>
        <th>Branch</th>
        <th>Customer</th>
        <th>Manufacturer</th>
        <th>Brand</th>
        <th>Pay Status</th>
        <th>Order Date</th>
        <th>Action</th>
       </tr>
  </thead>
  <tbody>
    @foreach($get_orders as $row)
      <tr>
        <td>{{$row->order_number}}</td>
        <td>{{$row->branch_name}}</td>
        <td>{{$row->customer_name}}</td>
        <td>{{$row->manufacturer}}</td>
        <td>{{$row->brand}}</td>
        <td>{{$row->pay_status}}</td>
        <td>{{$row->order_date}}</td>
        <td>
          @if(CRUDBooster::isUpdate() && $button_edit)
          <a class='btn btn-success btn-xs' href='{{CRUDBooster::mainpath("edit/$row->idorder")}}'>Edit</a>
          @endif
          @if(CRUDBooster::isDelete() && $button_edit)
          <a class='btn btn-danger btn-xs' href='{{CRUDBooster::mainpath("delete/$row->idorder")}}'>Delete</a>
          @endif
        </td>
       </tr>
    @endforeach
  </tbody>
</table>

<p>{!! urldecode(str_replace("/?","?",$get_orders->appends(Request::all())->render())) !!}</p>
@endsection
