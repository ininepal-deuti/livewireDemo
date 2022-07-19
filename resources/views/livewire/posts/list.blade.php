<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($updateMode)
        @include('livewire.posts.update')
    @else
        @include('livewire.posts.create')
    @endif

    <div class="clearfix pt-5"></div>
    <div class="form-group">
        <input wire:model="searchPost" type="search" class="form-control" placeholder="Search posts by title...">
    </div>

    <table class="table table-bordered mt-5">
        <thead>
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Body</th>
            <th>Author</th>
            <th>Status</th>
            <th width="150px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->author->name }}</td>
                <td>
                    @if($post->status == 1)
                        <div class="form-check form-switch">
                            <input wire:click="$emit('updateStatus',{{$post->id}})" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                        </div>
                    @else
                        <div class="form-check form-switch">
                            <input wire:click="$emit('updateStatus',{{$post->id}})" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Inactive</label>
                        </div>
                    @endif
                </td>
                <td>
                    <button wire:click="edit({{ $post->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $post->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {{ $posts->links() }}
</div>
<script>

</script>
