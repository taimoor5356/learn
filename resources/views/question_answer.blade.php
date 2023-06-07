@extends('app')
@section('title', 'Ques-Ans')
@section('content')
    <div class="container-fluid my-0 p-0">
        <div class="col-lg-12 col-md-12 col-sm-12 my-0 d-flex">
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#questionAnswerModal">Add New
                Question-Answer</button>
            <button class="btn btn-secondary ms-auto" data-question-id="" id="refresh-answer">Refresh Answer</button>
        </div>
    </div>
    <div class="container-fluid my-2 border border-secondary rounded">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <span class="close-alert-message alert-message">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            Successfully created
                            <div class="close-alert-message" style="float: right; cursor: pointer">X</div>
                        </div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger">
                            Something went wrong
                            <div class="close-alert-message" style="float: right; cursor: pointer">X</div>
                        </div>
                    @endif
                </span>
                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                    <div class="d-flex justify-content-between">
                        <label for="" class="text-white">Select Category</label>
                        <input class="mb-2 bg-dark text-white border border-secondary rounded" type="text" id="categories-search-input" placeholder="Search Category...">
                    </div>
                    <select name="category" id="category" class="form-control bg-dark text-white border border-secondary" multiple style="height: 150px">
                        <option value="" disabled>Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                    <div class="d-flex justify-content-between">
                        <label for="" class="text-white">Select Question</label>
                        <input class="mb-2 bg-dark text-white border border-secondary rounded" type="text" id="question-search-input" placeholder="Search Question...">
                    </div>
                    <select name="question" id="question" class="form-control bg-dark text-white border border-secondary" multiple style="height: 225px">
                        <option value="" disabled>Select question</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                    <img class="category-image" src="{{asset('public/assets/img/user-avatar.png')}}" height="30px" width="30px" alt="">
                    <span class="text-white mx-2" id="show-question">

                    </span>
                </div>
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                    <label for="">Answer</label>
                    <textarea id="answer" rows="15" class="form-control bg-dark text-white border border-secondary"></textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end">
                    {{-- <button type="button" class="btn btn-warning me-auto" data-answer-id="" id="change-color">Change color</button> --}}
                    <span class="d-none mx-2 mt-2 updated-response-message text-white"></span>
                    <button type="button" class="btn btn-success ml-2" data-answer-id="" id="update-answer"> Update
                        Answer</button>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="questionAnswerModal" tabindex="-1" role="dialog"
        aria-labelledby="questionAnswerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionAnswerModalLabel">Add New Question-Answer</h5>
                    <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store-question-answer') }}" method="post">
                        @csrf
                        <select name="category_id" id="category-id" class="form-control bg-dark text-white">
                            <option value="" disabled selected>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="text" name="question" id="modal-question" class="form-control bg-dark text-white"
                            placeholder="Enter question">
                        <br>
                        <textarea rows="10" name="answer" id="answer" class="form-control bg-dark text-white" placeholder="Enter answer"></textarea>
                        <br>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#category', function() {
                let _this = $(this);
                $.ajax({
                    url: "{{ route('fetch_questions') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        category_id: _this.val()
                    },
                    success: function(response) {
                        if (response.status == true) {
                            let options =
                                '<option value="" disabled>Select question</option>';
                            response.data.forEach(element => {
                                options += '<option value="' + element.id + '">' +
                                    element.question + '</option>';
                            });
                            $('#question').html(options);
                        }
                    }
                });
            });
            $(document).on('change', '#question', function() {
                let _this = $(this);
                $('#refresh-answer').attr('data-question-id', _this.val());
                $('#answer').val('');
                $('#show-question').html(_this.find('option:selected').html());
                $.ajax({
                    url: "{{ route('fetch_answers') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        question_id: _this.val()
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#answer').val(response.data.answer);
                            $('#update-answer').attr('data-answer-id', response.data.id);
                            let imageUrl = "{{asset('public/assets/img/:image')}}";
                            imageUrl = imageUrl.replace(':image', response.data.question.category.image);
                            $('.category-image').attr('src', imageUrl);
                        }
                    }
                });
            });
            $(document).on('click', '#refresh-answer', function() {
                let questionId = $(this).attr('data-question-id');
                $('#answer').val('');
                $.ajax({
                    url: "{{ route('fetch_answers') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        question_id: questionId
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#answer').val(response.data.answer);
                        }
                    }
                });
            });
            $(document).on('click', '#update-answer', function() {
                let _this = $(this);
                $('.updated-response-message').removeClass('d-none');
                $('.updated-response-message').removeClass('text-danger');
                $('.updated-response-message').removeClass('text-success');
                $('.updated-response-message').addClass('text-dark');
                $('.updated-response-message').html('Updating...');
                $.ajax({
                    url: "{{ route('update_answer') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        answer_id: _this.attr('data-answer-id'),
                        answer: $('#answer').val(),
                    },
                    success: function(response) {
                        if (response.status == true) {
                            setTimeout(() => {
                                $('.updated-response-message').removeClass('d-none');
                                $('.updated-response-message').removeClass(
                                    'text-danger');
                                $('.updated-response-message').removeClass('text-dark');
                                $('.updated-response-message').addClass('text-success');
                                $('.updated-response-message').html('');
                                $('.updated-response-message').html(
                                    'Updated Successfully');
                            }, 2000);
                        } else {
                            setTimeout(() => {
                                $('.updated-response-message').removeClass('d-none');
                                $('.updated-response-message').removeClass(
                                    'text-success');
                                $('.updated-response-message').removeClass('text-dark');
                                $('.updated-response-message').addClass('text-danger');
                                $('.updated-response-message').html('');
                                $('.updated-response-message').html(
                                    'Something went wrong');
                            }, 2000);
                        }
                        setTimeout(() => {
                            $('.updated-response-message').addClass('d-none');
                        }, 5000);
                    }
                });
            });
            $(document).on('click', '.close-alert-message', function() {
                $('.alert').hide();
            });
            $(document).on('keyup', '#categories-search-input', function() {
                var searchValue = $(this).val().toLowerCase();
                $('#category option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                });
            });
            $(document).on('keyup', '#question-search-input', function() {
                var searchValue = $(this).val().toLowerCase();
                $('#question option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                });
            });
        });
    </script>
@endsection
