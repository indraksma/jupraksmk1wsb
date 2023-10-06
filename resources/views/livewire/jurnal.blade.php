@section('title', 'Jurnal Pembelajaran PKL')
<div>
    @if ($cek_siswa == 0)
        <div class="alert alert-warning">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
            Anda belum memiliki siswa bimbingan pkl, harap lakukan setting pada halaman berikut.<br>
            <a href="{{ route('siswa-pkl') }}"><button class="btn btn-sm btn-secondary">Setting Siswa PKL</button></a>
        </div>
    @else
        <div class="card card-secondary">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-0">Data Jurnal Tahun Ajaran {{ $ta->tahun_ajaran }}</h5>
                    </div>
                    <div class="col-6 text-right"><a href="{{ route('jurnal.tambah') }}"><button
                                class="btn btn-sm btn-success">Tambah</button></a></div>
                </div>
            </div>
            <div class="card-body">
                @if (Auth::user()->hasRole(['admin', 'waka']))
                    <livewire:jurnal-table />
                @else
                    <div class="row">
                        <div class="col-md-9">
                            <h5>{{ Auth::user()->name }}</h5>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Search" wire:model="searchTerm" />
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>DUDI</th>
                                <th>Jenis Kegiatan</th>
                                <th>Dokumentasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$jurnal)
                                <tr>
                                    <td class="text-center" colspan="5">Belum ada data</td>
                                </tr>
                            @else
                                @foreach ($jurnal as $item)
                                    <tr>
                                        <td>{{ date_format(date_create($item->tanggal), 'j F Y') }}</td>
                                        <td>{{ $item->dudi->nama_dudi }}</td>
                                        <td>{{ $item->jenis_kegiatan->nama_kegiatan }}</td>
                                        <td><a href="{{ $item->link_dokumentasi }}" target="_blank"><button
                                                    class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>&nbsp;
                                                    Lihat</button></a></td>
                                        <td>
                                            <button wire:click="$emit('edit', {{ $item->id }})"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i>
                                                Edit</button>&nbsp;
                                            <button class="btn btn-sm btn-success"><i class="fas fa-file-alt"></i>
                                                Presensi</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if ($jurnal)
                        {{ $jurnal->links() }}
                    @endif
                @endif
            </div>
        </div>
    @endif
</div>
