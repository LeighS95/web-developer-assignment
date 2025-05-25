<search>
    <form action="/books" method="GET">
        <label for="search">Search</label>
        <input id="search" type="search" name='search' value="{{ $search }}" />
        @unless(!$search)
            <a href="/books">clear</a>
        @endunless
    </form>
</search>