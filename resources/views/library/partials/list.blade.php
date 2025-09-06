<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!--  jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJ+Y7RyKcG8z+q2cVQzkw5NvR0iLDDq+0i/Rg="
        crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="form-group row" style="margin: 10px;">
    <form method="GET" action="{{ route('books.list') }}" class="form-inline mb-3">
        <div class="form-group mr-2">
            <select class="form-control" name="author_id">
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mr-2">
            <input type="number" name="published_year" class="form-control" placeholder="Published Year"
                   value="{{ request('published_year') }}">
        </div>

        <button type="submit" class="btn btn-primary mr-2">Filter</button>
        <a href="{{ route('books.list') }}" class="btn btn-secondary">Reset</a>
    </form>
</div>


<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Books List</h5>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-dark">
            <tr>
                <th>Book Name</th>
                <th>Published Year</th>
                <th>Copies</th>
                <th>Author Name</th>
                <th>Author Email</th>
            </tr>
            </thead>
            <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->copies ?? '-' }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->author->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No records found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $books->links() }}
        </div>
    </div>
</div>


