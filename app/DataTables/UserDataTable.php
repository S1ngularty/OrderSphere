<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action',function ($row){
             if($row->deleted===null){
                return "<div class='action-group'>
                <a href='".route('user.edit',$row->id)."' class='btn btn-primary'><i class='fa fa-edit'></i></a>
                    <form action='".route('user.delete',$row->id)."' method='GET' class='form-control'>
                        <button class='btn btn-danger' type='submit'><i class='fa fa-trash'></i></button>
                    </form>
                </div>";
             }else{
                return "<div class='action-group'>
                    <form action=".route('user.restore',$row->id)." method='GET'>
                        <button class='btn btn-warning' type='submit'><i class='fas fa-refresh'></i></button>
                    </form>
                </div>";
             }
            })

            ->addColumn('Role',function($row){
                return "<div class='container'>
                    <form action='".route('user.role',$row->id)."' method='GET' class='form-control'>
                        <select class='form-select' name='role' onchange='this.form.submit()'>
                            <option value='admin' ".($row->Role==='admin'? 'selected': '').">Admin</option>
                            <option value='user' ".($row->Role==='user'? 'selected': '').">User</option>
                        </select>
                    </form>
                </div>";
            })

            ->addColumn('Status',function($row){
                return "<div class='container'>
                    <form action='".route('user.status',$row->id)."' method='GET' class='form-control'>
                        <select class='form-select' name='status' onchange='this.form.submit()'>
                            <option value='active' ".($row->Status==='active'? 'selected': '').">Active</option>
                            <option value='inactive' ".($row->Status==='inactive'? 'selected': '').">Inactive</option>
                        </select>
                    </form>
                </div>";
            })
            ->rawColumns(['Role','Status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
                ->withTrashed()
                ->join('user_info','users.user_id','=','user_info.user_id')
                ->select([
                    'users.user_id AS id',
                    DB::raw('CONCAT(user_info.fname," ",user_info.lname) AS Name'),
                    'users.email AS Email',
                    'users.role AS Role',
                    'users.status AS Status',
                    'users.deleted_at AS deleted'
                ]);             
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
            Column::make('Name'),
            Column::make('Email'),
            Column::computed('Role'),
            Column::computed('Status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
