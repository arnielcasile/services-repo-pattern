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
        return BookResource::collection($this->bookModel->with('ratings')->where('id', $id)->get());
    }

    public function update($book, $id)
    {
        return $this->bookModel->where('id', $id)->update($book);
    }

    public function delete($id)
    {
        return $this->bookModel->where('id', $id)->delete();
    }
}