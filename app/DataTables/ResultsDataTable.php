<?php

namespace App\DataTables;

use App\Models\Result;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ResultsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $editRoute = 'results.edit';
        $destroyRoute = 'results.destroy';
        $model = 'result';

        return (new EloquentDataTable($query))
            ->addColumn('file', function ($row) {
                $file = 'No uploaded file.';
                $button = '<a href="/results/download/' . $row->id . '" class="btn btn-primary btn-xs"><i class="fa-solid fa-download"></i></a>';
                if($row->file) {
                    $file = $button;
                }
                return $file;
            })
            ->addColumn('action', function ($row) use ($model, $editRoute, $destroyRoute) {
                return View::make('utils.datatable_no_show_action_buttons', [
                    'id' => $row['id'],
                    'model' => $model,
                    'editRoute' => $editRoute,
                    'destroyRoute' => $destroyRoute,
                ])->render();
            })
            ->rawColumns(['file', 'action'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Result $model): QueryBuilder
    {
        return $model->newQuery()->with('subEvent.event');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('result-table')
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
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false),

            // Computed column for Event Name
            Column::computed('event_name')
            ->title('Event')
            ->data('sub_event.event.name')
            ->orderable(false)
            ->searchable(false),

            // Computed column for Subevent Name
            Column::computed('subevent_name')
            ->title('Sub-event')
            ->data('sub_event.name')
            ->orderable(false)
            ->searchable(false),

            Column::make('title'),

            Column::make('file'),

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
        return 'Result_' . date('YmdHis');
    }
}
