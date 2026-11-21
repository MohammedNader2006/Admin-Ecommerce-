<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{ $id }}"><i class="fa fa-trash"></i></button>

<!-- Modal -->
<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      <form action="{{ route('manufacturers.destroy',$id) }}" method="POST">
        @csrf
        @method('DELETE')
      <div class="modal-body">
        <h4>{{ trans('admin.delete_this',['name'=> session('lang') == 'ar'?$name_ar:$name_en ]) }}</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
        <button type="submit" class="btn btn-danger">{{ trans('admin.yes') }}</button>
      </div>
      </form>
    </div>

  </div>
</div>
