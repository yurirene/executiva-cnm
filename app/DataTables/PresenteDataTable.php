<?php

namespace App\DataTables;

use App\Models\Delegado;
use App\Services\RegiaoService;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PresenteDataTable extends DataTable
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
            ->editColumn('regiao_id', function($sql) {
                return RegiaoService::REGIOES[$sql->regiao_id];
            })
            ->rawColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Delegado $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Delegado $model)
    {
        return $model->newQuery()->where('tipo', 1)->where('presente', true);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('sinodal-presente-datatable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('admin.datatable.presente-sinodal'))
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(['csv'])
            ->parameters([
                "language" => [
                    "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                ],
                'processing' => false
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('sinodal')->title('Sinodal'),
            Column::make('regiao_id')->title('Região'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Delegado_' . date('YmdHis');
    }
}
