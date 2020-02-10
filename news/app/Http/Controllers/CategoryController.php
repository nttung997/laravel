<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories|min:3|max:100'
            ],
            [
                'name.required' => 'Name is empty',
                'name.unique'=>'Name is duplicated',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
            ]
        );
        $category = new Category;
        $category->name = $request->name;
        $category->name_unsigned = changeTitle($request->name);
        $category->save();
        return back()->with('success','Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        Validator::make($request->all(), [
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('categories')->ignore($category),
            ],
            [
                'name.required' => 'Name is empty',
                'name.unique'=>'Name is duplicated',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
            ]
        ])->validate();
        $category->name = $request->name;
        $category->name_unsigned = changeTitle($request->name);
        $category->save();
        return back()->with('success','Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Destroyed');
    }
}
