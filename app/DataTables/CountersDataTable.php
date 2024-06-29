<?php

namespace App\DataTables;

use App\Models\Counter;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CountersDataTable extends DataTable
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
            ->addColumn('published', function ($row) {
                return setFieldCustom($row->published, 'publish');
            })
            ->addColumn('status', function ($row) {
                return setFieldCustom($row->status, 'status');
            })
            ->addColumn('menu_active', function ($row) {
                $menus = '';
                foreach ($row->MenuCounter as $key => $value) {
                    $menus .= "<span class='badge border border-success text-success'>" . $value->Menu->name . "</span> <br>";
                }
                return $menus;
            })
            ->addColumn('data_counter', function ($row) {
                $datas = '';
                foreach ($row->data_counter  as $key => $value) {
                    $datas .= $value->title . ' => ' . $value->number . ', <br>';
                }

                return $datas;
            })
            ->addColumn('action', function ($row) {

                $form = "";

                //berikan if jika role bukan superadmin untuk form delete
                if (Auth::user()->hasRole('Superadmin')) {
                    $form .= '
                        <form action="' . route('admin.counter.destroy', $row->id) . '" method="post" id="cancel_' . $row->id . '">
                    ';
                    $form .= csrf_field();
                    $form .= method_field("DELETE");
                    $form .= '<li><button class="dropdown-item" type="button" onclick="deleteData(\'' . $row->id . '\')">Delete</button></li>';
                    $form .= '</form>';
                }

                $btn =   '
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-sm btn-rounded btn-soft-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="' . route('admin.counter.edit', $row->id) . '">Edit</a>
                            </li>
                            ' . $form . '
                        </ul>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'published', 'action', 'data_counter', 'menu_active'])
            // ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Counter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Counter $model)
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
                    ->setTableId('counters-table')
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
            Column::make('title'),
            Column::make('data_counter'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('published')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('menu_active')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Counters_' . date('YmdHis');
    }
}
