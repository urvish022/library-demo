@extends('layouts.app')

@section('content')
<form autocomplete="false" id="book-form">
  <div class="form-group">
    <label for="booknameInput">Book Name</label>
    <input type="text" name="book_name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Book Year</label>
    <input type="text" name="book_year" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Author Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Author Birth Date</label>
    <input type="date" name="birth_date" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Genre</label>
    <input type="text" name="genre" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Library Name</label>
    <input type="text" name="library_name" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Library Address</label>
    <input type="text" name="library_address" class="form-control" required>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@push('scripts')
    <script>
        const save_books_url = '{!! route("book.store") !!}';
        $(document).ready(function(){
            $('form').submit(function ( e ) {

            var formData = $("#book-form").serialize();
            e.preventDefault();

            console.log(formData);
            commonAjax(formData,save_books_url,"POST",saveBookSuccess,saveBookError)
        });
        });

        function saveBookSuccess(data)
        {
            alert(data.message);
        }

        function saveBookError(data)
        {

        }
    </script>
@endpush
