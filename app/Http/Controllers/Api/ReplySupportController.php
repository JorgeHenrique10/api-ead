<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreReplySupport;
use App\Http\Resources\Api\ReplySupportResource;
use App\Repositories\ReplySupportRepository;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepository $replySupportRepository)
    {
        $this->repository = $replySupportRepository;
    }

    public function store(StoreReplySupport $request)
    {
        return new ReplySupportResource($this->repository->createNewReply($request->validated()));
    }
}
