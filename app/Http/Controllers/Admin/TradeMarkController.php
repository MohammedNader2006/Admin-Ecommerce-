<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\TradeMarkDataTable;
use App\Http\Controllers\Controller;

use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class TradeMarkController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(TradeMarkDataTable $country) {
		return $country->render('admin.trademarks.index', ['title' => trans('admin.trademarks')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create() {
		return view('admin.trademarks.create', ['title' => trans('admin.create_trademarks')]);
	}

	public function store(Request $request) {

		$data = $request->validate(
			[
				'name_ar' => 'required',
				'name_en' => 'required',
				'logo'    => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar' => trans('admin.name_ar'),
				'name_en' => trans('admin.name_en'),
				'logo'    => trans('admin.trade_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'trademarks',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Trademark::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('trademarks'));
	}


	public function show($id) {
		//
	}


	public function edit($id) {
		$trademark = Trademark::find($id);
		$title   = trans('admin.edit');
		return view('admin.trademarks.edit', compact('trademark', 'title'));
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
				'logo'            => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar' => trans('admin.name_ar'),
				'name_en' => trans('admin.name_en'),
				'logo'            => trans('admin.trade_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'trademarks',
					'upload_type' => 'single',
					'delete_file' => Trademark::find($id)->logo,
				]);
		}

		Trademark::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('trademarks'));
	}


	public function destroy($id) {
		$trademarks = Trademark::find($id);
		$trademarks->logo!=null?Storage::delete($trademarks->logo):"";
		$trademarks->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('trademarks'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$trademarks = Trademark::find($id);
				$trademarks->logo!=null?Storage::delete($trademarks->logo):"";
				$trademarks->delete();
			}
		} else {
			$trademarks = Trademark::find(request('item'));
			$trademarks->logo!=null?Storage::delete($trademarks->logo):"";
			$trademarks->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('trademarks'));
	}
}
