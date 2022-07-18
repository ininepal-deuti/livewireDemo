<form>
    <input type="hidden" wire:model="user_id">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Name" wire:model="name">
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" wire:model="email" placeholder="example@example.com">
        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="updateUser()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancelUser()" class="btn btn-danger">Cancel</button>
</form>
