<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AttendeesDataTable extends DataTable
{
    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $showRoute = 'users.show';
        $editRoute = 'users.edit';
        $destroyRoute = 'users.destroy';
        $model = 'user';

        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) use ($model, $showRoute, $editRoute, $destroyRoute) {
                return View::make('utils.datatable_action_buttons', [
                    'id' => $row['id'],
                    'model' => $model,
                    'showRoute' => $showRoute,
                    'editRoute' => $editRoute,
                    'destroyRoute' => $destroyRoute,
                ])->render();
            })
            ->rawColumns(['status', 'action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->whereHas('payments', function (QueryBuilder $query) {
            $query->whereIn('invoice_id', function ($subQuery) {
                $subQuery->select('id')
                ->from('invoices')
                ->whereIn('ticket_id', function ($ticketSubQuery) {
                    $ticketSubQuery->select('id')
                    ->from('tickets')
                    ->whereIn('sub_event_id', function ($subEventSubQuery) {
                        $subEventSubQuery->select('id')
                        ->from('sub_events')
                        ->where('event_id', $this->eventId); // Use $this->id to reference the event's ID
                    });
                });
            });
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
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
            Column::make('DT_RowIndex')->title('#'),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile_number'),
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
        return 'Attendees_' . date('YmdHis');
    }
}
