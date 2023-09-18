<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Dudi;

class DudiTable extends DataTableComponent
{
    protected $listeners = ['refreshSiswaTable' => '$refresh'];
    protected $model = Dudi::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['dudis.id']);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama DUDI", "nama_dudi")
                ->searchable()
                ->sortable(),
            Column::make("Jurusan", "jurusan.kode_jurusan")
                ->searchable()
                ->sortable(),
            Column::make("Kab/Kota", "kab_kota")
                ->searchable()
                ->sortable(),
            Column::make("Alamat", "Alamat")
                ->searchable(),
            Column::make('Actions')
                ->label(function ($row, Column $column) {
                    return view('livewire.action.edit-delete', ['data' => $row]);
                }),
        ];
    }
}
