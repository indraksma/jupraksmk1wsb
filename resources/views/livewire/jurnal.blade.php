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
                            @if ($jurnal)
                                <tr>
                                    <td class="text-center" colspan="5">Belum ada data</td>
                                </tr>
                            @else
                                @foreach ($jurnal as $item)
                                    <tr>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->dudi->nama_dudi }}</td>
                                        <td>{{ $item->jenis_kegiatan->nama_kegiatan }}</td>
                                        <td><a href="{{ $item->link_dokumentasi }}"><button
                                                    class="btn btn-sm btn-info"><i class="fa fa-eye"></i>
                                                    Lihat</button></a></td>
                                        <td>
                                            <button wire:click="$emit('edit', {{ $item->id }})"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>&nbsp;
                                            <button wire:click="$emit('delete', {{ $item->id }})"
                                                class="btn btn-sm btn-danger"
                                                onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    @endif
</div>
