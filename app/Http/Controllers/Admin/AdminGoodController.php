<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodRequest;
use App\Models\Category;
use App\Models\Good;
use App\Services\AdminFilterService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Image;

class AdminGoodController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->imageService->path(env('GOOD_PHOTO_PATH'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AdminFilterService $filterService)
    {

        $query = Good::query();

        $query = $filterService->apply($query);

        $goods = $query->sortDesc()
            ->get()
            ->load('category', 'photos')
            ->paginate(12);

        return view('admin.goods.index', ['goods' => $goods]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ImageService $imageService)
    {
        $categories = Category::all();
        return view('admin.goods.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GoodRequest $request)
    {
        $good = Good::create($request->all());
        $images = $request->get('images');

        if ($images){
            array_map(function ($image){
                $this->imageService->createGoodPhotos($image['src']);
            }, $images);

            $good->photos()->createMany($images);
        }

        return redirect(route('admin.goods.index'));
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
    public function edit(Good $good)
    {
        $good = $good->load('photos');
        $categories = Category::all();
        return view('admin.goods.edit', ['good' => $good,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GoodRequest $request, Good $good)
    {
        if(!$request->active){
            $request['active'] = 0;
        }
        $good->update($request->all());
        $images = $request->get('images');

        if ($images){
            array_map(function ($image){
                $this->imageService->createGoodPhotos($image['src']);
            }, $images);

            $good->photos()->delete();
            $good->photos()->createMany($images);
        }

        return redirect(route('admin.goods.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Good $good)
    {
        $photos = $good->photos;

        if ($photos){
            $photos->map(function ($photo){
                $this->imageService->delete($photo->src);
            });
        }
        $good->photos()->delete();
        $good->delete();

        return redirect(route('admin.goods.index'));
    }
}
