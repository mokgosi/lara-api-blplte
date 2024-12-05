<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepositoryInterface;

    public function __construct(CommentRepositoryInterface $commentRepositoryInterface)     
    {
        $this->commentRepositoryInterface = $commentRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->commentRepositoryInterface->index();
        return ApiResponseClass::sendResponse(CommentResource::collection($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $comment = $this->commentRepositoryInterface->store($validated);

            DB::commit();

            return ApiResponseClass::sendResponse(new CommentResource($comment),'Comment created Successful.',201);

        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment = $this->commentRepositoryInterface->show($comment->id);

        return ApiResponseClass::sendResponse(new CommentResource($comment),'',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $comment = $this->commentRepositoryInterface->update($validated, $comment->id);

            DB::commit();
            
            return ApiResponseClass::sendResponse('Post Updated Successfully','',201);

        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->commentRepositoryInterface->delete($comment->id);

        return ApiResponseClass::sendResponse('Post Deleted Successfully','',204);
    }
}
