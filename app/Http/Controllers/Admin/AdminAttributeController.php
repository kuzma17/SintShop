<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\TypeAttribute;
use App\Services\AdminFilterService;
use Illuminate\Http\Request;

class AdminAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AdminFilterService $filterService)
    {
        $query = Attribute::with('category','type');
        $query = $filterService->apply($query);
        $attributes = $query->get()->paginate(12);
        $categories = Category::sortDesc()->get();
        $types = TypeAttribute::all();

        return view('admin.attributes.index', ['attributes' => $attributes, 'categories' => $categories, 'types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $types = TypeAttribute::all();
        return view('admin.attributes.create', ['categories' => $categories, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $request['active'] = $request->input('active')? 1: 0;
        $attribute = Attribute::create($request->all());

        $attribute->addValues($request);

        clearCache('filter_category_'.$attribute->category->id);

        return redirect(route('admin.attributes.index'));
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
    public function edit(Attribute $attribute)
    {
        $attribute = $attribute->load('values');
        $categories = Category::all();
        $types = TypeAttribute::all()->toArray();

        return view('admin.attributes.edit', ['attribute' => $attribute, 'categories' => $categories, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {

        $request['active'] = $request->input('active')? 1: 0;
        $attribute->update($request->all());

        $attribute->addValues($request);

        clearCache('filter_category_'.$attribute->category->id);

        return redirect(route('admin.attributes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect(route('admin.attributes.index'));
    }

}
