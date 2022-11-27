<!-- Modal -->
<div class="modal" id="postModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$post->title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $post->body }}</p>
                <hr>
                <p><strong>Photo:</strong>
                    @if($post->photo !== null)
                        <img src="{{ asset('storage/'.$post->photo) }}" height="70" width="70">
                    @endif
                </p>
                <p><strong>Status:</strong> @if($post->status == 1) Active @else Inactive @endif </p>
                <p><strong>Written By:</strong> {{ $post->author->name }}</p>

                <p><strong>Activity Log:</strong></p>

                <ul class="card-body">
                    <li></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
