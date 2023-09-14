<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Siswa;

class SiswaTable extends DataTableComponent
{
    protected $model = Siswa::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Nama", "nama")
                ->sortable(),
            Column::make("NIS", "nis")
                ->sortable(),
            Column::make("JK", "jk")
                ->sortable(),
        ];
    }
}
