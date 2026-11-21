<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\CountryDatatable;
use App\Http\Controllers\Controller;

use App\Models\Country;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class CountriesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(CountryDatatable $country) {
		return $country->render('admin.countries.index', ['title' => trans('admin.countries')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create() {
		return view('admin.countries.create', ['title' => trans('admin.create_countries')]);
	}

	public function store(Request $request) {

		$data = $request->validate(
			[
				'country_name_ar' => 'required',
				'country_name_en' => 'required',
				'mob'             => 'required',
				'code'            => 'required',
				'currency'            => 'required',
				'logo'            => 'sometimes|nullable|'.v_image(),
			], [], [
				'country_name_ar' => trans('admin.country_name_ar'),
				'country_name_en' => trans('admin.country_name_en'),
				'mob'             => trans('admin.mob'),
				'currency'             => trans('admin.currency'),
				'code'            => trans('admin.code'),
				'logo'            => trans('admin.logo'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'countries',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Country::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('countries'));
	}


	public function show($id) {
		//
	}


	public function edit($id) {
		$country = Country::find($id);
		$title   = trans('admin.edit');
		return view('admin.countries.edit', compact('country', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 *
	 */
	public function update(Request $r, $id) {

		$data = $r->validate(
			[
				'country_name_ar' => 'required',
				'country_name_en' => 'required',
				'mob'             => 'required',
				'code'            => 'required',
				'currency'            => 'required',
				'logo'            => 'sometimes|nullable|'.v_image(),
			], [], [
				'country_name_ar' => trans('admin.country_name_ar'),
				'country_name_en' => trans('admin.country_name_en'),
				'mob'             => trans('admin.mob'),
				'code'            => trans('admin.code'),
				'currency'            => trans('admin.currency'),
				'logo'            => trans('admin.logo'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'countries',
					'upload_type' => 'single',
					'delete_file' => Country::find($id)->logo,
				]);
		}

		Country::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('countries'));
	}


	public function destroy($id) {
		$countries = Country::find($id);
		$countries->logo!=null?Storage::delete($countries->logo):"";
		$countries->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('countries'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$countries = Country::find($id);
				$countries->logo!=null?Storage::delete($countries->logo):"";
				$countries->delete();
			}
		} else {
			$countries = Country::find(request('item'));
			$countries->logo!=null?Storage::delete($countries->logo):"";
			$countries->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('countries'));
	}
}
