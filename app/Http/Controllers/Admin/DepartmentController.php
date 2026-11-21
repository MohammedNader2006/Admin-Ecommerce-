<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\CityDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Country as ModelsCountry;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index() {
return view('admin.departments.index', ['title' => trans('admin.departments')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create() {
		return view('admin.departments.create', ['title' => trans('admin.add_department')]);
	}

	public function store(Request $request) {

		$data = $request->validate(
			[
				'dep_name_ar' => 'required',
				'dep_name_en' => 'required',
				'parent_id'      => 'sometimes|nullable|numeric',
				'icon'        => 'sometimes|nullable|'.v_image(),
				'description' => 'sometimes|nullable',
				'keyword'     => 'sometimes|nullable',

			], [], [
				'dep_name_ar' => trans('admin.dep_name_ar'),
				'dep_name_en' => trans('admin.dep_name_en'),
				'parent_id'      => trans('admin.parent'),
				'icon'        => trans('admin.icon'),
				'description' => trans('admin.description'),
				'keyword'     => trans('admin.keyword'),
			]);
        // لو مفيش Parent نخلي القيمة NULL
        $data['parent_id'] = $request->input('parent_id') ?: null;
		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'departments',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Department::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('departments'));
	}


	public function show($id) {

	}

	public function edit($id) {
		$department = Department::find($id);
		$title   = trans('admin.edit');
		return view('admin.departments.edit', compact('department', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 *
	 */
	public function update(Request $r, $id) {

		$data = $r->validate(
			[
				'dep_name_ar' => 'required',
				'dep_name_en' => 'required',
				'parent_id'      => 'sometimes|nullable|numeric',
				'icon'        => 'sometimes|nullable|'.v_image(),
				'description' => 'sometimes|nullable',
				'keyword'     => 'sometimes|nullable',

			], [], [
				'dep_name_ar' => trans('admin.dep_name_ar'),
				'dep_name_en' => trans('admin.dep_name_en'),
				'parent_id'      => trans('admin.parent'),
				'icon'        => trans('admin.icon'),
				'description' => trans('admin.description'),
				'keyword'     => trans('admin.keyword'),
			]);

            if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'departments',
					'upload_type' => 'single',
					'delete_file' => Department::find($id)->icon,
				]);
            }
            $data['parent_id'] = $r->input('parent_id') ?: null;
		Department::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('departments'));
	}

public static function delete_parent($id) {
		$department_parent = Department::where('parent_id', $id)->get();
		foreach ($department_parent as $sub) {
			self::delete_parent($sub->id);
			if (!empty($sub->icon)) {
				Storage::has($sub->icon)?Storage::delete($sub->icon):'';
			}
			$subdepartment = Department::find($sub->id);
			if (!empty($subdepartment)) {
				$subdepartment->delete();
			}
		}
		$dep = Department::find($id);

		if (!empty($dep->icon)) {
			Storage::has($dep->icon)?Storage::delete($dep->icon):'';
		}
		$dep->delete();
	}
	public function destroy($id) {
		self::delete_parent($id);
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('departments'));
	}


}
