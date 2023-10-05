<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Models\Jurnal;

class JurnalTable extends DataTableComponent
{
    protected $model = Jurnal::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['jurnals.id']);
    }

    public function columns(): array
    {
        return [
            Column::make("Tanggal", "tanggal")
                ->searchable()
                ->sortable(),
            Column::make("Nama Guru", "user.nama")
                ->searchable()
                ->sortable(),
            Column::make("DUDI", "dudi.nama_dudi")
                ->searchable()
                ->sortable(),
            Column::make("Jenis Kegiatan", "jenis_kegiatan.nama_kegiatan")
                ->searchable()
                ->sortable(),
            LinkColumn::make('Dokumentasi')
                ->title(fn ($row) => 'Lihat')
                ->location(fn ($row) => $row->link_dokumentasi)
                ->attributes(fn ($row) => [
                    'class' => 'btn btn-sm btn-info',
                    'target' => '_blank',
                ]),
        ];
    }
}