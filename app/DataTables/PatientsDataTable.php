<?php

namespace App\DataTables;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('Name',function(Patient $patient){
            return $patient->type->name;
        })
        ->addColumn('Owner Email',function(Patient $patient){
            return $patient->type->email;
        })
        // ->addColumn('avatar',function(Patient $patient){
        //     return '<img src="'. asset("storage/".$patient->type->avatar) .'" width="40" class="img-circle" align="center" />';
        // })
        // return (new EloquentDataTable($query))
            // ->rawColumn('avatar')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Patient $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('patients-table')
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
            // Column::computed('avatar')->addClass('text-center')->title('Avatar'),
            Column::make('id')->addClass('text-center')->title('ID'),
            Column::computed('Name')->addClass('text-center'),
            Column::computed('Owner Email')->addClass('text-center'),
            Column::make('national_id'),
            Column::make('gender'),
            Column::make('birth_date'),
            Column::make('mobile'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Patients_' . date('YmdHis');
    }
}
