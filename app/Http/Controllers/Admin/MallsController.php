<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\MallsDataTable;
use App\Http\Controllers\Controller;

use App\Models\Mall;
use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class MallsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(MallsDataTable $country) {
		return $country->render('admin.malls.index', ['title' => trans('admin.malls')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create() {
		return view('admin.malls.create', ['title' => trans('admin.create_malls')]);
	}

	public function store(Request $request) {

		$data = $request->validate(
            [
			    'name_ar' => 'required',
				'name_en' => 'required',
                'country_id' => 'required',
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
                'country_id' =>trans('admin.country_id'),
                'mobile'=>trans('admin.mobile'),
                'address'=>trans('admin.address'),
                'facebook' => trans('admin.facebook'),
				'twitter' => trans('admin.twitter'),
				'website' => trans('admin.website'),
				'contact_name' => trans('admin.contact_name'),
				'lat'      => trans('admin.lat'),
				'lng'      => trans('admin.lng'),
				'logo'            => trans('admin.malls_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'malls',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Mall::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('malls'));
	}


	public function show($id) {
		//
	}


	public function edit($id) {
		$malls = Mall::find($id);
		$title   = trans('admin.edit');
		return view('admin.malls.edit', compact('malls', 'title'));
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
				'country_id' => 'required',
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
                'country_id' =>trans('admin.country_id'),
                'mobile'=>trans('admin.mobile'),
                'address'=>trans('admin.address'),
                'facebook' => trans('admin.facebook'),
				'twitter' => trans('admin.twitter'),
				'website' => trans('admin.website'),
				'contact_name' => trans('admin.contact_name'),
				'lat'      => trans('admin.lat'),
				'lng'      => trans('admin.lng'),
				'logo'            => trans('admin.malls_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'malls',
					'upload_type' => 'single',
					'delete_file' => Mall::find($id)->logo,
				]);
		}

		Mall::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('malls'));
	}


	public function destroy($id) {
		$malls = Mall::find($id);
		$malls->logo!=null?Storage::delete($malls->logo):"";
		$malls->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('malls'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$malls = Mall::find($id);
				$malls->logo!=null?Storage::delete($malls->logo):"";
				$malls->delete();
			}
		} else {
			$malls = Mall::find(request('item'));
			$malls->logo!=null?Storage::delete($malls->logo):"";
			$malls->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('malls'));
	}
}
