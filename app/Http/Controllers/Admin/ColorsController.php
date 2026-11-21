<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\ColorsDatatable;
use App\DataTables\MallsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Mall;
use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class ColorsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(ColorsDatatable $color)
   {
      return $color->render('admin.colors.index', ['title' => trans('admin.colors')]);
   }
	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	 public function create()
   {
      return view('admin.colors.create', ['title' => trans('admin.add')]);
   }

	public function store(Request $request) {

		$data = $request->validate(

			     [
            'name_ar' => 'required',
            'name_en' => 'required',
            'color'   => 'required|string',

         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
            'color'   => trans('admin.color'),
         ]);

      Color::create($data);
      session()->flash('success', trans('admin.record_added'));
      return redirect(aurl('colors'));
    }


	public function show($id) {
		//
	}


	public function edit($id) {
		$color = Color::find($id);
      $title = trans('admin.edit');
      return view('admin.colors.edit', compact('color', 'title'));
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
            'color'   => 'required|string',
         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
            'color'   => trans('admin.color'),
         ]);

      Color::where('id', $id)->update($data);
      session()->flash('success', trans('admin.updated_record'));
      return redirect(aurl('colors'));
	}


	public function destroy($id) {
		$colors = Color::find($id);
      $colors->delete();
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('colors'));
	}

	public function multi_delete() {
		 if (is_array(request('item'))) {
         foreach (request('item') as $id) {
            $colors = Color::find($id);
            $colors->delete();
         }
      } else {
         $colors = Color::find(request('item'));
         $colors->delete();
      }
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('colors'));
   }
}
