<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {

                $form = "";
                $form .= '
                        <form action="' . route('admin.users.destroy', $row->id) . '" method="post" id="cancel_' . $row->id . '">
                    ';
                $form .= csrf_field();
                $form .= method_field("DELETE");
                $form .= '<li><button class="dropdown-item" type="button" onclick="deleteData(\'' . $row->id . '\')">Hapus</button></li>';
                $form .= '</form>';

                $btn =   '
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-sm btn-rounded btn-soft-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="' . route('admin.users.show', $row->id) . '">Detail</a>
                                <a class="dropdown-item" href="' . route('admin.users.edit', $row->id) . '">Edit</a>
                            </li>
                        </ul>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['action'])
            // ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')->orderable(false)->searchable(false)->exportable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
