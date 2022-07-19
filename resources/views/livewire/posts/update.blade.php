<form>
    <input type="hidden" wire:model="post_id">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" placeholder="Enter Title" wire:model="title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="body">Body:</label>
        <textarea type="email" class="form-control" id="body" wire:model="body" placeholder="Enter Body"></textarea>
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control" id="photo-{{$iteration}}" wire:model="photo">
        @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    @if ($photo)
        <label for="photo">Photo Preview:</label>
        <img src="{{ asset('storage/'.$photo) }}" height="70" width="70">
    @endif
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>
