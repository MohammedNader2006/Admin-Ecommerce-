<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\stateDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Country as ModelsCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	public function index(StateDataTable $state) {
		return $state->render('admin.states.index', ['title' => trans('admin.states')]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create()
{
    if (request()->ajax() && request()->has('country_id')) {

        $cities = City::where(
            'country_id',
            request('country_id')
        )->pluck(
            'city_name_' . session('lang'),
            'id'
        );

        return view('admin.states.partials.cities', [
            'cities' => $cities,
            'select' => request('select', ''),
        ]);
    }

    return view('admin.states.create', [
        'title' => trans('admin.create_states')
    ]);
}

	public function store(Request $request) {

		$data = $request->validate(
			[
				'state_name_ar' => 'required',
				'state_name_en' => 'required',
				'country_id' => 'required|numeric',
				'city_id' => 'required|numeric',

			], [], [
				'state_name_ar' => trans('admin.state_name_ar'),
				'state_name_en' => trans('admin.state_name_en'),
				'country_id' => trans('admin.country_id'),
				'city_id' => trans('admin.city_id'),

			]);


		State::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('states'));
	}


	public function show($id) {

	}


	public function edit($id) {
		$state = State::find($id);
		$title   = trans('admin.edit');
		return view('admin.states.edit', compact('state', 'title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 *
	 */
	public function update(Request $r, $id) {

		$data = $r->validate(
			[
				'state_name_ar' => 'required',
				'state_name_en' => 'required',
				'country_id' => 'required|numeric',
                'city_id' => 'required|numeric',
			], [], [
				'state_name_ar' => trans('admin.state_name_ar'),
				'state_name_en' => trans('admin.state_name_en'),
                'country_id' => trans('admin.country_id'),
                'city_id' => trans('admin.city_id')
			]);

		State::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('states'));
	}


	public function destroy($id) {
		$states = State::find($id);
		$states->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('states'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$states = State::find($id);
				$states->delete();
			}
		} else {
			$states = State::find(request('item'));
			$states->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('states'));
	}
}
