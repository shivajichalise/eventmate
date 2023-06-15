<?php

namespace App\DataTables;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EventsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $showRoute = 'events.show';
        $editRoute = 'events.edit';
        $destroyRoute = 'events.destroy';

        return (new EloquentDataTable($query))
            ->addColumn('status', function ($row) {
                if ($row->status) {
                    $status = '<span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> Verified </span>';
                } else {
                    $status = '<span class="badge badge-info"><i class="fas fa-fw fas fa-ellipsis-h"></i> Pending </span>';
                }
                return $status;
            })
            ->addColumn('action', function ($row) use ($showRoute, $editRoute, $destroyRoute) {
                return View::make('utils.datatable_action_buttons', [
                    'id' => $row['id'],
                    'showRoute' => $showRoute,
                    'editRoute' => $editRoute,
                    'destroyRoute' => $destroyRoute,
                ])->render();
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Event $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('events-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload')
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
            Column::make('event_start'),
            Column::make('event_end'),
            Column::make('registration_start'),
            Column::make('registration_end'),
            Column::computed('status')
            ->width(60),
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
        return 'Events_' . date('YmdHis');
    }
}
