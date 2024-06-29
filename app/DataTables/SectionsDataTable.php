<?php

namespace App\DataTables;

use App\Models\Section;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SectionsDataTable extends DataTable
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
            ->addColumn('image', function ($row) {
                $file = getStorage($row->image);
                return '<img src="data:image/png;base64,' . $file . '" alt="images" class="img-fluid" style="height: 40px">';
            })
            ->addColumn('menu_active', function ($row) {
                $menus = '';
                foreach ($row->MenuSection as $key => $value) {
                    $menus .= "<span class='badge border border-success text-success'>" . $value->Menu->name . "</span> <br>";
                }
                return $menus;
            })

            ->addColumn('published', function ($row) {
                return setFieldCustom($row->published, 'publish');
            })

            ->addColumn('position', function ($row) {
                return $row->position == '1' ? 'Left' : 'Right';
            })

            ->addColumn('status', function ($row) {
                return setFieldCustom($row->status, 'status');
            })
            ->addColumn('action', function ($row) {

                $form = "";
                if (Auth::user()->hasRole('Superadmin')) {
                    $form .= '
                    <form action="' . route('admin.section.destroy', $row->id) . '" method="post" id="cancel_' . $row->id . '">';
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
                                <a class="dropdown-item" href="' . route('admin.section.edit', $row->id) . '">Edit</a>
                            </li>
                            ' . $form . '
                        </ul>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['image', 'status', 'published', 'action', 'menu_active'])
            // ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Section $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Section $model)
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
                    ->setTableId('sections-table')
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
            Column::make('image')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('position'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('published')
            ->title('Publish')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('status')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::make('menu_active')
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
        return 'Sections_' . date('YmdHis');
    }
}
