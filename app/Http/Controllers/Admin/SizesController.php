<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\ColorsDatatable;
use App\DataTables\MallsDataTable;
use App\DataTables\SizesDatatable;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Mall;
use App\Models\Size;
use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class SizesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(SizesDatatable $size)
   {
      return $size->render('admin.sizes.index', ['title' => trans('admin.sizes')]);
   }
	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	 public function create()
   {
      return view('admin.sizes.create', ['title' => trans('admin.add')]);
   }

	public function store(Request $request) {

		$data = $request->validate(

			     [
            'name_ar' => 'required',
            'name_en' => 'required',
            'department_id'   => 'required|numeric',
            'is_public'   => 'required|in:yes,no',

         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
            'department_id'   => trans('admin.department_id'),
            'is_public'   => trans('admin.is_public'),
         ]);

      Size::create($data);
      session()->flash('success', trans('admin.record_added'));
      return redirect(aurl('sizes'));
    }


	public function show($id) {
		//
	}


	public function edit($id) {
		$size = Size::find($id);
      $title = trans('admin.edit');
      return view('admin.sizes.edit', compact('size', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 *
	 */
	public function update(Request $r, $id) {

		$data = $r->validate(

			     [
            'name_ar' => 'required',
            'name_en' => 'required',
            'department_id'   => 'required|numeric',
            'is_public'   => 'required|in:yes,no',

         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
            'department_id'   => trans('admin.department_id'),
            'is_public'   => trans('admin.is_public'),
         ]);

      Size::where('id', $id)->update($data);
      session()->flash('success', trans('admin.updated_record'));
      return redirect(aurl('sizes'));
	}


	public function destroy($id) {
		$sizes = Size::find($id);
      $sizes->delete();
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('sizes'));
	}

	public function multi_delete() {
		 if (is_array(request('item'))) {
         foreach (request('item') as $id) {
            $sizes = Size::find($id);
            $sizes->delete();
         }
      } else {
         $sizes = Size::find(request('item'));
         $sizes->delete();
      }
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('sizes'));
   }
}
