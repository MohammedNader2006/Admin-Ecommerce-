<?php
namespace App\Http\Controllers\Admin;
use App\DataTables\ManuFactsDataTable;
use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;

use App\Models\Trademark;
use App\Models\Country as ModelsCountry;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class ShippingController extends Controller {
	/**
	 * Display a listing of the resource.
	 *

	 */
	 public function index(ShippingDatatable $shipping) {
        return $shipping->render('admin.shipping.index', ['title' => trans('admin.shipping')]);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 */
	public function create() {
		return view('admin.shipping.create', ['title' => trans('admin.add')]);
	}

	public function store(Request $request) {

		$data = $request->validate(
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'user_id' => 'required|numeric',
                'lat'     => 'sometimes|nullable',
                'lng'     => 'sometimes|nullable',
                'icon'    => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar' => trans('admin.name_ar'),
                'name_en' => trans('admin.name_en'),
                'user_id' => trans('admin.user_id'),
                'lat'     => trans('admin.lat'),
                'lng'     => trans('admin.lng'),
                'icon'    => trans('admin.icon'),
            ]);

		 if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file'        => 'icon',
                'path'        => 'shipping',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

		Shipping::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('shipping'));
	}


	public function show($id) {
		//
	}


	public function edit($id) {
		$shipping = Shipping::find($id);
        $title    = trans('admin.edit');
        return view('admin.shipping.edit', compact('shipping', 'title'));
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
                'user_id' => 'required|numeric',
                'lat'     => 'sometimes|nullable',
                'lng'     => 'sometimes|nullable',
                'icon'    => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar' => trans('admin.name_ar'),
                'name_en' => trans('admin.name_en'),
                'user_id' => trans('admin.user_id'),
                'lat'     => trans('admin.lat'),
                'lng'     => trans('admin.lng'),
                'icon'    => trans('admin.icon'),
            ]);

        if (request()->hasFile('icon')) {
            $data['icon'] = up()->upload([
                'file'        => 'icon',
                'path'        => 'shipping',
                'upload_type' => 'single',
                'delete_file' => Shipping::find($id)->icon,
            ]);
		}

		Shipping::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('shipping'));
    }


	public function destroy($id) {
		$shipping = Shipping::find($id);
       $shipping->icon!=null?Storage::delete($shipping->icon):"";
        $shipping->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('shipping'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $shipping = Shipping::find($id);
                $shipping->icon!=null?Storage::delete($shipping->icon):"";
                $shipping->delete();
            }
        } else {
            $shipping = Shipping::find(request('item'));
            $shipping->icon!=null?Storage::delete($shipping->icon):"";
            $shipping->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('shipping'));
    }
}
