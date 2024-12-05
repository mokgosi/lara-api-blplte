<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;

use App\Interfaces\PostRepositoryInterface;
use App\Classes\ApiResponseClass;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepositoryInterface;

    public function __construct(PostRepositoryInterface $postRepositoryInterface) 
    {
        $this->postRepositoryInterface = $postRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->postRepositoryInterface->index();
        return ApiResponseClass::sendResponse(PostResource::collection($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try{
             $post = $this->postRepositoryInterface->store($validated);

             DB::commit();
             
             return ApiResponseClass::sendResponse(new PostResource($post),'Post created Successful.',201);

        } catch(\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $this->postRepositoryInterface->show($post->id);

        return ApiResponseClass::sendResponse(new PostResource($post),'',200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // Gate::authorize('update', $post->id);

        $validated = $request->validated();

        DB::beginTransaction();

        try{
             $post = $this->postRepositoryInterface->update($validated , $post->id);

             DB::commit();
             return ApiResponseClass::sendResponse('Post Updated Successfully','',201);

        } catch(\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postRepositoryInterface->delete($post->id);

        return ApiResponseClass::sendResponse('Post Deleted Successfully','', 204);
    }

    public function getPostWithComments($id)
    {
        $data = $this->postRepositoryInterface->getPostWithComments($id);
        return ApiResponseClass::sendResponse(PostResource::collection($data),'',200);
    }
}
