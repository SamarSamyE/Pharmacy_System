<?php

namespace App\DataTables;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MedicinesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn(
            'actions',
            '
            <div class="d-flex flex-row justify-content-center" >
                 <div class="d-flex flex-row gap-2">
                 <div>
                 <a class="btn btn-success rounded" href="{{Route("medicines.show",$id)}}" >
                 Show
             </a>
                     </div>
                     <div>

                        <a  class="btn btn-primary rounded" id="{{$id}}" href="{{Route("medicines.edit",$id)}}">
                        Edit
                     </a>
                    </div>
                    <div>
                    <a  href="javascript:void(0)"  id="delete-medicine" data-url="{{ route("medicines.destroy",$id)}}"
                    class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>'
        )
        ->rawColumns(['actions'])

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Medicine $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('medicines-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('type'),
            Column::make('name'),
            Column::make('price'),
            Column::make('quantity'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('actions')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Medicines_' . date('YmdHis');
    }
}
