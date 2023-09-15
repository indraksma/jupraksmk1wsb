<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
            Column::make("Nama", "nama")
                ->sortable()
                ->searchable(),
            Column::make("NIS", "nis")
                ->sortable()
                ->searchable(),
            Column::make("JK", "jk")
                ->sortable(),
            Column::make("Kelas", "kelas.nama_kelas")
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Delete') // make() has no effect in this case but needs to be set anyway
                        ->title(fn ($row) => 'Delete ' . $row->name)
                        ->location(fn ($row) => route('siswa', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-danger',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn ($row) => 'Edit ' . $row->name)
                        ->location(fn ($row) => route('siswa', $row))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'btn btn-sm btn-warning',
                            ];
                        }),
                ]),
        ];
    }
}
