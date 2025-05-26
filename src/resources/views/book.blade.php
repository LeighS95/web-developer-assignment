@extends('layout')

@section('content')

    <section style="padding-block: 16px;">
        @include('partials._search')
    </section>

    <section style="padding-block: 16px;">
        @include('partials._addForm')
    </section>

    <section style="padding-block: 16px;">
        @include('partials._booksTable')
    </section>

@endsection