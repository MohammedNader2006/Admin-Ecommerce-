<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminDataTable $admin)
    {
        return $admin->render('admin.admins.index',['title'=>'Admin control']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create',['title'=>trans('admin.create_admin')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {

         $validator= Validator::make(request()->all(), [
        'name' => 'required|',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|min:6',
    ],[],[
        'name'=>trans('admin.name'),
        'email'=>trans('admin.email'),
        'password'=>trans('admin.password'),
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $data = $validator->validated();

    $data['password'] = bcrypt($data['password']);

    Admin::create($data);

    session()->flash('success', trans('admin.record_added'));

    return redirect(aurl('admin'));
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
        $admin=Admin::find($id);
        $title=trans('admin.edit');
        return view('admin.admins.edit',compact('admin','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator= Validator::make(request()->all(), [
        'name' => 'required|',
        'email' => 'required|email|unique:admins,email,'.$id,
        'password' => 'required|min:6',
    ],[],[
        'name'=>trans('admin.name'),
        'email'=>trans('admin.email'),
        'password'=>trans('admin.password'),
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    $data = $validator->validated();
    $data['password'] = bcrypt($data['password']);
    Admin::where('id',$id)->update($data);

    session()->flash('success', trans('admin.updated_record'));

    return redirect(aurl('admin'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::destroy($id);
        session()->flash('success', trans('admin.deleted_record'));
       return redirect(aurl('admin'));
    }
    public function multi_delete()
    {
       if (is_array(request('item'))){
        Admin::destroy(request('item'));
       }else{
        Admin::find(request('item'))->delete();
       }
       session()->flash('success', trans('admin.deleted_record'));
       return redirect(aurl('admin'));
    }

}
