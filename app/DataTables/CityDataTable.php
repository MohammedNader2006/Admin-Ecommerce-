<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
{
    /**
     *
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
public function dataTable($query) {

		return datatables($query)
			->addColumn('checkbox', 'admin.cities.btn.checkbox')
			->addColumn('edit', 'admin.cities.btn.edit')
			->addColumn('delete', 'admin.cities.btn.delete')
			->rawColumns([
				'edit',
				'delete',
				'checkbox',
			]);
	}

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<user>
     */
   public function query()
{
    return City::query()
        ->with('country')
        ->select('cities.*');
}


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
{
    return $this->builder()
                ->setTableId('city-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->parameters([
                    'dom' => 'Blfrtip',

                    'initComplete' => " function () {
		            this.api().columns([2,3,4]).every(function () {
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
                    ->action("function(){
							window.location.href = '".\Illuminate\Support\Facades\URL::current()."/create';
						}"),

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
            Column::make('id')->title('#'),
            Column::make('city_name_ar')->title(trans('admin.city_name_ar')),
            Column::make('city_name_en')->title(trans('admin.city_name_en')),
           Column::make('country.country_name_' . session('lang'))->title(trans('admin.country_id')),
             Column::make('created_at')->title(trans('admin.created_at')),
            Column::make('updated_at')->title(trans('admin.updated_at')),
            Column::computed('edit')->title(trans('admin.edit'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::computed('delete')->title(trans('admin.delete'))
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
        return 'cities_' . date('YmdHis');
    }
}
