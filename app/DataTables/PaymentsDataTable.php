<?php

namespace App\DataTables;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $showRoute = 'payments.show';
        $editRoute = 'payments.edit';
        $destroyRoute = 'payments.destroy';
        $model = 'payment';

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
            ->addColumn('user', function ($payment) {
                return $payment->invoice->user->name;
            })
            ->addColumn('event', function ($payment) {
                return $payment->invoice->ticket->subEvent->event->name;
            })
            ->addColumn('sub_event', function ($payment) {
                return $payment->invoice->ticket->subEvent->name;
            })
            ->addColumn('invoice_status', function ($payment) {
                return $payment->invoice->status;
            })
            ->addColumn('paid_amount', function ($payment) {
                return $payment->invoice->ticket->currency . ' ' . $payment->amount;
            })
            ->addColumn('payment_date', function ($payment) {
                return $payment->created_at->format('F j, Y');
            })
            ->rawColumns(['action', 'user'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payment $model): QueryBuilder
    {
        return $model->newQuery()
            ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->select(['payments.*']) // Select the columns you need from the payments table
            ->with(['invoice.user']); // Eager load relationships to optimize queries
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('payments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->parameters(['debug' => true])
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
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('user')->searchable(true)->orderable(true),
            Column::make('event')->title('Event'),
            Column::make('sub_event')->title('Sub event'),
            Column::make('invoice_status')->title('Invoice Status'),
            Column::make('paid_amount')->title('Amount'),
            Column::make('payment_date')->title('Payment Date'),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Payments_' . date('YmdHis');
    }
}
