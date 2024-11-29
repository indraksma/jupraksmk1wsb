<div>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reset Password</h4>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input wire:model.lazy="oldpassword" id="oldpassword" type="password" name="oldpassword"
                                class="form-control {{ $not_found === false ? 'is-valid' : ($not_found === true ? 'is-invalid' : '') }}"
                                placeholder="Password Lama" required="required">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @if ($not_found)
                            <div class="alert alert-danger">
                                <span>{{ $not_found_msg }}</span>
                            </div>
                        @endif
                        <div class="input-group mb-3">
                            <input wire:model.lazy="newpassword" id="newpassword" type="password" name="newpassword"
                                class="form-control @error('newpassword') is-invalid @enderror"
                                placeholder="Password Baru" required="required">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('newpassword')
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    @if ($not_found === false)
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
