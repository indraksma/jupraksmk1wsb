<div class="d-flex justify-content-start">
    @if (Auth::user()->hasRole('admin'))
        <button wire:click="$emit('delete', {{ $data->id }})" class="btn btn-sm btn-danger"
            onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                class="fas fa-trash"></i></button>
    @else
        -
    @endif
</div>
