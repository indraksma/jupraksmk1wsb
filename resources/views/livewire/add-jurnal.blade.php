@section('title', 'Tambah Jurnal PKL')
<div>
    <div class="card card-primary">
        <div class="card-body">
            <form method="POST" wire:submit.prevent="store()">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-md-4">
                                <input class="form-control" readonly value="{{ $ta->tahun_ajaran }}" />
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('jurnal') }}"><button
                                        class="btn btn-sm btn-success">Kembali</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Guru</label>
                            <div class="col-md-10">
                                @if (Auth::user()->hasRole(['admin', 'waka']))
                                    <select wire:model="user" id="user_id" class="form-control">
                                        <option value="">-- Pilih Guru --</option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input wire:model="user" class="form-control" readonly
                                        value="{{ $users->id }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Jenis Kegiatan</label>
                            <div class="col-md-10">
                                <select wire:model="jeniskeg" id="jenis_id" class="form-control">
                                    <option value="">-- Jenis Kegiatan --</option>
                                    @foreach ($jk as $jkeg)
                                        <option value="{{ $jkeg->id }}">{{ $jkeg->nama_kegiatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">DUDI</label>
                            <div class="col-md-10">
                                <select wire:model="dudi" id="dudi_id" class="form-control">
                                    <option value="">-- DUDI PKL --</option>
                                    @if ($dudi)
                                        @forelse($dudi as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama_dudi }}</option>
                                        @empty
                                            <option value="">Tidak Ada Data</option>
                                        @endforelse
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Link Dokumentasi</label>
                            <div class="col-md-10">
                                <input class="form-control" wire:model="link_dokumentasi"
                                    placeholder="Link Google Drive" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @if ($showSiswa)
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>NIS</th>
                                        <th>Kehadiran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    @forelse ($siswa as $siswas)
                                        <input wire:model="siswaid[]" type="hidden" value="{{ $siswas->siswa->id }}" />
                                        <tr>
                                            <td>{{ $siswas->siswa->nama }}</td>
                                            <td>{{ $siswas->siswa->kelas->nama_kelas }}</td>
                                            <td>{{ $siswas->siswa->nis }}</td>
                                            <td>
                                                <select wire:model="kehadiran[]" class="form-control" required>
                                                    <option value="">-- Presensi --</option>
                                                    <option value="H">Hadir</option>
                                                    <option value="I">Izin</option>
                                                    <option value="A">Alpha</option>
                                                </select>
                                            </td>
                                            <td>
                                                <textarea wire:model="keterangan[]" class="form-control"></textarea>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data yang dapat ditampilkan
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                @endif
            </form>
        </div>
    </div>
</div>
