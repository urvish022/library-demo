<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repository\BooksRepository;
use App\Http\Resources\GeneralError;
use App\Http\Resources\GeneralResponse;
use App\Http\Controllers\Controller;

class BooksAPIController extends Controller
{
    public $booksRepository;
    public function __construct(BooksRepository $booksRepository)
    {
        $this->booksRepository = $booksRepository;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateBookRequest $bookRequest)
    {
        try {
            $input = $bookRequest->all();

            $data = $this->booksRepository->create();
            return new GeneralResponse([
                'data' => [],
                'message' => "Book saved successfully",
            ]);
        } catch (\exception $ex) {
            return GeneralError::make([
                'code' => 500,
                'message' => 'Failed to save data.',
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
