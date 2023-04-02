<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use Attribute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PharmaciesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

            return (new EloquentDataTable($query))
            ->addColumn('Area',function(Pharmacy $pharmacy){
                return $pharmacy->area_name;
            })
            ->addColumn('Owner Name',function(Pharmacy $pharmacy){
                return $pharmacy->type->name;
            })
            ->addColumn('Owner Email',function(Pharmacy $pharmacy){
                return $pharmacy->type->email;
            })
            ->addColumn('avatar',function(Pharmacy $pharmacy){
                return '<img src="'. asset("storage/".$pharmacy->type->avatar) .'" width="40" class="img-circle" align="center" />';
            })
            ->addColumn(
                'actions',
                '
                <div class="d-flex flex-row justify-content-center" >
                     <div class="d-flex flex-row gap-2">
                     <div>
                            <a  class="btn btn-success rounded" id="{{$id}}" href="{{Route("pharmacies.edit",$id)}}">
                                Edit
                             </a>
                         </div>
                         <div>
                            <a class="btn btn-primary rounded" href="{{Route("pharmacies.show",$id)}}" >
                                Show
                            </a>
                        </div>
                        <div>
                            <form method="post" class="delete_item" action="{{Route("pharmacies.destroy",$id)}}">
                                @csrf
                                @method("DELETE")
                                <button  id="delete_{{$id}}" >
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>'
            )
            ->rawColumns(['avatar', 'actions','restore'])
            ->setRowId('pharmacy_id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pharmacy $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pharmacy $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {

        return $this->builder()

            ->setTableId('pharmacies-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
         ;
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns()
    {
        return [

                    Column::computed('avatar')->addClass('text-center')->title('Avatar'),
                    // Column::make('pharmacy_name')->addClass('text-center')->title('Name'),
                    Column::make('id')->addClass('text-center')->title('ID'),
                    Column::computed('Owner Name')->addClass('text-center'),
                    Column::computed('Owner Email')->addClass('text-center'),
                    Column::computed('Area')->addClass('text-center'),
                    Column::make('priority')->addClass('text-center')->title('Priority'),
                    // Column::computed('restore')
                    //     ->exportable(false)
                    //     ->printable(false)
                    //     ->width(60)
                    //     ->addClass('text-center'),
                    Column::computed('actions')
                        ->exportable(false)
                        ->printable(false)
                        ->width(60)
                        ->addClass('text-center')
                ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pharmacy_' . date('YmdHis');
    }
}
