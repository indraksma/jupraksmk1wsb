@section('title', 'DUDI')
<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Data Dunia Usaha / Industri</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body p-3">
                    <livewire:dudi-table />
                    {{-- <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama DUDI</th>
                                <th>Kab/Kota</th>
                                <th>Jurusan</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dudi as $item)
                                <tr>
                                    <td>{{ $item->nama_dudi }}</td>
                                    <td>{{ $item->kab_kota }}</td>
                                    <td>{{ $item->jurusan->kode_jurusan }}</td>
                                    <td>
                                        <button wire:click="detail({{ $item->id }})"
                                            class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>&nbsp;
                                        <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info"><i
                                                class="fas fa-edit"></i></button>&nbsp;
                                        <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
                                            onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-12 col-md-12">
                        <div class="dataTables_paginate paging_simple_numbers">
                            {{ $dudi->links() }}
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">Tambah / Ubah Data</h4>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input wire:model="nama_dudi" id="nama_dudi" type="text"
                                class="form-control @error('nama_dudi') is-invalid @enderror" placeholder="Nama DUDI"
                                required="required">
                        </div>
                        @error('nama_dudi')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <select wire:model="jurusan_id" id="jurusan_id" type="text" name="jurusan_id"
                                value="{{ old('jurusan_id') }}"
                                class="form-control @error('jurusan_id') is-invalid @enderror" required="required">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach ($jurusan as $jrs)
                                    <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('jurusan_id')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <input wire:model="kabkota" id="kabkota" type="text"
                                class="form-control @error('kabkota') is-invalid @enderror" placeholder="Kab/Kota"
                                required="required">
                        </div>
                        @error('kabkota')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                        <div class="input-group mb-3">
                            <textarea wire:model="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                placeholder="Alamat"></textarea>
                        </div>
                        @error('alamat')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:click="resetForm()" class="btn btn-warning">Reset</button>
                        <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">Import Data</h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input class="form-control" type="file" wire:model="template_excel"
                                    id="upload{{ $iteration }}">
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" wire:click="import">Import</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
