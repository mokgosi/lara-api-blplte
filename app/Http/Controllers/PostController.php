<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

use App\Interfaces\PostRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\PostResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware() 
    {
        return [
            new Middleware('auth:sactum', except:['index', 'show'])
        ];
    }

    private PostRepositoryInterface $postRepositoryInterface;

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
        $details =[
            'name' => $request->name,
            'details' => $request->details
        ];

        DB::beginTransaction();

        try{
             $post = $this->postRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new PostResource($post),'Post created Successful',201);

        } catch(\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = $this->postRepositoryInterface->show($id);

        return ApiResponseClass::sendResponse(new PostResource($post),'',200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name,
            'details' => $request->details
        ];
        DB::beginTransaction();
        try{
             $post = $this->postRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Post Updated Successfully','',201);

        } catch(\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->postRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Post Deleted Successfully','',204);
    }
}
