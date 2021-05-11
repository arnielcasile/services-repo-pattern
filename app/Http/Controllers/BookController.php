<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;

class BookController extends Controller
{

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware('auth:api');
        $this->bookService = $bookService;
    }
    
    public function index()
    {
        return $this->bookService->get();
    }

    public function store(BookRequest $request)
    {
        if($request->validator->fails())
        {
            return $request->validator->errors();
        }
        $book = [
            'user_id'       => $request->user()->id,
            'title'         => $request->title,
            'description'   => $request->description,
        ];

        return $this->bookService->store($book);
    }

    public function show($id)
    {
        return $this->bookService->show($id);
    }

    public function update(BookRequest $request, $id)
    {
        if($request->validator->fails())
        {
            return $request->validator->errors();
        }

        $book = [
            'user_id'       => $request->user()->id,
            'title'         => $request->title,
            'description'   => $request->description,
        ];

        return $this->bookService->update($book, $id);
    }

    public function destroy($id)
    {
        return $this->bookService->delete($id);
    }
}
