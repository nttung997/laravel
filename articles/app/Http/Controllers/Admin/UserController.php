<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\UserService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->middleware('adminLogin');
        $this->userService = $userService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->all();
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->all();
        return view('admin.user.create', ['roles' => $roles]);
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
                'email' => 'required|email|min:1|max:100',
                'password' => 'required|min:6|max:32',
                'passwordAgain' => 'required|same:password',
                'role_id' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Name is empty',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
                'email.required' => 'Email is empty',
                'email.min' => 'Email is too short',
                'email.max' => 'Email is too long',
                'email.email' => 'Email format is wrong',
                'password.required' => 'Password is empty',
                'password.min' => 'Password must be longer than 5 characters',
                'password.max' => 'Password must be shorter than 33 characters',
                'passwordAgain.required' => 'You must confirm password',
                'passwordAgain.same' => 'Password confirmation is not the same with password',
                'role_id.required' => 'Role is empty',
            ]
        );
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
        ];

        $result = $this->userService->create($data);
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
        $user = $this->userService->find($id);
        $roles = $this->roleService->all();
        if ($user) {
            return view('admin/user/edit', ['user' => $user, 'roles' => $roles]);
        }
        return redirect('admin/users');
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
                'role_id' => 'required',
                'status' => 'required',
            ],
            [
                'name.required' => 'Name is empty',
                'name.min' => 'Name is too short',
                'name.max' => 'Name is too long',
                'role_id.required' => 'Role is empty',
            ]
        );
        $data = [
            'name' => $request->name,
            'role_id' => $request->role_id,
            'status' => $request->status,
        ];
        if ($request->changePassword == "on") {
            $this->validate($request, [
                'password' => 'required|min:6|max:32',
                'passwordAgain' => 'required|same:password',
            ], [
                'password.required' => 'Password is empty',
                'password.min' => 'Password must be longer than 5 characters',
                'password.max' => 'Password must be shorter than 33 characters',
                'passwordAgain.required' => 'You must confirm password',
                'passwordAgain.same' => 'Password confirmation is not the same with password',
            ]);
            $data['password'] = bcrypt($request->password);
        }
        $result = $this->userService->update($data, $id);
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
        $result = $this->userService->delete($id);
        if ($result) {
            return back()->with('success', 'DELETED');
        }
        return back();
    }
}
