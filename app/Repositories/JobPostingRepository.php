<?php

namespace App\Repositories;

use App\Models\JobPosting;

class JobPostingRepository 
{
    protected $job_posting_model;

    public function __construct(JobPosting $job_posting_model)
    {
        $this->job_posting_model = $job_posting_model;
    }

    public function loadAllJobPosting()
    {
        return $this->job_posting_model->all();
    }

    public function storeJobPosting($data)
    {
        return $this->job_posting_model->create($data);
    }

    public function showJobPosting($id)
    {
        return $this->job_posting_model->findOrFail($id);
    }

    public function updateJobPosting($id, $data)
    {
        return $this->job_posting_model->findOrFail($id)->update($data);
    }

    public function deleteJobPosting($id)
    {
        return $this->job_posting_model->findOrFail($id)->delete();
    }
}