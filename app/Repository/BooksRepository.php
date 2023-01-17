<?php

namespace App\Repository;

use App\Models\Books;

class BooksRepository
{

    public function getBooks()
    {
        return Books::with(['author','book_library'])->get();
    }

    public function create($data)
    {
        return Books::create($data);
    }

    public function update($data,$where)
    {
        return Books::where($where)->update($data);
    }
}
