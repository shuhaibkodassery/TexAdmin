@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Blog Header Menu</div>
                        </div>
                        <form action="{{ route('headerMenu') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="header_menu">Header menu</label>
                                    <input type="text" class="form-control" id="header_menu" name="header_menu"
                                        placeholder="Enter Header Menu" required>
                                    <div class="invalid-feedback">
                                        Please Enter Header Menu.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="header_link">Header Link</label>
                                    <input type="text" class="form-control" id="header_link" name="header_link"
                                        placeholder="Enter Header Menu link" required>
                                    <div class="invalid-feedback">
                                        Please Enter Header Menu Link.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="IsSubMenu" value="1"
                                            name="is_submenu">
                                        <span class="form-check-sign">Is sub-menu</span>
                                    </label>
                                </div>
                                <div class="form-group hide" id="mainMenuSection">
                                    <label for="main_menu">Main Menu</label>
                                    <select class="form-control" id="main_menu" name="main_menu">
                                        <option value="">--Select Main Menu --</option>
                                        @foreach($main_menus as $menu)
                                        <option value="{{$menu->menu_id}}">{{$menu->header_menu_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success" id="createHomeMenu">Create</button>
                                <div class="btn btn-success hide" id="updateHomeMenu">Update</div>
                                <input type="hidden" value="" id="headerId">
                            </div>
                        </form>

                        @if(count($menus) > 0)
                        <div class="card-body m-p-0">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Header Menu</th>
                                        <th scope="col">Link</th>
                                        <th scope="col">Main Menu</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $menu)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="line-break">{{ $menu->header_menu_name }}</td>
                                        <td>{{ $menu->header_menu_link }}</td>
                                        <td>{{ $menu->main_menu }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn btn-success edit-btn" onclick="editHomeMenu({{$menu->menu_id}})">Edit</div>
                                                <div class="btn btn-danger dlt-btn" onclick="deleteHomeMenu({{$menu->menu_id}})">Delete
                                                </div>
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