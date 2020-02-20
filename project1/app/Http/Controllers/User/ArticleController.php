<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct(ArticleService $articleService)
    {
        $this->middleware('login');
        $this->articleService = $articleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleService->allByUserIdPaginate(Auth::id(),100);
        return view('user.article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.article.create');
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
                'status' => 'required',
            ],
            [
                'title.required' => 'Title is empty',
                'title.min' => 'Title is too short',
                'title.max' => 'Title is too long',
                'description.required' => 'Description is empty',
                'description.min' => 'Description is too short',
                'description.max' => 'Description is too long',
            ]
        );
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'status' => $request->status,
        ];

        $article = $this->articleService->create($data);
        if ($article) {
            return back()->with('success', 'CREATED');
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
        $article = $this->articleService->find($id, Auth::id());
        if ($article) {
            return view('user.article.edit', ['article' => $article]);
        }
        return redirect('articles');
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
                'status' => 'required',
            ],
            [
                'title.required' => 'Title is empty',
                'title.min' => 'Title is too short',
                'title.max' => 'Title is too long',
                'description.required' => 'Description is empty',
                'description.min' => 'Description is too short',
                'description.max' => 'Description is too long',
            ]
        );
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $result = $this->articleService->update($data, $id, Auth::id());
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
        $result = $this->articleService->delete($id, Auth::id());
        if ($result) {
            return back()->with('success', 'DELETED');
        }
        return back();
    }
}
