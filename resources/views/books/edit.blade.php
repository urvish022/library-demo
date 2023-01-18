@extends('layouts.app')

@section('content')
<form autocomplete="false" id="book-form">
    <input type="hidden" value="{{$bookData->id}}" name="id">
<fieldset>
  <legend>Author Information:</legend>
  <div class="form-group">
  <label for="booknameInput">Choose Author</label>
  <div class="form-check">
          <input class="form-check-input" type="radio" name="author_type" id="author_type_one" value="existing_author">
          <label class="form-check-label">
            Existing Author
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="author_type" id="author_type_2" value="new_author" checked>
          <label class="form-check-label">
            New Author
          </label>
        </div>
</div>
<div id="exist-author-section" style="display:none">
<div class="form-group">
    <label for="booknameInput">Author *</label>
    <select name="author_id" class="form-control" id="author-id">
      <option value="">Select Author</option>
    </select>
  </div>
</div>
<div id="new-author-section" >
<div class="form-group">
    <label for="booknameInput">Author Name *</label>
    <input type="text" name="name" class="form-control" id="author-name" value="{{$bookData->author->name}}" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Author Birth Date *</label>
    <input type="date" name="birth_date" class="form-control" id="author-date" value="{{$bookData->author->birth_date}}" required>
  </div>
  <div class="form-group">
    <label for="booknameInput">Genre *</label>
    <input type="text" name="genre" class="form-control" id="author-genre" value="{{$bookData->author->genre}}" required>
  </div>
</div>
</fieldset>
  <br>
<fieldset>
    <legend>Book Information:</legend>
    <div class="form-group">
      <label for="booknameInput">Book Name *</label>
      <input type="text" name="book_name" class="form-control" required value="{{$bookData->book_name}}">
    </div>
    <div class="form-group">
      <label for="booknameInput">Book Year *</label>
      <input type="number" name="book_year" class="form-control" required value="{{$bookData->book_year}}">
    </div>
</fieldset>
  <br>
<fieldset>
    <legend>Library Information:</legend>
    <div class="form-group">
  <label for="booknameInput">Choose Library</label>
  <div class="form-check">
          <input class="form-check-input" type="radio" name="library_type" id="library_type_one" value="existing_library">
          <label class="form-check-label">
            Existing Library
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="library_type" id="library_type_2" value="new_library" checked>
          <label class="form-check-label">
            New Library
          </label>
        </div>
</div>
<div id="exist-library-section" style="display:none">
<div class="form-group">
<label for="booknameInput">Library</label>
    <select name="library_id" class="form-control" id="library-id">
      <option value="">Select Library</option>
    </select>
</div>
</div>
<div id="new-library-section">
  <div class="form-group">
    <label for="booknameInput">Library Name</label>
    <input type="text" name="library_name" class="form-control" value="{{count($bookData->book_library) > 0 ? $bookData->book_library[0]->library->library_name : ""}}">
  </div>
  <div class="form-group">
    <label for="booknameInput">Library Address</label>
    <input type="text" name="library_address" class="form-control" value="{{count($bookData->book_library) > 0 ? $bookData->book_library[0]->library->library_address : ""}}">
  </div>
</div>
</fieldset>
  <br>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
@push('scripts')
<script>
const update_books_url = '{!! route("book.update",$bookData->id) !!}';
const library_id = '{!! count($bookData->book_library) > 0 ? $bookData->book_library[0]->id : "" !!}';
const author_id = '{!! $bookData->author->id !!}';
const fetch_author_libraries_url = '{!! route("book.fetch-authors-libraries") !!}';
$(document).ready(function(){
    commonAjax({},fetch_author_libraries_url,"GET",initialDataSuccess,initialDataError);
    console.log({author_id});
    $("#author-id").val(author_id).change();

});

$('#book-form').submit(function ( e ) {
    e.preventDefault();
    var formData = $("#book-form").serialize();
    commonAjax(formData,update_books_url,"PUT",updateBookSuccess,updateBookError)
});

$('input[type=radio][name=author_type]').change(function() {
    if (this.value == 'existing_author') {
        $("#exist-author-section").show();
        $("#new-author-section").hide();
        setRequired('author-id');
        removeRequired('author-name');
        removeRequired('author-date');
        removeRequired('author-genre');
        $('#author-id option[value='+author_id+']').attr('selected','selected');
        $("#author-name").val("");
        $("#author-date").val("");
        $("#author-genre").val("");
    }
    else if (this.value == 'new_author') {
        $('#author-id option[value=""]').attr('selected','selected');
        $("#exist-author-section").hide();
        $("#new-author-section").show();
        setRequired('author-name');
        setRequired('author-date');
        setRequired('author-genre');
        removeRequired('author-id');
        $('#author-id').val("");
    }
});

$('input[type=radio][name=library_type]').change(function() {
    if (this.value == 'existing_library') {
        $("#exist-library-section").show();
        $("#new-library-section").hide();
        $('#library-id option[value='+library_id+']').attr('selected','selected');
    }
    else if (this.value == 'new_library') {
        $('#author-id option[value=""]').attr('selected','selected');
        $("#exist-library-section").hide();
        $("#new-library-section").show();
    }
});

function initialDataSuccess(data)
{
    if(data.status){
        const authors = data.data.authors;
        const libraries = data.data.libraries;

        $.each(authors, function(key, value) {
            $('#author-id').append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.name));
        });

        $.each(libraries, function(key, value) {
            $('#library-id').append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.library_name));
        });
    }
}

function initialDataError(data)
{
    alert(data.message);
}

function updateBookSuccess(data)
{

}

function updateBookError(data)
{

}

function setRequired(id){
    $("#"+id).prop('required',true);
}

function removeRequired(id){
    $('#'+id).removeAttr('required');
}
</script>
@endpush
