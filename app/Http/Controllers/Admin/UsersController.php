<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $admin)
    {

        return $admin->render('admin.users.index',['title'=>trans('admin.users')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //authorization
        
//         if (Gate::denies('isMo')) {
// return 'you are ot aythorized';
// }

// Gate::authorize('isMo');
return view('admin.users.create',['title'=>trans('admin.add')]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {

         $validator= Validator::make(request()->all(), [
        'name' => 'required|',
        'level' => 'required|in:user,company,vendor',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ],[],[
        'name'=>trans('admin.name'),
        'level'=>trans('admin.level'),
        'email'=>trans('admin.email'),
        'password'=>trans('admin.password'),
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $data = $validator->validated();

    $data['password'] = bcrypt($data['password']);

    User::create($data);

    session()->flash('success', trans('admin.record_added'));

    return redirect(aurl('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);
        $title=trans('admin.edit');
        return view('admin.users.edit',compact('user','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator= Validator::make(request()->all(), [
        'name' => 'required|',
        'level' => 'required|in:user,company,vendor',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'required|min:6',
    ],[],[
        'name'=>trans('admin.name'),
        'levle'=>trans('admin.level'),
        'email'=>trans('admin.email'),
        'password'=>trans('admin.password'),
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $data = $validator->validated();
    $data['password'] = bcrypt($data['password']);
    User::where('id',$id)->update($data);

    session()->flash('success', trans('admin.updated_record'));

    return redirect(aurl('users'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        session()->flash('success', trans('admin.deleted_record'));
       return redirect(aurl('users'));
    }
    public function multi_delete()
    {
       if (is_array(request('item'))){
        User::destroy(request('item'));
       }else{
        User::find(request('item'))->delete();
       }
       session()->flash('success', trans('admin.deleted_record'));
       return redirect(aurl('users'));
    }

}
