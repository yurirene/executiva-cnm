<?php

namespace App\DataTables;

use App\Models\Delegado;
use App\Services\RegiaoService;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DelegadoDataTable extends DataTable
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
            ->addColumn('action', function($sql) {
                return view('includes.actions', [
                    'route' => 'admin.delegados',
                    'id' => $sql->id,
                ]);
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Delegado $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Delegado $model)
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
            ->setTableId('delegados-datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->text('<i class="fas fa-plus"></i> Novo Delegado'),
            )
            ->parameters([
                "language" => [
                    "url" => "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                ]
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-left')->title('Ação'),
            Column::make('codigo')->title('Código'),
            Column::make('nome')->title('Nome'),
            Column::make('federacao')->title('Federação'),
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
