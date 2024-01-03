@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content m-p-0">
        <div class="container-fluid m-p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Blog</div>
                        </div>
                        <form class="needs-validation" novalidate id="blog_form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Blog_title">Blog Title</label>
                                    <input type="text" class="form-control" id="Blog_title"
                                        placeholder="Enter Blog Title" required>
                                    <div class="invalid-feedback">
                                        Please Enter Blog Title
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="discription">Blog Short Discription</label>
                                    <textarea id="discription" class="form-control" placeholder="Enter Blog Discription" required></textarea>
                                    <div class="invalid-feedback">
                                        Please Enter Blog short Discription
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editor">Blog Content</label>
                                    <textarea id="editor" class="form-control"></textarea>
                                    <div class="invalid-feedback">
                                        Please Enter Blog Content
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please Select Date
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="author_name">Author Name</label>
                                    <input type="text" name="author_name" id="author_name" class="form-control"
                                        placeholder="Enter Author Name" required>
                                    <div class="invalid-feedback">
                                        Please Enter Author Name
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="author_email">Author Email</label>
                                    <input type="email" name="author_email" id="author_email" class="form-control"
                                        placeholder="Enter Author Email" required>
                                    <div class="invalid-feedback">
                                        Please Enter Author Email
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category">Blog Category</label>
                                    <select class="form-control" id="category" name="category">
                                        @foreach($categories as $category)
                                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="uploadBlogImage">Blog Images</label>
                                            <input type="file" class="form-control" id="uploadBlogImage" multiple>
                                            <div class="loader-line" style="display:none" id="loader"></div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-4">
                                        <div class="form-group">
                                            <label for="image_menu_order">Image Menu Order</label>
                                            <input type="text" class="form-control" id="image_menu_order"
                                                placeholder="Enter Image Menu Order">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row pl-4 pb-2" id="blogImageAttachments"></div>
                            </div>
                            <div class="card-action">
                                <div class="btn btn-success" id="CreateBlog">Create</div>
                                <div class="btn btn-success hide" id="UpdateBlog">Update</div>
                                <input type="hidden" id="blog_id" value="">
                            </div>
                        </form>

                        @if(count($blogs) > 0)
                        <div class="card-body m-p-0">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Blog Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="line-break">{{ $blog->blog_title }}</td>
                                        <td>{{ $blog->category_name }}</td>
                                        <td>{{ $blog->author_name}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="btn btn-success edit-btn"
                                                    onclick="editBlogData({{$blog->blog_id}})">Edit</div>
                                                <form action="{{ route('blogDelete',$blog->blog_id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger dlt-btn">Delete</button>
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