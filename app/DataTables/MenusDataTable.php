<?php

namespace App\DataTables;

use App\Models\Menu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MenusDataTable extends DataTable
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
            ->addColumn('deleted_at', function ($row) {
                return tglIndoAngkaJam($row->deleted_at ?? null);
            })
            ->addColumn('parent', function ($row) {
                return $row->Parent->name ?? null;
            })
            ->addColumn('status', function ($row) {
                return setFieldCustom($row->status, 'status');
            })
            ->addColumn('type', function ($row) {
                return setFieldCustom($row->type, 'menu');
            })
            ->addColumn('action', function ($row) {
                $btn =   '
                    <div class="btn-group dropend">
                        <button type="button" class="btn btn-sm btn-rounded btn-soft-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="' . route('admin.menu.edit', $row->id) . '">Edit</a>
                            </li>
                        </ul>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'action', 'type'])
            // ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Menu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model)
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
                    ->setTableId('menus-table')
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
            Column::make('position'),
            Column::make('parent'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('link_url'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('deleted_at'),
            Column::make('type')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('action')
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
    protected function filename()
    {
        return 'Menus_' . date('YmdHis');
    }
}
