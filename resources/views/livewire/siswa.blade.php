<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-0">Data Siswa</h3>
            </div>
            @if(Auth::user()->hasRole('admin'))
            <div class="col-6 text-right">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-success btn-sm"
                            wire:click="create()">Tambah</button>&nbsp;
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input class="form-control" type="file" wire:model="template_excel"
                                        id="upload{{ $iteration }}">
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info btn-sm"
                                        wire:click="import">Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="card-body">
    <livewire:siswa-table />
    </div>
</div>
