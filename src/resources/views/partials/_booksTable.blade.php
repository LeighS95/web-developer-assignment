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
                <button onclick="modal{{ $book->id }}.show()">{{ $book->author }}</button>

                <dialog id="modal{{ $book->id}}">
                    <form method="POST" action="books/{{ $book->id }}">
                        @csrf
                        @method('PUT')
                        <label for='change-name'>
                            Change Author's Name
                        </label>
                        <input id='change-name' name='author' />

                        <button type="submit">
                            submit
                        </button>
                    </form>

                    <button onclick="modal{{ $book->id }}.close()">Cancel</button>
                </dialog>
            </td>
            <td class="deleteButton">
                <form method="POST" action="/books/{{ $book->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button red">
                        X
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