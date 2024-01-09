@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Purchase</div>
                        </div>
                        <form class="needs-validation">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="purchase">Purchase </label>
                                    <input type="text" name="purchase" id="purchase" class="form-control"
                                        placeholder="Enter Purchase" required>
                                </div>
                                <div class="form-group">
                                    <label for="purchase_amount">Purchase Amount</label>
                                    <input type="number" class="form-control" id="purchase_amount" name="purchase_amount"
                                        placeholder="Enter Purchase Amount" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                            </div>
                            <div class="card-action">
                                <div type="submit" class="btn btn-success" id="CreatePurchase">Create</div>
                            </div>
                        </form>

                        @if(count($purchases)>0)
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Purchase</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchases as $purchase)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $purchase->purchase }}</td>
                                        <td>{{ $purchase->amount}}</td>
                                        <td>{{ $purchase->purchase_date}}</td>
                                        <td>
                                            <div class="i-btn" onclick="deletePurchase({{$purchase->purchase_id}})"><i class="fa-solid fa-trash"></i></div>
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