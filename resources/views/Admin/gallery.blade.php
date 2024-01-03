@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Gallery</div>
                        </div>
                        <form class="needs-validation" novalidate id="blog_form">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="uploadGalleryImage">Gallery Images</label>
                                            <input type="file" class="form-control" id="uploadGalleryImage" multiple>
                                            <div class="loader-line" style="display:none" id="loader"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="image_menu_order">Image Menu Order</label>
                                            <input type="text" class="form-control" id="image_menu_order"
                                                placeholder="Enter Image Menu Order">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pl-4 pb-2" id="blogImageAttachments"></div>
                            </div>
                            <div class="card-action">
                                <div class="btn btn-success" id="CreateGalleryImage">Create</div>
                            </div>
                        </form>
                    </div>
                    @if(count($images) >0)
                    <div class="card">
                        <div class="row p-3">
                            @foreach($images as $image)
                            <div class="col-6 col-md-3 col-lg-2 pb-3">
                                <div class="gallery-img">
                                    <img src="{{$image->small}}" alt="">
                                    <span title="Delete" onclick="deleteImage({{$image->resource_id}})"><i
                                            class="la la-trash-o trash"></i></span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection