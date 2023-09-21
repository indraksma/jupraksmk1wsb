<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa_pkl;
use App\Models\Tahun_ajaran;
use Illuminate\Support\Facades\Auth;

class SiswaPklTable extends DataTableComponent
{
    protected $listeners = ['refreshSiswaTable' => '$refresh'];
    protected $model = Siswa_pkl::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['siswa_pkls.id']);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama Siswa", "siswa.nama")
                ->searchable()
                ->sortable(),
            Column::make("Kelas", "siswa.kelas.nama_kelas")
                ->searchable()
                ->sortable(),
            Column::make("NIS", "siswa.nis")
                ->searchable()
                ->sortable(),
            Column::make("DUDI", "dudi.nama_dudi")
                ->searchable(),
            Column::make('Actions')
                ->label(function ($row, Column $column) {
                    return view('livewire.action.edit-delete', ['data' => $row]);
                })->hideIf(!auth()->user()->hasRole('admin')),
        ];
    }

    public function builder(): Builder
    {
        $ta_id = Tahun_ajaran::where('aktif', 1)->pluck('id');
        if (Auth::user()->hasRole(['admin', 'waka'])) {
            return Siswa_pkl::query()
                ->where('siswa_pkls.tahun_ajaran_id', $ta_id);
        } else {
            return Siswa_pkl::query()
                ->where('siswa_pkls.user_id', Auth::user()->id)
                ->where('siswa_pkls.tahun_ajaran_id', $ta_id);
        }
    }
}
