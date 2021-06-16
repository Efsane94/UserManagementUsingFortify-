<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if(Gate::denies('logged-in')){
            dd('no access allowed');
        }
        if(Gate::allows('is-admin'))
        {
            return view('admin.users.index', ['users'=>User::paginate(10)]);
        }
        dd('You need to be admin');
    }

    public function create()
    {
        return view('admin.users.create', ['roles'=>Role::all()]);
    }

    public function store(StoreUserRequest $request)
    {
        //$validatedData=$request->validated();
        //$user=User::create($validatedData);

        $newUser=new CreateNewUser();
        $user=$newUser->create($request->only(['name','email','password','password_confirmation']));
        $user->roles()->sync($request->roles);

        $request->session()->flash('success','User has been created.');
        return redirect(route('admin.users.index'));
    }

    public function edit($id)
    {
        return view('admin.users.edit',
            [
                'roles'=>Role::all(),
                'user'=>User::find($id)
            ]);
    }

    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);

        if(!$user)
        {
            $request->session()->flash('error','You can not edit this user.');
        }
        $user->update($request->except(['_token','roles']));
        $user->roles()->sync($request->roles);

        $request->session()->flash('success','User has been updated.');

        return redirect(route('admin.users.index'));
    }

    public function destroy($id, Request $request)
    {
        User::destroy($id);

        $request->session()->flash('success','User has been deleted.');
        return redirect(route('admin.users.index'));
    }
}
