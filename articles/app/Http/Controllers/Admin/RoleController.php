<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(RoleService $roleService)
    {
        $this->middleware('adminLogin');
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->all();
        return view('admin.role.index', ['roles' => $roles]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
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
                'name' => 'required|min:3|max:100',

            ],
            [
                'name.required' => 'Name is empty',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
            ]
        );
        $data = ['name' => $request->name];

        $result = $this->roleService->create($data);
        if ($result) {
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
        $role = $this->roleService->find($id);
        if ($role) {
            return view('admin.role.edit', ['role' => $role]);
        }
        return redirect('admin/roles');
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
                'name' => 'required|min:3|max:100',

            ],
            [
                'name.required' => 'Name is empty',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
            ]
        );
        $data = ['name' => $request->name];
        $result = $this->roleService->update($data, $id);
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
        $result = $this->roleService->delete($id);
        if ($result) {
            return back()->with('success', 'DELETED');
        }
        return back();
    }
}
