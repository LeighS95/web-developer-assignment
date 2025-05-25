<button onclick="exportModal.show()">
    Export
</button>

<dialog id="exportModal">
    <form action="/export" method="GET">
        <fieldset>
            <label for="authors">Authors</label>
            <input id="authors" name="columns" type="radio" value="author" />
            <label for="titles">Titles</label>
            <input id="titles" name="columns" type="radio" value="title" />
            <label for="all">Both</label>
            <input id="all" name="columns" type="radio" value="all" />
        </fieldset>

        <fieldset>
            <label for="csv">Csv</label>
            <input id="csv" name="format" type="radio" value="csv" />
            <label for="csv">Xml</label>
            <input id="xml" name="format" type="radio" value="xml" />
        </fieldset>

        <button type="submit">Export</button>
    </form>
</dialog>