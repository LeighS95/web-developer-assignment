@extends('layout')

@section('content')

    <div class="full-height full-width">
        <div class="content">
            <div class="title m-b-md">
                Books
            </div>
        </div>

        @include('partials._addForm')

        @include('partials._booksTable')
    </div>

@endsection