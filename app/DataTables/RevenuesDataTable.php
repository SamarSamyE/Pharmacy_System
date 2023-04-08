<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use App\Models\Revenue;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RevenuesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('Pharmacy Avatar',function(Pharmacy $pharmacy){
         return '<img src="'. asset("storage/".$pharmacy->type->avatar) .'" width="40" class="img-circle" align="center" />';
       })
        ->addColumn('Pharmacy Name',function(Pharmacy $pharmacy){
            return $pharmacy->type->name;
        })
        ->addColumn('totalOrders', function(Pharmacy $pharmacy) {
           $totalOrders = $pharmacy->orders->count();
           return $totalOrders;
       })
       ->addColumn('totalRevenue', function(Pharmacy $pharmacy) {
        $totalOrders = $pharmacy->orders->sum("price");
        return $totalOrders."$";
    })
        ->rawColumns(['Pharmacy Avatar'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pharmacy $model): QueryBuilder
    {
        if (auth()->user()->hasRole('pharmacy')) {
            $query = Pharmacy::query()->where('id', auth()->user()->typeable->id);
        }
        else if(auth()->user()->hasRole('admin')){
            $query = Pharmacy::query();
        }
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('revenues-table')
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
            Column::computed('Pharmacy Avatar')->addClass('text-center')->title('Avatar'),
            Column::computed('Pharmacy Name')->addClass('text-center')->visible(auth()->user()->hasRole("admin")),
            Column::computed('totalOrders')->addClass('text-center'),
            Column::computed('totalRevenue')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Revenues_' . date('YmdHis');
    }
}
