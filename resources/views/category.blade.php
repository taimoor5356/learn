@extends('app')

@section('title', 'Categories')

@section('content')
    <div class="container-fluid my-0 p-0">
            <div class="my-2">
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#categoryModal">Add New Category</a>
            </div>
    </div>
    <div class="container-fluid my-2 p-0 border border-secondary rounded">
        <span class="alert-message">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    Successfully created
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    Something went wrong
                </div>
            @endif
        </span>
        <table class="table table-hover my-2 text-white">
            <thead>
                <th>Category</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="text-white">{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $categories->links() }} --}}
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                    <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/category/store" method="post">
                        @csrf
                        <input type="text" name="name" id="category-name" class="form-control bg-dark text-white"
                            placeholder="Enter category name">
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
        $(document).ready(function() {});
    </script>
@endsection
