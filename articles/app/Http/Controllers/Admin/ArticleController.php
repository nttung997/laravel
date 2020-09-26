<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\ArticleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(ArticleService $articleService, UserService $userService)
    {
        $this->middleware('adminLogin');
        $this->articleService = $articleService;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleService->all();
        return view('admin.article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userService->all();
        return view('admin.article.create', ['users' => $users]);
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
                'title' => 'required|min:3|max:100',
                'description' => 'required|min:3|max:100',
                'user_id' => 'required',
                'status' =>'required',
            ],
            [
                'title.required' => 'Title is empty',
                'title.min' => 'Title is too short',
                'title.max' => 'Title is too long',
                'description.required' => 'Description is empty',
                'description.min' => 'Description is too short',
                'description.max' => 'Description is too long',
                'user_id.required' => 'Author is empty',
            ]
        );
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'status' => $request->status,
        ];

        $result = $this->articleService->create($data);
        if ($result) {
            return back()->with('success', 'Created');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = $this->userService->all();
        $article = $this->articleService->find($id);
        if ($article) {
            return view('admin.article.edit', ['article' => $article, 'users' => $users]);
        }
        return redirect('admin/articles');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required|min:3|max:100',
                'description' => 'required|min:3|max:100',
                'user_id' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Title is empty',
                'title.min' => 'Title is too short',
                'title.max' => 'Title is too long',
                'description.required' => 'Description is empty',
                'description.min' => 'Description is too short',
                'description.max' => 'Description is too long',
                'user_id.required' => 'Author is empty',
            ]
        );
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'status' => $request->status,
        ];
        $result = $this->articleService->update($data, $id);
        if ($result) {
            return back()->with('success', 'UPDATED');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->articleService->delete($id);
        if ($result) {
            return back()->with('success', 'DELETED');
        }
        return back();
    }
}
