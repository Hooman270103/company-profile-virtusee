<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostsDataTable extends DataTable
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
            ->addColumn('tags', function ($row) {
                $tags = "<div class='d-flex flex-wrap gap-2'>";
                foreach ($row->tags as $key => $value) {
                    $tags .= '<span class="badge border border-primary text-primary">' . $value . '</span>';
                }
                $tags .= "</div>";
                return $tags;
            })
            ->addColumn('type', function ($row) {
                return setFieldCustom($row->type, 'post');
            })

            ->addColumn('menu_active', function ($row) {
                $menus = '';
                foreach ($row->menu_post as $key => $value) {
                    $menus .= "<span class='badge border border-success text-success'>" . $value->menu->name . "</span> <br>";
                }
                return $menus;
            })

            ->addColumn('published', function ($row) {
                return setFieldCustom($row->published, 'publish');
            })

            ->addColumn('status', function ($row) {
                return setFieldCustom($row->status, 'status');
            })
            ->addColumn('action', function ($row) {

                $form = "";
                if (Auth::user()->hasRole('Superadmin')) {
                    $form .= '
                    <form action="' . route('admin.posts.destroy', $row->id) . '" method="post" id="cancel_' . $row->id . '">';
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
                                <a class="dropdown-item" href="' . route('admin.posts.edit', $row->id) . '">Edit</a>
                            </li>
                            ' . $form . '
                        </ul>
                    </div>
                ';
                return $btn;
            })
            ->rawColumns(['image', 'tags', 'status', 'type', 'published', 'action', 'menu_active'])
            // ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
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
                    ->setTableId('posts-table')
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
            Column::make('image'),
            Column::make('tags'),
            Column::make('type')->title('Tipe'),
            Column::make('created_at')->title('Created'),
            Column::make('updated_at')->title('Updated'),
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
        return 'Posts_' . date('YmdHis');
    }
}
