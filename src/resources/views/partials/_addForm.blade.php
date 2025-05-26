<form class="add_form" action="{{ route('books.store') }}" method="POST">
    @csrf

    <div class="add_form--inner">
        <div class="input_block">
            <label for="author">Author Name</label>

            <input id="author" name="author" type="text" class="input">

            @error('author')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input_block">
            <label for="book">Book Title</label>

            <input id="title" name="title" type="text" class="input">

            @error('title')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>


    <button class="add_form_button" type="submit">
        Add
    </button>
</form>