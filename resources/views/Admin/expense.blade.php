@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Expense</div>
                        </div>
                        <form class="needs-validation">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="expense">Expense</label>
                                    <input type="text" name="expense" id="expense" class="form-control"
                                        placeholder="Enter Expense" required>
                                </div>
                                <div class="form-group">
                                    <label for="expense_amount">Expense Amount</label>
                                    <input type="number" class="form-control" id="expense_amount" name="expense_amount"
                                        placeholder="Enter Expense Amount" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                            </div>
                            <div class="card-action">
                                <div type="submit" class="btn btn-success" id="CreateExpense">Create</div>
                            </div>
                        </form>

                        @if(count($expenses)>0)
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Expense</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">date</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $expense->expense_name }}</td>
                                        <td>{{ $expense->expense_amount}}</td>
                                        <td>{{ $expense->date}}</td>
                                        <td>
                                            <div class="i-btn" onclick="deleteExpense({{$expense->expense_id}})"><i class="fa-solid fa-trash"></i></div>
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