@extends('layouts.app')

@section('content')
<table class="table" id="book-table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Book Name</th>
      <th scope="col">Book Year</th>
      <th scope="col">Author Name</th>
      <th scope="col">Author Genre</th>
      <th scope="col">Library Name</th>
      <th scope="col">Library Address</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
@endsection

@push('scripts')
<script type="text/javascript">
    const fetch_books_url = "{!! route('book.index') !!}";
    $(document).ready(function() {
        commonAjax({},fetch_books_url,"GET",bookSuccessListResult,bookErrorListResult);
    });

    function bookSuccessListResult(data)
    {
        if(data.status){
            const result = data.data;
            var count = 0;
            $.each(result,function(key,value){
                count += 1;
                $("#book-table").find('tbody')
                .append($('<tr>')
                    .append($('<td>')
                        .append($('<span>'))
                            .text(count)
                    )
                    .append($('<td>')
                        .append($('<span>'))
                            .text(value.book_name)
                    )
                    .append($('<td>')
                        .append($('<span>'))
                            .text(value.book_year)
                    )
                    .append($('<td>')
                        .append($('<span>'))
                            .text(value.author.name)
                    )
                    .append($('<td>')
                        .append($('<span>'))
                            .text(value.author.genre)
                    )
                    .append($('<td>')
                        .append($('<span>'))
                            .text("-")
                    )
                    .append($('<td>')
                        .append($('<span>'))
                            .text("-")
                    )
                    .append($('<td>')
                        .append($('<a class="" href=""><i class="fa fa-pencil"></i></a>&nbsp;<a class="" href=""><i class="fa fa-trash"></i></a>&nbsp;'))
                    )
                );
            });
        }
    }

    function bookErrorListResult(data)
    {
        alert(data.message);
    }
</script>
@endpush
