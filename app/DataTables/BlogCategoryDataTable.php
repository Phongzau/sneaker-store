<?php

namespace App\DataTables;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('status', function ($query) {
                if (auth()->user()->can('edit-blog-categories')) {
                    if ($query->status == 1) {
                        $button = "<label class='custom-switch mt-2'>
                    <input type='checkbox' data-id='" . $query->id . "' checked name='custom-switch-checkbox' class='custom-switch-input change-status'>
                    <span class='custom-switch-indicator'></span>
                  </label>";
                    } else {
                        $button = "<label class='custom-switch mt-2'>
                    <input type='checkbox' data-id='" . $query->id . "' name='custom-switch-checkbox' class='custom-switch-input change-status'>
                    <span class='custom-switch-indicator'></span>
                  </label>";
                    }
                    return $button;
                }
                return $query->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })

            ->addColumn('action', function ($query) {
                $editBtn = '';
                $deleteBtn = '';
                if (auth()->user()->can('edit-blog-categories')) {
                    $editBtn = "<a class='btn btn-primary' href='" . route('admin.blog_categories.edit', $query->id) . "'><i class='far fa-edit'></i></a>";
                }
                if (auth()->user()->can('delete-blog-categories')) {
                    $deleteBtn = "<a class='btn btn-danger delete-item ml-2' href='" . route('admin.blog_categories.destroy', $query->id) . "'><i class='far fa-trash-alt'></i></a>";
                }
                return $editBtn . $deleteBtn;
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BlogCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blogcategory-table')
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

            Column::make('id'),
            Column::make('name'),
            Column::make('slug'),

            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BlogCategory_' . date('YmdHis');
    }
}
