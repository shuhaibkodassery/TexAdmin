@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Company</div>
                        </div>
                        <form id="companyForm" class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        placeholder="Enter Company Name" required>
                                    <div class="invalid-feedback">
                                        Please Enter Company Name.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_address">Company Address</label>
                                    <textarea id="company_address" class="form-control"
                                        placeholder="Enter Company Address" required></textarea>
                                    <div class="invalid-feedback">
                                        Please Enter Company Address
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_email">Company Email</label>
                                    <input type="text" class="form-control" id="company_email" name="company_email"
                                        placeholder="Enter Company Email" required>
                                    <div class="invalid-feedback">
                                        Please Enter Company Email.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_mobile">Company Mobile</label>
                                    <input type="text" class="form-control" id="company_mobile" name="company_mobile"
                                        placeholder="Enter Company Mobile" required>
                                    <div class="invalid-feedback">
                                        Please Enter Company Mobile Number.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company_logo">Company Logo</label>
                                    <input type="file" name="company_logo" id="company_logo" class="form-control">
                                </div>
                                <div class="row pl-4 pb-2" id="blogImageAttachments"></div>
                                <div class="form-group">
                                    <label for="instagram">Company Instagram Account</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                        placeholder="Enter Company Instagram Account link">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Company Facebook Account</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                        placeholder="Enter Company Instagram Account link">
                                </div>
                                <div class="form-group">
                                    <label for="youtube">Company Youtube Account</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube"
                                        placeholder="Enter Company Youtube Account link">
                                </div>
                                <div class="form-group">
                                    <label for="x_account">Company x Account</label>
                                    <input type="text" class="form-control" id="x_account" name="x_account"
                                        placeholder="Enter Company X Account link">
                                </div>
                                <div class="form-group">
                                    <label for="linkedin">Company LinkedIn Account</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin"
                                        placeholder="Enter Company LinkedIn Account link">
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        placeholder="Enter Meta Title">
                                </div>
                                <div class="form-group">
                                    <label for="discription">Meta Discription</label>
                                    <input type="text" class="form-control" id="discription" name="discription"
                                        placeholder="Enter Meta Discription">
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="btn btn-success" id="CreateCompany">Create</div>
                                <div class="btn btn-success hide" id="UpdateCompany">Update</div>
                                <input type="hidden" id="category_id">
                            </div>
                        </form>

                        @if(count($companies) > 0)
                        <div class="card-body m-p-0">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Company Address</th>
                                        <th scope="col">Company Email</th>
                                        <th scope="col">Company Mobile</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="line-break">{{ $company->company_name }}</td>
                                        <td>{{ $company->company_address }}</td>
                                        <td>{{ $company->company_email }}</td>
                                        <td>{{ $company->company_phone }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn btn-success edit-btn" onclick="editCompany({{$company->company_id}})">Edit</div>
                                                <div class="btn btn-danger dlt-btn" onclick="deleteCompany({{$company->company_id}})">Delete</div>
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