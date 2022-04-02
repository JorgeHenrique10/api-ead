<?php

namespace App\Repositories;

use App\Models\Api\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository
{
    use RepositoryTrait;
    protected $entity;

    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }

    public function createNewReply(array $data): ReplySupport
    {
        $reply = $this->getUserAuth()->replies()->create($data);
        return $reply;
    }
}
