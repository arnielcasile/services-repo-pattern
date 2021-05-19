<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use App\Traits\ResponseApi;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    use ResponseApi;

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware('auth:api');
        $this->bookService = $bookService;
    }
    
    public function index()
    {
        $result = $this->successResponse("Books Successfully Loaded");
        try {
            $result["data"] = $this->bookService->get();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }

        return $this->returnResponse($result);
        
    }

    public function store(BookRequest $request)
    {
        $result = $this->successResponse("Inserted Successfully");
        try {
            $book = [
                'user_id'       => $request->user()->id,
                'title'         => $request->title,
                'description'   => $request->description,
            ];
    
            $this->bookService->store($book);

        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }

        return $this->returnResponse($result);
        
        
    }

    public function show($id)
    {
        $result = $this->successResponse("Books Loaded Successfully");
        try 
        {
            $result["data"] = $this->bookService->show($id);
        } 
        catch (ModelNotFoundException $except) 
        {
            $result = $this->modelNotFoundResponse($id);
        }
        catch(\Exception $e)
        {
            $result = $this->errorResponse($e);
        }

        return $this->returnResponse($result);
        
    }

    public function update(BookRequest $request, $id)
    {
        $result = $this->successResponse("Updated Successfully");

        try 
        {
            $book = [
                'user_id'       => $request->user()->id,
                'title'         => $request->title,
                'description'   => $request->description,
            ];
            $this->bookService->update($book, $id);
        } 
        catch (ModelNotFoundException $except) 
        {
            $result = $this->modelNotFoundResponse($id);
        }
        catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }

        return $this->returnResponse($result);
    }

    public function destroy($id)
    {
        
        $result = $this->successResponse("Deleted Successfully");

        try 
        {
            $this->bookService->delete($id);
        } 
        catch (ModelNotFoundException $except) 
        {
            $result = $this->modelNotFoundResponse($id);
        }
        catch (\Exception $e) 
        {
            $result = $this->errorResponse($e);
        }
        
        return $this->returnResponse($result);
    }
}
