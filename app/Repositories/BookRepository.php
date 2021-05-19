<?php


namespace App\Repositories;

use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Resources\RatingResource;

class BookRepository
{
    protected $bookModel;

    public function __construct(Book $bookModel)
    {
        $this->bookModel = $bookModel;

    }

    public function get()
    {
        return BookResource::collection($this->bookModel->with('ratings','user')->paginate(25));
    }

    public function store($book)
    {
        return $this->bookModel->create($book);
    }

    public function show($id)
    {
        return $this->bookModel->with('ratings')->findOrFail($id);
    }

    public function update($book, $id)
    {
        return $this->bookModel->findOrFail($id)->update($book);
    }

    public function delete($id)
    {
        return $this->bookModel->findOrFail($id)->delete();
    }
}