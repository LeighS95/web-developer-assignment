<div class="table_container">
    <div class="table_export_section">
        @include('partials._export')
    </div>

    <table>
        <thead>
            <tr>
                <th>
                    Title
                    <a class="table_sort_icon" href="?sort=title"><span>&#8645;</span></a>
                </th>
                <th>
                    Author
                    <a class="table_sort_icon" href="?sort=author"><span>&#8645;</span></a>
                </th>
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
                                <button type="submit" class="delete table_delete_icon">
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
</div>