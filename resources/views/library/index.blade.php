<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!--  jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJ+Y7RyKcG8z+q2cVQzkw5NvR0iLDDq+0i/Rg="
        crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="card shadow-sm">
    <div class="card-body">
        <h2><u>Add Book & Author</u></h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" class="saveBookForm" action="{{ route('book.save') }}">
            @csrf
            <div class="form-group">
                <label for="title">Book Name</label><span class="required">*</span>
                <input type="text" class="form-control" name="title" placeholder="Enter book name">
            </div>

            <div class="form-group">
                <label for="published_year">Published Year</label><span class="required">*</span>
                <input type="number" class="form-control" name="published_year" placeholder="e.g. 2022">
            </div>

            <div class="form-group">
                <label for="copies">Copies</label>
                <input type="number" class="form-control" name="copies" placeholder="Enter number of copies">
            </div>

            <hr>
            <h4><u>Author Details</u></h4>

            <div class="form-group">
                <label for="author_name">Author Name</label><span class="required">*</span>
                <input type="text" class="form-control" name="author_name" placeholder="Enter author name">
            </div>

            <div class="form-group">
                <label for="author_email">Author Email</label><span class="required">*</span>
                <input type="email" class="form-control" name="author_email" placeholder="Enter author email">
            </div>

            <div class="errorWrapper"></div>
            <button type="submit" class="btn btn-primary saveBook">Add Book</button>

            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    {{--$('.saveBooks').click(function () {--}}
    {{--    let errorWrapper = $('.errorWrapper').slideUp().empty();--}}
    {{--    $.post('{{ route('books.save') }}', $('.saveBooksForm').serialize(), function (response) {--}}
    {{--        Ladda.stopAll();--}}
    {{--        toastr.success('books saved successfully');--}}
    {{--    }).fail(function (response) {--}}
    {{--        Ladda.stopAll();--}}
    {{--        let errors = response.responseJSON.original;--}}

    {{--        for (let key in errors)--}}
    {{--            errorWrapper.append('<div class="error">' + errors[key] + '</div>');--}}

    {{--        errorWrapper.slideDown();--}}
    {{--    });--}}
    {{--})--}}

</script>
<style>
    .required {
        color: red;
    }
</style>
