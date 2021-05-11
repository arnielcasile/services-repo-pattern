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
        try 
        {
            $result = $this->bookRepository->get();
            return $this->success('Load Successfully',$result);

        } catch (\Throwable $th) 
        {
            return $th->getMessage();
        }
    }

    public function store($book)
    {
        try 
        {
            $result = $this->bookRepository->store($book);
            return $result;
        } 
        catch (\Throwable $th) 
        {
            return $th->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $result = $this->bookRepository->show($id);
            return $result;
        } catch (\Throwable $th) {
           return $th->getMessage();
        }
    }

    public function update($book, $id)
    {
        try 
        {
            $result = $this->bookRepository->update($book, $id);
            return $result;
        } 
        catch (\Throwable $th) 
        {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        try 
        {
            $result = $this->bookRepository->delete($id);
            return $result;
        } 
        catch (\Throwable $th) 
        {
            return $th->getMessage();
        }
    }

}