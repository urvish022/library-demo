<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\{UpdateBookRequest,CreateBookRequest};
use App\Repository\{AuthorsRepository,BooksRepository,LibraryRepository};
use App\Http\Resources\GeneralError;
use App\Http\Resources\GeneralResponse;
use App\Http\Controllers\Controller;

class BooksAPIController extends Controller
{
    public $booksRepository, $authorRepository, $libraryRepository;
    public function __construct(BooksRepository $booksRepository, AuthorsRepository $authorRepository, LibraryRepository $libraryRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->booksRepository = $booksRepository;
        $this->libraryRepository = $libraryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->booksRepository->getBooks();
            return new GeneralResponse([
                'data' => $data,
                'message' => "Book List",
            ]);
        } catch (\exception $ex) {
            return GeneralError::make([
                'code' => 500,
                'message' => 'Failed to fetch books.',
                'error' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        try {
            $inputs = $request->all();
            if(is_null($inputs['author_id'])){
                $name = $inputs['name'];
                $genre = $inputs['genre'];
                $birth_date = $inputs['birth_date'];
                $authorData = $this->authorRepository->create(compact('name','genre','birth_date'));
                $inputs['author_id'] = $authorData->id;
            }
            $book_data = $this->booksRepository->create($inputs);
            if(!empty($book_data)){
                $book_id = $book_data->id;
                $inputs['book_id'] = $book_id;
                $this->libraryRepository->create($inputs);
            }
            return new GeneralResponse([
                'data' => [],
                'message' => "Book saved successfully",
            ]);
        } catch (\exception $ex) {
            return $ex;
            return GeneralError::make([
                'code' => 500,
                'message' => 'Failed to save data.',
                'error' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        try{
            $inputs = $request->all();
            $name = $inputs['name'];
            $genre = $inputs['genre'];
            $birth_date = $inputs['birth_date'];
            $author_id = $this->authorRepository->createOrUpdate(compact('name','genre','birth_date'),$inputs['author_id']);

            $book_name = $inputs['book_name'];
            $book_year = $inputs['book_year'];
            $this->booksRepository->update(compact('book_name','book_year','author_id'),['id'=>$id]);

            if(!empty($inputs['library_name']) || $inputs['library_id']){
                $this->libraryRepository->createOrUpdate($inputs,$id);
            }
            return new GeneralResponse([
                'data' => [],
                'message' => "Book updated successfully",
            ]);
        } catch (\exception $ex) {
            return GeneralError::make([
                'code' => 500,
                'message' => 'Failed to update data.',
                'error' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $result = $this->booksRepository->delete($id);
            return new GeneralResponse([
                'data' => [],
                'message' => "Book deleted successfully",
            ]);
        } catch (\exception $ex) {
            return GeneralError::make([
                'code' => 500,
                'message' => 'Failed to delete data.',
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function getAuthorsLibrariesData()
    {
        $authors = $this->authorRepository->get();
        $libraries = $this->libraryRepository->get();
        return new GeneralResponse([
            'data' => compact('authors','libraries'),
            'message' => "",
        ]);
    }
}
