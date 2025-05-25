<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Books</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            margin: 0 32px;
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        table {
            border: 1px solid #000;
            border-radius: 4px;
            width: 100%;
        }

        th,
        td {
            padding: 4px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Books
            </div>
        </div>

        <div>
            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <label for="author">Author Name</label>

                <input id="author" name="author" type="text" class="@error('author') is-invalid @enderror">

                @error('author')
                    <div class='error'>
                        {{ $message }}
                    </div>
                @enderror

                <label for="book">Book Title</label>

                <input id="title" name="title" type="text">

                @error('title')
                    <div>
                        {{ $message }}
                    </div>
                @enderror

                <button type="submit">
                    Add
                </button>
            </form>
        </div>

        @section('content')

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 16px;" colspan="3" align="center">No Books Found</td>
                </tr>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td><a href="/books/author/{{ $book->author }}">{{ $book->author }}</a></td>
                        <td class="deleteButton"><a href="/books/delete/{{ $book->id }}">X</a></td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>