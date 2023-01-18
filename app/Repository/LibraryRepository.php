<?php

namespace App\Repository;
use App\Models\Libraries;

class LibraryRepository
{
    public function create($data)
    {
        //not created seperate repository due to insufficient time. so created function to save relationship data.
        if(!empty($data['library_id'])){
            $library = Libraries::find($data['library_id']);
        } else {
            $library = Libraries::create($data);
        }

        $this->saveBookLibraryData($library,$data);
        return $library;
    }

    public function get()
    {
        return Libraries::get();
    }

    public function saveBookLibraryData($libraryObj,$data)
    {
        $data['library_id'] = $libraryObj->id;
        $libraryObj->book_library()->create($data);
    }

    public function createOrUpdate($data,$id)
    {
        if(is_null($id)){
            $result = Libraries::updateOrCreate(['library_name'=>$data['library_name']],$data);
            $id = $result->id;
        }

        $libraryObj = Libraries::find($id);
        $libraryObj->book_library()->updateOrCreate(['library_id'=>$id,'book_id'=>$data['book_id']],['library_id'=>$id,'book_id'=>$data['book_id']]);
    }
}
