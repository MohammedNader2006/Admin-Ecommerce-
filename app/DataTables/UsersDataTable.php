<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     *
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))
        ->addColumn('Edit', function ($user) {
            return view('admin.users.btn.edit', ['id' => $user->id]);

            })->addColumn('Delete',function($user){
            return view('admin.users.btn.delete',['id'=>$user->id,'name'=>$user->name]);

            })->addColumn('checkbox',function($user){
            return view('admin.users.btn.checkbox',['id'=>$user->id]);
        })->addColumn('level',function($user){
            return view('admin.users.btn.level',['level'=>$user->level]);
        })
        ->rawColumns(['Edit', 'Delete', 'checkbox'])
        ->setRowId('id');
}

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<user>
     */
    public function query(): QueryBuilder
    {
        return User::query()->where(function($q){
            if(request()->has('level')){
                return $q->where('level',request('level'));
            }
        });
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
{
    return $this->builder()
                ->setTableId('user-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->parameters([
                    'dom' => 'Blfrtip',

                    'initComplete' => " function () {
		            this.api().columns([2,3]).every(function () {
		            var column = this;
		            var input = document.createElement(\"input\");
		            $(input).appendTo($(column.footer()).empty())
		            .on('keyup', function () {
		            column.search($(this).val(), false, false, true).draw();
		                });
		            });
		         }",

                 'language' => datatable_lang(),
                ])
                ->lengthMenu([10,25,50,100,trans('user.all_record')])
                ->buttons([
                   Button::make('create')
    ->text('<i class="fa fa-plus"></i> ' . trans('admin.add'))
    ->className('btn btn-info')
    ->action("window.location = '" . route('users.create') . "';"),

                    Button::make('print')
                        ->className('btn btn-primary')
                        ->text('<i class="fa fa-print"></i>'),

                    Button::make('csv')
                        ->className('btn btn-info')
                        ->text('<i class="fa fa-file"></i> ' . trans('admin.ex_csv')),

                    Button::make('excel')
                        ->className('btn btn-success')
                        ->text('<i class="fa fa-file"></i> ' . trans('admin.ex_excel')),

                    Button::make('reload')
                        ->className('btn btn-default')
                        ->text('<i class="fa fa-refresh"></i>'),

                        [
    'text' => '<i class="fa fa-trash"></i>',
    'className' => 'btn btn-danger delBtn',
]





                ]);
}

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('checkbox')->title('<input type="checkbox" class="check_all" onclick="check_all()" />')
            ->exportable(false)
            ->printable(false)
            ->orderable(false)
            ->searchable(false),
            Column::make('id')->title('ID'),
            Column::make('name')->title(trans('admin.name')),
            Column::make('email')->title(trans('admin.email')),
            Column::make('level')->title(trans('admin.level')),
             Column::make('created_at')->title(trans('admin.created_at')),
            Column::make('updated_at')->title(trans('admin.updated_at')),
            Column::computed('Edit')->title(trans('admin.edit'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::computed('Delete')->title(trans('admin.delete'))
                  ->exportable(false)
                  ->printable(false)
                  ->orderable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
