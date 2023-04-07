<?php

namespace App\DataTables;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Collection as SupportCollection;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Traits\HasRoles;

class DoctorsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
     return (new EloquentDataTable($query))
    ->addColumn('Doctor Name', function (Doctor $doctor) {
        return $doctor->type->name;
    })
    ->addColumn('Pharmacy Name', function (Doctor $doctor) {
        return $doctor->pharmacy->type->name;
    })
    ->addColumn('Doctor Email', function (Doctor $doctor) {
        return $doctor->type->email;
    })
    ->addColumn('avatar', function (Doctor $doctor) {
        return '<img src="'. asset("storage/".$doctor->type->avatar) .'" width="40" height="40" class="rounded-5" align="center" />';
    })
    ->addColumn(
        'actions',
        '
            <div class="d-flex flex-row justify-content-center" >
                 <div class="d-flex flex-row gap-2">
                 <div>
                        <a class="btn btn-success rounded" href="{{Route("doctors.show",$id)}}" >
                            Show
                        </a>
                </div>
                <div>
                    <a  class="btn btn-primary rounded" id="{{$id}}" href="{{Route("doctors.edit",$id)}}">
                        Edit
                    </a>
                    </div>
                    <div>
                    <a  href="javascript:void(0)"  id="delete-doctor" data-url="{{ route("doctors.destroy",$id)}}"
                    class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>'
    )
    ->rawColumns(['avatar', 'actions'])
    ->setRowId('id');

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Doctor $model): QueryBuilder
    {

        if (auth()->user()->hasRole('pharmacy')) {
            $query = Doctor::query()->where('pharmacy_id', auth()->user()->typeable->id);
        }
        else if(auth()->user()->hasRole('doctor')){
            $query = Doctor::query()->where('id', auth()->user()->typeable->id);
        }
        else if(auth()->user()->hasRole('admin')){
            $query = Doctor::query();
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('doctors-table')
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
            Column::computed('avatar')->addClass('text-center')->title('Avatar'),
            Column::make('id')->addClass('text-center')->title('ID')->visible(auth()->user()->hasRole("admin")),
            Column::make('national_id')->addClass('text-center'),
            Column::make('is_banned')->addClass('text-center'),
            Column::computed('Pharmacy Name')->addClass('text-center')->visible(auth()->user()->hasRole("admin")),
            Column::computed('Doctor Name')->addClass('text-center')->searchable(),
            Column::computed('Doctor Email')->addClass('text-center'),
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
        return 'Doctors_' . date('YmdHis');
    }
}
