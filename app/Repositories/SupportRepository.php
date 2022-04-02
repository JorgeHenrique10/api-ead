<?php

namespace App\Repositories;

use App\Models\Api\Support;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository
{
    use RepositoryTrait;
    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getMySupports(array $filters = [])
    {
        $filters['user'] = true;
        return $this->getAllSupports($filters);
    }

    public function getAllSupports(array $filters = [])
    {
        return $this->entity
            ->where(function ($query) use ($filters) {
                if (isset($filters['lession_id'])) {
                    $query->where('lession_id', $filters['lession_id']);
                }
                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }
                if (isset($filters['description'])) {
                    $query->where('description', $filters['description']);
                }
                if (isset($filters['user'])) {
                    $user = $this->getUserAuth();
                    $query->where('user_id', $user->id);
                }
            })
            ->orderBy('updated_at')
            ->get();
    }

    public function createNewSupport(array $data): Support
    {
        $support = $this->getUserAuth()->supports()->create($data);
        return $support;
    }
}
