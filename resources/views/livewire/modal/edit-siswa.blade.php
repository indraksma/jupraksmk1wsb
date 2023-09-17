<div class="d-flex justify-content-start">
    <button wire:click="edit({{ $users->id }})" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>&nbsp;
    <button wire:click="delete({{ $users->id }})" class="btn btn-sm btn-danger"
        onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
            class="fas fa-trash"></i></button>
</div>
