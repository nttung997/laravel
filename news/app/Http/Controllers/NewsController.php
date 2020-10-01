<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', ['categories' => $categories]);
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
            'news_type_id' => 'required',
            'title' => 'required|min:3|unique:news',
            'summary' => 'required',
            'content' => 'required'
        ], [
            'news_type_id.required' => 'News Type is required',
            'title.required' => 'Title is required',
            'title.min' => 'Title must be longer than 3 character',
            'title.unique' => 'Title existed',
            'summary.required' => 'Summary is required',
            'content.required' => 'Content is required'
        ]);
        $news = new News;
        $news->title = $request->title;
        $news->title_unsigned = changeTitle($request->title);
        $news->summary = $request->summary;
        $news->content = $request->content;
        $news->hot = $request->hot;
        $news->view = 0;
        $news->news_type_id = $request->news_type_id;
        $disk = Storage::disk('public');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
                return back()->with('success', 'File type must be jpg, png or jpeg');
            }
            $path = $disk->putFile('image', $file);
            $news->image = $path;
        } else {
            $news->image = "";
        }
        $news->save();
        return back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show(news $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news)
    {
        $categories = Category::all();
        return view('admin/news/edit', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, news $news)
    {
        Validator::make($request->all(), [
            'title' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('news')->ignore($news),
            ],
            'news_type_id' => [
                'required'
            ],
            [
                'title.required' => 'Title is empty',
                'title.unique' => 'Title is duplicated',
                'title.min' => 'Title is too short',
                'title.max' => 'Title is too long',
                'news_type_id.required' => 'News Type is empty',
            ]
        ])->validate();
        $news->title = $request->title;
        $news->title_unsigned = changeTitle($request->title);
        $news->summary = $request->summary;
        $news->content = $request->content;
        $news->hot = $request->hot;
        $news->news_type_id = $request->news_type_id;
        $disk = Storage::disk('public');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
                return back()->with('success', 'File type must be jpg, png or jpeg');
            }
            $path = $disk->putFile('image', $file);
            if ($news->image)
                $disk->delete($news->image);
            $news->image = $path;
        } elseif ($request->deleteImage) {
            if ($news->image) {
                $disk->delete($news->image);
                $news->image = "";
            }
        }
        $news->save();
        return back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(news $news)
    {
        $news->delete();
        return back()->with('success', 'Destroyed');
    }
    
}
