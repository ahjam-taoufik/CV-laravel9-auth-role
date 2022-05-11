<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $users = User::all()->whereNotIn('name','superAdmin');
        $users = User::all();
       
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {  
        

        
        if($user->id === 1){	
            // return redirect()->back()->with('error','You can not edit super admin');
            abort(403, 'You can not edit this User1');
        }
       
        $roles_test= $user->roles->pluck('name');
        if(($roles_test->contains('superAdmin')) && (Auth::user()->id != 1)  ){	
            // return redirect()->back()->with('error','You can not edit super admin');
            abort(403, 'You can not edit this User');
        }

      

        if (! Gate::allows('edit-table-users')) {
           return redirect()->route('admin.users.index');
        }
        
        $roles=Role::all();
        return view('admin.users.edit',['user'=> $user,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
     
      
        if ( Gate::allows('superAdmin')) { 
            $user->roles()->sync($request->roles);
         }


      

        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('superAdmin')) {
            return redirect()->route('admin.users.index');
         }
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');


    }
}
