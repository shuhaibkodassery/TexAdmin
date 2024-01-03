@extends('Admin.layout')
@section('content')
<div class="main-panel">
    <div class="content m-p-0">
        <div class="container-fluid m-p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">FAQ</div>
                        </div>
                        <form action="{{ route('faq') }}" method="POST" class="needs-validation" id="faq_form" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" class="form-control" id="question" name="question"
                                        placeholder="Enter Question" required>
                                    <div class="invalid-feedback">
                                        Please Enter The Question.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea id="answer" class="form-control" placeholder="Enter Answer" name="answer"
                                        required></textarea>
                                    <div class="invalid-feedback">
                                        Please Enter Answer
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success" id="CreateFaq">Create</button>
                                <div class="btn btn-success hide" id="UpdateFaq">Update</div>
                            </div>
                        </form>
                        @if(count($faqs)>0)
                        <div class="card-body m-p-0">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $faq->qus }}</td>
                                        <td>{{ $faq->ans }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="i-btn" onclick="editFaq({{$faq->faq_id}})"><i class="fa-solid fa-pen-to-square"></i></div>
                                                <input type="hidden" id="faq_id" value="">
                                                <div class="i-btn" onclick="deleteFaq({{$faq->faq_id}})"><i class="fa-solid fa-trash"></i></div>
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