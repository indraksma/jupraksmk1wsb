@section('title', 'Siswa')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-0">Data Siswa</h3>
            </div>
            @if (Auth::user()->hasRole('admin'))
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
{{-- Modal Siswa --}}
<div wire:ignore.self class="modal fade" id="modal-siswa" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </div>

</div>

@push('scripts')
    <script>
        Livewire.on('show-modal', event => {
            $('#modal-siswa').modal('show');
        })
        Livewire.on('close-modal', event => {
            $('#modal-siswa').modal('hide');
        })
    </script>
@endpush
