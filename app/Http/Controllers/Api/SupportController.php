<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSupport;
use App\Http\Resources\Api\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function index(Request $request)
    {
        $supports = $this->repository->getAllSupports($request->all());
        // dd($supports);
        return SupportResource::collection($supports);
        // return $supports;
    }
    public function show(Request $request)
    {
        $support = $this->repository->getMySupports($request->all());
        return SupportResource::collection($support);
    }
    public function store(StoreSupport $request)
    {
        return new SupportResource($this->repository->createNewSupport($request->validated()));
    }
}
