<?php

namespace App\DataTables;

use App\Models\Candidato;
use App\Services\RegiaoService;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CandidatoDataTable extends DataTable
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
            ->addColumn('action', function($sql) {
                return view('includes.actions', [
                    'route' => 'admin.candidatos',
                    'id' => $sql->id,
                    'edit' => false,
                    'status' => true
                ]);
            })
            ->editColumn('foto', function($sql) {
                $foto = $sql->foto;
                if (empty($sql->foto)) {
                    $foto = '/img/perfil_branco.png';
                }
                return '<img src="' . $foto . '" class="img-thumbnail rounded" height="80px" width="80px">';
            })
            ->editColumn('cargo_id', function($sql) {
                return $sql->cargo->cargo;
            })
            ->editColumn('regiao_id', function($sql) {
                return $sql->regiao->nome;
            })
            ->editColumn('status', function($sql) {
                return Candidato::STATUS[$sql->status];
            })
            ->rawColumns(['action', 'foto', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Candidato $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Candidato $model)
    {
        return $model->newQuery()
            ->when(request('cargo'), function ($sql) {
                return $sql->where('cargo_id', request('cargo') );
            })
            ->when(!request('cargo'), function ($sql) {
                return $sql->where('cargo_id', 1);
            });
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
            ->parameters([
                "bFilter" => false,
                "buttons" => [],
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
                  ->addClass('text-center')->title('Ação'),
            Column::make('foto')->title('Foto'),
            Column::make('cargo_id')->title('Cargo'),
            Column::make('nome')->title('Nome'),
            Column::make('federacao')->title('Federação'),
            Column::make('sinodal')->title('Sinodal'),
            Column::make('estado')->title('Estado'),
            Column::make('regiao_id')->title('Região'),
            Column::make('status')->title('Status'),
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
