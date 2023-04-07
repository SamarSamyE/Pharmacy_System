<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\PatientAddress;
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
    ->addColumn('Order User Name', function (Order $order) {
        // return $order->patient->type->name;
        return $order->patient ? $order->patient->type->name : 'Adminn';
    })
    ->addColumn('Doctor Name', function (Order $order) {
    //     return $order->doctor->type->name;
    return $order->doctor ? $order->doctor->type->name : 'N/A';
    })
    ->addColumn('Assigned Pharmacy', function (Order $order) {
        return $order->pharmacy->type->name;
    })
    ->addColumn('Deliveing Address', function (Order $order) {
        $patientAddress = PatientAddress::where('id', $order->patient_id)->first();
        $buildNumber = $patientAddress->build_number;
        $floorNumber = $patientAddress->floor_number;
        return $patientAddress->street_name . ', ' . $buildNumber . ', ' . $floorNumber;
    })
    // Return the desired column value

     ->addColumn(
         'actions',
         '      
                <div class="d-flex flex-row justify-content-center" >
                     <div class="d-flex flex-row gap-2">
                     <div>
                            <a class="btn btn-success rounded" href="{{Route("orders.show",$id)}}" >
                                Show
                            </a>
                    </div>
                    <div>
                        <a  class="btn btn-primary rounded" id="{{$id}}" href="{{Route("orders.edit",$id)}}">
                            Edit
                        </a>
                        </div>
                        <div>
                        <a  href="javascript:void(0)"  id="delete-order" data-url="{{ route("orders.destroy",$id)}}"
                        class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>'
     )


    ->rawColumns(['actions'])
    ->setRowId('id');




    /**
     * Get the query source of dataTable.
     */
}
     public function query(Order $model): QueryBuilder
     {
        if (auth()->user()->hasRole('pharmacy')) {
            $query = Order::query()->where('pharmacy_id', auth()->user()->typeable->id);
        }
        else if(auth()->user()->hasRole('doctor')){
            $query = Order::query()->where('pharmacy_id', auth()->user()->typeable->pharmacy_id);
        }
        else if(auth()->user()->hasRole('admin')){
            $query = Order::query();
        }

        return $query;
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
            Column::computed('Order User Name'),
            Column::computed('Deliveing Address'),
            // Column::make('patient_id', 'Order User Name')
            // ->title('Order User Name')
            // ->render(function ($order) {
            //     return $order->orderUserName() ? $order->orderUserName() : 'Admin';
            // }),
        //     Column::computed('Order User Name')
        //     ->render(function ($order) {
        //         return $order->patient->type->name ?? 'Admin';
        //    }),
             Column::make('status'),
             Column::computed('is_insured')->title('is insured'),
             Column::make('creator_type')->visible(auth()->user()->hasRole("admin")),
             Column::computed('Assigned Pharmacy')->visible(auth()->user()->hasRole("admin")),
             Column::computed('Doctor Name'),
             Column::make('patient_address_id'),
             Column::make('created_at'),
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