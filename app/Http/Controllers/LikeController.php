<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LikeResource;
use App\Interfaces\LikeRepositoryInterface;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{

    private LikeRepositoryInterface $likeRepositoryinterface;

    public function __construct(LikeRepositoryInterface $likeRepositoryInterce)
    {
        $this->likeRepositoryinterface = $likeRepositoryInterce;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $likes = $this->likeRepositoryinterface->index();

        return ApiResponseClass::sendResponse(LikeResource::collection($likes), '', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $like =$this->likeRepositoryinterface->store($validated);
            
            DB::commit();

            return ApiResponseClass::sendResponse(new CategoryResource($like), 'Like created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
