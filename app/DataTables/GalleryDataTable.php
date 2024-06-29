<?php

namespace App\DataTables;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GalleryDataTable extends DataTable
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
            ->addColumn('gallery', function ($row) {
                return '<a href="' . route('admin.gallery.index', [$row->id, $row->name]) . '" target="_blank" class="btn btn-rounded btn-outline-primary">View Gallery <span class="text-danger">' . count($row->gallery) . '</span></a>';
            })
            ->addColumn('menu_active', function ($row) {
                $menus = '';
                foreach ($row->menuGalleryCategory as $key => $value) {
                    $menus .= "<span class='badge border border-success text-success'>" . $value->Menu->name . "</span> <br>";
                }
                return $menus;
            })
            ->addColumn('action', function ($row) {

                $form = "";

                if (Auth::user()->hasRole('Superadmin')) {
                    $form .= '
                <form action="' . route('admin.gallery-category.destroy', $row->id) . '" method="post" id="cancel_' . $row->id . '">';
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
                                <a class="dropdown-item" href="' . route('admin.gallery-category.edit', $row->id) . '">Edit</a>
                            </li>
                            ' . $form . '
                        </ul>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['status', 'published', 'gallery', 'action', 'menu_active'])
            // ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Gallery $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GalleryCategory $model)
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
                    ->setTableId('gallery-table')
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
            Column::make('name')->title('Name'),
            Column::computed('gallery')->addClass('text-center')->orderable(false)->searchable(false),
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
                ->addClass('text-center')
                ->orderable(false)->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Gallery_' . date('YmdHis');
    }
}
