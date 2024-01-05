@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Product</div>
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_code">Product Code</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code"
                                        placeholder="Enter Product Code" required>
                                    <div class="invalid-feedback">
                                        Please Enter Product Code.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Enter Product Name" required>
                                    <div class="invalid-feedback">
                                        Please Enter Product Name.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="purchase_price">Purchase Price</label>
                                    <input type="number" class="form-control" id="purchase_price" name="purchase_price"
                                        placeholder="Enter Purchase Price" required>
                                    <div class="invalid-feedback">
                                        Please Enter Purchase Price.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price"
                                        placeholder="Enter Product Price" required>
                                    <div class="invalid-feedback">
                                        Please Enter Purchase Price.
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="btn btn-success" id="CreateProduct">Create</div>
                            </div>
                        </form>

                        @if(count($products)>0)
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
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_price}}</td>
                                        <td>
                                            <div class="i-btn" onclick="deleteProduct({{$product->product_id}})"><i class="fa-solid fa-trash"></i></div>
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