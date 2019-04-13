<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);

        $photo          = $request->file('photo');
        $path           = $photo->store('public/users_img');
        $user->photo    = $path;

        $user->save();

        return redirect('/users');
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
        $user      = User::find($id);
        return view('admin.users.edit', compact('user'));
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

        // $user           = User::find($id);
        // $user           = new User;

        // $this->validate($request,[
        //     'name'      => 'required',
        //     'email'     => 'required|max:30|email|unique:users,email,'.$id,
        //     'password'  => 'nullable',
        //     'photo'     => 'nullable|image',
        // ]);

        // $user->name     = $request->name;
        // $user->email    = $request->email;
        // $photo          = $request->file('photo');

        // if (empty($photo)) {
        //     $path       = $user->photo;
        // } else {
        //     $path       = $photo->store('public/users_img');
        // }

        // $user->photo    = $path;

        // $user->save();
        // return redirect('/users');

        $user             = User::find($id);
        $messages = [
            'required'      => ':attribute wajib diisi!',
            'min'           => ':attribute harus diisi minimal :min karakter!',
            'max'           => ':attribute harus diisi maksimal :max karakter!',
            'unique'        => ':attribute yang anda isi telah digunakan',
        ];
        
        $this->validate($request,[
               'nama'           => 'required',
               'email'          => 'required|email|unique:users,email,'.$id,
               'password'       => 'nullable|min:5',
               'photo'          => 'nullable'
        ], $messages);

        $request->merge([
            'password'  => bcrypt($request->password),
        ]);

        $user->update($request->all());
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/users');
    }
}
