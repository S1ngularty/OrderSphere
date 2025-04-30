<?php

namespace App\DataTables;

use App\Models\Items;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){
                if($row->Deleted!==null){
                    return "<div class='container d-flex gap-2'>
                        <form action='".route('items.restore',$row->id)."'  method='POST'>
                            ".csrf_field()."
                            ".@method_field('PATCH')."
                            <button type='submit' class='btn btn-warning'><i class='fa fa-trash-restore'></i></button>
                        </form>
                    </div>";
                }else{
                    return "<div class='container d-flex gap-2'>
                <a href='".route('items.edit',$row->id)."' class='btn btn-primary'><i class='fas fa-edit'></i></a>
                    <form action='".route('items.destroy',$row->id)."' method='POST'>
                    ".csrf_field()."
                    ".@method_field('DELETE')."
                        <button class='btn btn-danger' type='submit'><i class='fas fa-trash'></i></button>
                    </form>
                </div>";
                }
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Items $model): QueryBuilder
    {
        return $model->newQuery()
        ->withTrashed()
        ->join('stocks', 'stocks.item_id', '=', 'items.item_id')
        ->join('item_category', 'item_category.item_id','=','items.item_id')
        ->join('categories','item_category.category_id', '=','categories.category_id')
        ->select(
            'items.item_id as id',
            'items.item_name as Item',
            'items.item_price as Price',
            'stocks.qty as Stocks',
            'categories.category_name as Category',
            'items.deleted_at as Deleted'
        );
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('item-table')
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
            Column::make('Item'),
            Column::make('Price'),
            Column::make('Stocks'),
            Column::make('Category'),
            Column::computed('action')
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
        return 'Item_' . date('YmdHis');
    }
}
