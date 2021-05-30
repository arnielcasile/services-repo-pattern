<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Http\Requests\JobPostingRequest;
use App\Services\JobPostingService;
use App\Traits\ResponseApi;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JobPostingController extends Controller
{

    use ResponseApi;

    protected $job_posting_service;

    public function __construct(JobPostingService $job_posting_service)
    {
        $this->job_posting_service = $job_posting_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->successResponse("Load All Data Successfully");

        try {
            $result["data"] = $this->job_posting_service->loadAllJobPosting();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        
        return view('job_posting.index')->with($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobPostingRequest $request)
    {
        $result = $this->successResponse("Inserted Successfully");
        try {
            $data = [
                'job_name'          => $request->job_name,
                'job_description'   => $request->job_description,
                'vacants'            => $request->vacants
            ];

            $result["data"] = $this->job_posting_service->storeJobPosting($data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }

        return $this->returnResponse($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->successResponse("Loaded Successfully");

        try {
            $result["data"] = $this->job_posting_service->showJobPosting($id);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function update($id, JobPostingRequest $request)
    {
        $result = $this->successResponse("Updated Successfully");

        try {

            $data = [
                'job_name'          => $request->job_name,
                'job_description'   => $request->job_description,
                'vacants'           => $request->vacants
            ];

            $result["data"] = $this->job_posting_service->updateJobPosting($id, $data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->successResponse("Deleted Successfully");

        try {
            $this->job_posting_service->deleteJobPosting($id);
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
}
