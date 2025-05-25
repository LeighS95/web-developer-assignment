<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @unless (count($books) == 0)
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>
                        <form method="POST" action="books/{{ $book->id }}">
                            @csrf
                            @method('PUT')
                            <div class="active_input_wrapper">
                                <input class='active_input' name='author' value={{ $book->author }} />
                                <span class='active_input--indicator'>&#9166;</span>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="/books/{{ $book->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">
                                &#128465;
                            </button>
                        </form>
                    </td>
                <tr>
            @endforeach
        @else
                <tr>
                    <td style="padding: 16px;" colspan="3" align="center">No Books Found</td>
                </tr>
            @endunless
    </tbody>
</table>