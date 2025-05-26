<search class="search">
    <form action="/books" method="GET">
        <div class="search_form">
            <input id="search" class="search_input" type="search" name='search' value="{{ $search }}"
                placeholder="Search by title or author..." />

            <span class="search_icon">&#128269;</span>

            @unless(!$search)
                <a class="search_reset" href="/books">Reset</a>
            @endunless
        </div>
    </form>
</search>