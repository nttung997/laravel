<?php

namespace App\Http\Controllers;

use App\NewsType;
use App\Category;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class NewsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsTypes = NewsType::all();
        return view('admin.newsType.index', ['newsTypes' => $newsTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.newsType.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:news_types|min:1|max:100',
            'category_id' => 'required'
        ], [
            'name.required' => 'Name is empty',
            'name.unique' => 'Name is duplicated',
            'name.min' => 'Name is too short',
            'name.max' => 'Name is too long',
            'category_id.required' => 'Category is empty',
        ]);
        $newsType = new NewsType;
        $newsType->name = $request->name;
        $newsType->category_id = $request->category_id;
        $newsType->name_unsigned = changeTitle($request->name);
        $newsType->save();
        return back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsType  $newsType
     * @return \Illuminate\Http\Response
     */
    public function show(NewsType $newsType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsType  $newsType
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsType $newstype)
    {
        $categories = Category::all();
        return view('admin/newsType/edit', ['newsType' => $newstype, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsType  $newsType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsType $newstype)
    {
        Validator::make($request->all(), [
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('news_types')->ignore($newstype),
            ],
            'category_id' => [
                'required'
            ],
            [
                'name.required' => 'Name is empty',
                'name.unique'=>'Name is duplicated',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
                'category_id.required' => 'Category is empty',
            ]
        ])->validate();
        $newstype->name = $request->name;
        $newstype->name_unsigned = changeTitle($request->name);
        $newstype->category_id = $request->category_id;
        $newstype->save();
        return back()->with('success','Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsType  $newsType
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsType $newstype)
    {
        $newstype->delete();
        return back()->with('success', 'Destroyed');
    }
}
