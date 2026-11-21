<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Request;

// if (!function_exists('setting')) {
// 	function setting() {
// 		return \App\Model\Setting::orderBy('id', 'desc')->first();
// 	}
// }

if (!function_exists('get_parent')) {
	function get_parent($dep_id) {
		// $list_department = [];

		$department = \App\Models\Department::find($dep_id);
		if ($department && $department->parent_id > 0) {
			return get_parent($department->parent_id).",".$dep_id;
		} else {
			return $dep_id;
		}
		// return $list_department;
	}
}

/// Scan Mall Id Exists /////
if (!function_exists('check_mall')) {
	function check_mall($id, $pid) {
		return \App\Models\MallProduct::where('product_id', $pid)->where('mall_id', $id)->count() > 0?true:false;
	}
}

if (!function_exists('load_dep')) {
	function load_dep($select = null, $dep_hide = null) {

		$departments = \App\Models\Department::selectRaw('dep_name_'.session('lang').' as text')
			->selectRaw('id as id')
			->selectRaw('parent_id as parent_id')
			->get(['text', 'parent_id', 'id']);
		$dep_arr = [];
		foreach ($departments as $department) {
			$list_arr             = [];
			$list_arr['icon']     = '';
			$list_arr['li_attr']  = '';
			$list_arr['a_attr']   = '';
			$list_arr['children'] = [];

			if ($select !== null and $select == $department->id) {

				$list_arr['state'] = [
					'opened'   => true,
					'selected' => true,
					'disabled' => false,
				];
			}

			if ($dep_hide !== null and $dep_hide == $department->id) {

				$list_arr['state'] = [
					'opened'   => false,
					'selected' => false,
					'disabled' => true,
					'hidden'   => true,
				];
			}

			$list_arr['id']     = $department->id;
			$list_arr['parent'] = $department->parent_id > 0?$department->parent_id:'#';
			$list_arr['text']   = $department->text;
			array_push($dep_arr, $list_arr);
		}

		return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
	}
}

if (!function_exists('setting')) {
	function setting() {
		return Setting::orderBy('id', 'desc')->first();
	}
}

if(!function_exists('aurl')){
    function aurl($url=null){
        return url('admin/'.$url);
    }
}
if(!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}
if(!function_exists('active_menu')){
    function active_menu($link){
        if(preg_match('/'.$link.'/i',Request::segment(2))){
            return ['menu-open','display:block'];
        }
        else{
            return['',''];
        }
    }
}
if(!function_exists('lang')){
    function lang(){
        if (session()->has('lang')){
            return session('lang');
        }
        else
        return setting()->main_lang;
    }
}
if(!function_exists('direction')){
    function direction(){
        if (session()->has('lang')){
            if(session('lang')=='ar')
            return 'rtl';
        else
            return 'ltr';
        }
        else
        return 'ltr';
    }
}
if(!function_exists('datatable_lang')){
    function datatable_lang(){

        return ['processing' => trans('admin.sProcessing'),
        'lengthMenu' => trans('admin.sLengthMenu'),
        'zeroRecords' => trans('admin.sZeroRecords'),
        'emptyTable' => trans('admin.sEmptyTable'),
        'info' => trans('admin.sInfo'),
        'infoEmpty' => trans('admin.sInfoEmpty'),
        'infoFiltered' => trans('admin.sInfoFiltered'),
        'search' => trans('admin.sSearch'),

        'paginate' => [
            'first' => trans('admin.sFirst'),
            'last' => trans('admin.sLast'),
            'next' => trans('admin.sNext'),
            'previous' => trans('admin.sPrevious'),
        ],

        'aria' => [
            'sortAscending' => trans('admin.sSortAscending'),
            'sortDescending' => trans('admin.sSortDescending'),
        ]];
    }
}
if (!function_exists('v_image')) {

    function v_image($ext = null)
    {
        if ($ext == null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        }

        return 'image|mimes:' . $ext;
    }
}

if (!function_exists('up')) {
function up()
{
    return new \App\Http\Controllers\Upload();
}
}

