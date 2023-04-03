<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
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
                        <a  class="btn btn-success rounded" id="{{$id}}" href="{{Route("Doctors.edit",$id)}}">
                            Edit
                         </a>
                     </div>
                     <div>
                        <a class="btn btn-primary rounded" href="{{Route("Doctors.show",$id)}}" >
                            Show
                        </a>
                    </div>
                    <div>
                        <form method="post"  action="{{Route("Doctors.destroy",$id)}}">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger rounded delete-area" id="delete_{{$id}}" >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>'
        )
      

        ->addColumn('Pharmacy Owner', function (Order $order) {
            return $order->pharmacy->type->name;
        })
        ->addColumn('name', function (Order $order) {
            return $order->patient->type->name;
        })
        ->addColumn('doctor_id', function (Order $order) {
            return $order->doctor->type->name;
        })
       
    
    ->rawColumns(['actions','restore'])
        ->setRowId('id');
}

    

    /**
     * Get the query source of dataTable.
     */
   
     public function query(Order $model): QueryBuilder
     {
         return $model->newQuery();
     }
 
 
     public function html(): HtmlBuilder
     {
         return $this->builder()
             ->setTableId('orders-table')
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
             ]);
     }
 
     /**
      * Get the dataTable columns definition.
      *
      * @return array
      */
     public function getColumns(): array
     {
         return [
             Column::make('id'),
             Column::computed('name')->title('client name'),
             Column::make('status'),
             Column::computed('is_insured')->title('insured'),
             Column::make('creator_id')->title('creator'),
             Column::computed('Pharmacy Owner'),
             Column::computed('doctor_id')->title('doctor'),
             Column::make('patient_address_id'),
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
         return 'Orders_' . date('YmdHis');
     }
 }