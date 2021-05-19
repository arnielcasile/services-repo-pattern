<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Traits\ResponseAPI;

class BookService
{
    use ResponseAPI;

    protected $bookRepository;

    public function __construct(BookRepository $bookReposirtory)
    {
        $this->bookRepository = $bookReposirtory;
    }

    public function get()
    {
        return $this->bookRepository->get();

    }

    public function store($book)
    {
        return $this->bookRepository->store($book);
    }

    public function show($id)
    {
        return $this->bookRepository->show($id);
    }

    public function update($book, $id)
    {
        return $this->bookRepository->update($book, $id);
      
    }

    public function delete($id)
    {
        return $this->bookRepository->delete($id);

    }

}