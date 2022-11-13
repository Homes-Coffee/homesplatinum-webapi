<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\CustomerVerification;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CustomerVerificationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->addColumn('action', function ($datatable) {

                $accept = "<a href='".route('waiting_verificatiton.update', ['id' => $datatable->uuid, 'is_accept' => 1])."' class='p-1 m-1 text-success'><span class='fas fa-check'></span></a>";
                $reject = "<a href='".route('waiting_verificatiton.update', ['id' => $datatable->uuid, 'is_accept' => -1])."' class='p-1 m-1 text-danger'><span class='fas fa-times'></span></a>";

                return $accept . ' ' . $reject;
                // return '<a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                // data-toggle="tooltip" data-original-title="Edit user">
                //     Membership Accepted
                // </a>';
            })
            ->addColumn('customer_name', function ($datatable) {
                if (! empty($datatable->hasCustomerLoyalty()->first()) ) {
                    $data = json_decode($datatable->hasCustomerLoyalty()->first(), true);
                    return $data['name'] ?? '-';
                } else {
                    $data = json_decode($datatable->hasCustomerStudent()->first(), true);
                    return $data['name'] ?? '-';
                }
            })
            ->addColumn('customer_phone', function ($datatable) {
                if (! empty($datatable->hasCustomerLoyalty()->first()) ) {
                    $data = json_decode($datatable->hasCustomerLoyalty()->first(), true);
                    return $data['whatsapp'] ?? '-';
                } else {
                    $data = json_decode($datatable->hasCustomerStudent()->first(), true);
                    return $data['whatsapp'] ?? '-';
                }
            })
            ->addColumn('customer_registered', function ($datatable) {
                return Carbon::parse($datatable->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('customer_city', function ($datatable) {

                if (! empty($datatable->hasCustomerLoyalty()->first()) ) {
                    $data = json_decode($datatable->hasCustomerLoyalty()->first(), true);
                    return $data['city'] ?? '-';
                } else {
                    $data = json_decode($datatable->hasCustomerStudent()->first(), true);
                    return $data['city'] ?? '-';
                }
            })
            ->addColumn('customer_membership', function ($datatable) {
                return $datatable->card()->first()->title ?? '';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CustomerVerification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->customerNeedVerification()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('datatableserverside')
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
    protected function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->searchable(false)
                ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-center'),
            Column::make('customer_name')
                ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-left'),
            Column::make('customer_phone')
                ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-center'),
            Column::make('customer_city')
                ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-center'),
            Column::make('customer_registered')
                ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-center'),
            Column::make('customer_membership')
                ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-uppercase text-secondary text-xxs opacity-7 text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'CustomerVerification_' . date('YmdHis');
    }
}
