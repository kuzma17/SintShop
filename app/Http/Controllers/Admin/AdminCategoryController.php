<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $categories = $category->getAllCategories();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $categories = $category->getAllCategories();
        return view('admin.categories.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request, ImageService $imageService)
    {
        if(!$request->active){
            $request['active'] = 0;
        }
        $image = $request->files->get('file');
        if ($image){
            $name = $request->slug.'.jpg';
            $request['image'] = $imageService->create($image, $name, 290, 290);
        }

        Category::create($request->all());

        clearCache('filter_sale');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = $category->getAllCategories();
        return view('admin.categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category, ImageService $imageService)
    {

        if(!$request->active){
            $request['active'] = 0;
        }
        $image = $request->files->get('file');
        if ($image){
            $name = $request->slug.'.jpg';
            $request['image'] = $imageService->create($image, $name, 290, 290);
        }

        $category->update($request->all());

        clearCache('filter_sale');

        return redirect(route('admin.categories.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('admin.categories.index'));
    }
}
