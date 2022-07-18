<form wire:submit.prevent="submitUser">
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
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" wire:model="password" placeholder="">
        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
