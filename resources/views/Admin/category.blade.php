@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Blog Category</div>
                        </div>
                        <form action="{{ route('category') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category"
                                        placeholder="Enter Category Name" required>
                                    <div class="invalid-feedback">
                                        Please Enter Category Name.
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success" id="CreateCategory">Create</button>
                                <div class="btn btn-success hide" id="UpdateCategory">Update</div>
                            </div>
                        </form>

                        @if(count($categories)>0)
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $categorie)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $categorie->category_name }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn btn-success mr-3" onclick="editCategory({{$categorie->category_id}})">Edit</div>
                                                <input type="hidden" id="category_id" value="">
                                                <form action="{{ route('categoryDelete',$categorie->category_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
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