@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sales Report</div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <div class="form-group">
                                    <label for="from_date">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-group">
                                    <label for="to_date">To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-group">
                                    <div class="btn btn-success" id="SaleReportFilter">Filter</div>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <div class="form-group">
                                    <b>Total Amount : {{$net_amount}}</b>
                                </div>
                            </div>
                        </div>
                        @if(count($sales)>0)
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $sale->product_name }}</td>
                                        <td>{{ $sale->product_price}}</td>
                                        <td>{{ $sale->discount}}</td>
                                        <td>{{ $sale->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection