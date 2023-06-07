<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <title>@yield('title')</title>
    <style>
        .leading-5 {
            margin-top: 10px;
        }
        .learn-links {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container d-flex border border-default rounded my-2">
        <div class="container d-flex justify-content-start p-0">
            <a href="{{route('questions_answers')}}" class="learn-links">Ques-Answers</a>
            <a href="{{route('cateories')}}" class="learn-links">Categories</a>
        </div>
        <div class="container d-flex justify-content-end p-0">
            <a href="#" class="learn-links text-danger">Logout</a>
        </div>

    </div>
    @yield('content')
    @yield('modal')
    <script type="text/javascript" src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/ajax.jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    @yield('scripts')
</body>
</html>