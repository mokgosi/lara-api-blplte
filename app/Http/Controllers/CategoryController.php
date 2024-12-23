<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{

    private CategoryRepositoryInterface $categoryRepositoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)     
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     * @return Response - 200
     */
    public function index()
    {
        $data = $this->categoryRepositoryInterface->index();
        return ApiResponseClass::sendResponse(CategoryResource::collection($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryResource $data
     * @return Response - 201
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $category = $this->categoryRepositoryInterface->store($validated);

            DB::commit();

            return ApiResponseClass::sendResponse(new CategoryResource($category), 'Category created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Display the specified resource.
     * @param Category $category
     * @return Response - 200
     */
    public function show(Category $category)
    {
        $category = $this->categoryRepositoryInterface->show($category->id);

        return ApiResponseClass::sendResponse(new CategoryResource($category),'',200);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return Response - 201
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $category = $this->categoryRepositoryInterface->update($validated, $category->id);

            DB::commit();
            return ApiResponseClass::sendResponse('Category Updated Successfully.','',201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return Response - 204
     */
    public function destroy(Category $category)
    {
        $this->categoryRepositoryInterface->delete($category);

        return ApiResponseClass::sendResponse('Category Deleted Successfully.','', 204);
    }
}
