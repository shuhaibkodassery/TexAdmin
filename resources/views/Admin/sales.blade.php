@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sales</div>
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select class="form-control" id="product" name="product">
                                        <option>-- Select Product --</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                    @foreach($products as $product)
                                    <input type="hidden" id="product_price_{{$product->product_id}}" value="{{ $product->product_price }}">
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product price</label>
                                    <input type="text" class="form-control" id="product_price" name="product_price"
                                        placeholder="Product Price" required disabled value="">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount Amount</label>
                                    <input type="number" class="form-control" id="discount" name="discount"
                                        placeholder="Enter Discount Amount">
                                </div>
                            </div>
                            <div class="card-action">
                                <div type="submit" class="btn btn-success" id="CreateSale">Create</div>
                            </div>
                        </form>

                        @if(count($sales)>0)
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $sale->product_name }}</td>
                                        <td>{{ $sale->product_price}}</td>
                                        <td>
                                            <div class="i-btn" onclick="deleteSales({{$sale->id}})"><i class="fa-solid fa-trash"></i></div>
                                        </td>
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