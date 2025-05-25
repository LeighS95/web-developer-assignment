<div class="add_book_form">
    <form class="form" action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="author">Author Name</label>

            <input id="author" name="author" type="text" class="@error('author') is-invalid @enderror">
        </div>
        @error('author')
            <div class="error-message">
                {{ $message }}
            </div>
        @enderror

        <div>
            <label for="book">Book Title</label>

            <input id="title" name="title" type="text">
        </div>
        @error('title')
            <div class="error-message">
                {{ $message }}
            </div>
        @enderror

        <button type="submit">
            Add
        </button>
    </form>
</div>