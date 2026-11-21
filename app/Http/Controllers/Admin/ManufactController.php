<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\ManuFactsDataTable;
use App\Http\Controllers\Controller;

use App\Models\Manufacturer;
use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class ManufactController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(ManuFactsDataTable $country) {
		return $country->render('admin.manufacturers.index', ['title' => trans('admin.manufacturers')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create() {
		return view('admin.manufacturers.create', ['title' => trans('admin.create_manufacturers')]);
	}

	public function store(Request $request) {

		$data = $request->validate(
            [
			    'name_ar' => 'required',
				'name_en' => 'required',
				'email' => 'required|email',
				'mobile' => 'required|numeric',
				'address' => 'sometimes|nullable',
				'facebook' => 'sometimes|nullable|url',
				'twitter' => 'sometimes|nullable|url',
				'website' => 'sometimes|nullable|url',
				'contact_name' => 'sometimes|nullable|string',
				'lat' => 'sometimes|nullable',
				'lng' => 'sometimes|nullable',
				'logo'    => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar' => trans('admin.name_ar'),
				'name_en' => trans('admin.name_en'),
                'email' =>trans('admin.email'),
                'mobile'=>trans('admin.mobile'),
                'address'=>trans('admin.address'),
                'facebook' => trans('admin.facebook'),
				'twitter' => trans('admin.twitter'),
				'website' => trans('admin.website'),
				'contact_name' => trans('admin.contact_name'),
				'lat'      => trans('admin.lat'),
				'lng'      => trans('admin.lng'),
				'logo'            => trans('admin.manufacturers_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'manufacturers',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Manufacturer::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('manufacturers'));
	}


	public function show($id) {
		//
	}


	public function edit($id) {
		$manufacturer = Manufacturer::find($id);
		$title   = trans('admin.edit');
		return view('admin.manufacturers.edit', compact('manufacturer', 'title'));
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
				'email' => 'required|email',
				'mobile' => 'required|numeric',
                'address' => 'sometimes|nullable',
				'facebook' => 'sometimes|nullable|url',
				'twitter' => 'sometimes|nullable|url',
				'website' => 'sometimes|nullable|url',
				'contact_name' => 'sometimes|nullable|string',
				'lat' => 'sometimes|nullable',
				'lng' => 'sometimes|nullable',
				'logo'    => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar' => trans('admin.name_ar'),
				'name_en' => trans('admin.name_en'),
                'email' =>trans('admin.email'),
                'mobile'=>trans('admin.mobile'),
                'address'=>trans('admin.address'),
                'facebook' => trans('admin.facebook'),
				'twitter' => trans('admin.twitter'),
				'website' => trans('admin.website'),
				'contact_name' => trans('admin.contact_name'),
				'lat'      => trans('admin.lat'),
				'lng'      => trans('admin.lng'),
				'logo'            => trans('admin.manufacturers_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'manufacturers',
					'upload_type' => 'single',
					'delete_file' => Manufacturer::find($id)->logo,
				]);
		}

		Manufacturer::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('manufacturers'));
	}


	public function destroy($id) {
		$manufacturers = Manufacturer::find($id);
		$manufacturers->logo!=null?Storage::delete($manufacturers->logo):"";
		$manufacturers->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('manufacturers'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$manufacturers = Manufacturer::find($id);
				$manufacturers->logo!=null?Storage::delete($manufacturers->logo):"";
				$manufacturers->delete();
			}
		} else {
			$manufacturers = Manufacturer::find(request('item'));
			$manufacturers->logo!=null?Storage::delete($manufacturers->logo):"";
			$manufacturers->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('manufacturers'));
	}
}
