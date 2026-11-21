<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\ColorsDatatable;
use App\DataTables\MallsDataTable;
use App\DataTables\WeightsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Mall;
use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class WeightsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(WeightsDataTable $color)
   {
      return $color->render('admin.weights.index', ['title' => trans('admin.weights')]);
   }
	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	 public function create()
   {
      return view('admin.weights.create', ['title' => trans('admin.add')]);
   }

	public function store(Request $request) {

		$data = $request->validate(

			     [
            'name_ar' => 'required',
            'name_en' => 'required',


         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),

         ]);

      Weight::create($data);
      session()->flash('success', trans('admin.record_added'));
      return redirect(aurl('weights'));
    }


	public function show($id) {
		//
	}


	public function edit($id) {
		$weight = Weight::find($id);
      $title = trans('admin.edit');
      return view('admin.weights.edit', compact('weight', 'title'));
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

         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),

         ]);

      Weight::where('id', $id)->update($data);
      session()->flash('success', trans('admin.updated_record'));
      return redirect(aurl('weights'));
	}


	public function destroy($id) {
		$weights = Weight::find($id);
      $weights->delete();
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('weights'));
	}

	public function multi_delete() {
		 if (is_array(request('item'))) {
         foreach (request('item') as $id) {
            $weights = Weight::find($id);
            $weights->delete();
         }
      } else {
         $weights = Weight::find(request('item'));
         $weights->delete();
      }
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('weights'));
   }
}
