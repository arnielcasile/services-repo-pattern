<?php

namespace App\Services;

use App\Repositories\JobPostingRepository;

class JobPostingService
{

    protected $job_posting_repository;

    public function __construct(JobPostingRepository $job_posting_repository)
    {
        $this->job_posting_repository = $job_posting_repository;
    }

    public function loadAllJobPosting()
    {
        return $this->job_posting_repository->loadAllJobPosting();
    }

    public function storeJobPosting($data)
    {
        return $this->job_posting_repository->storeJobPosting($data);
    }

    public function showJobPosting($id)
    {
        return $this->job_posting_repository->showJobPosting($id);
    }

    public function updateJobPosting($id, $data)
    {
        return $this->job_posting_repository->updateJobPosting($id, $data);
    }

    public function deleteJobPosting($id)
    {
        return $this->job_posting_repository->deleteJobPosting($id);
    }
}