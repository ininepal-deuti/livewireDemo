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

                <p><strong>Activity Log</strong></p>

                <table class="table table-bordered mt-5 ">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>LogName</th>
                        <th>Description</th>
                        <th>PerformOn</th>
                        <th>CausedBy</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($post->activity as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->log_name }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->subject->title ?? ''}}</td>
                            <td>{{ $activity->causer->name ?? '' }}</td>
                            <td>{{ $activity->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <p><strong>Last Activity Log :</strong></p>

                <table class="table table-bordered mt-5 ">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>LogName</th>
                        <th>Description</th>
                        <th>PerformOn</th>
                        <th>CausedBy</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $post->activity->last()->id }}</td>
                            <td>{{ $post->activity->last()->log_name }}</td>
                            <td>{{ $post->activity->last()->description }}</td>
                            <td>{{ $post->activity->last()->subject->title ?? ''}}</td>
                            <td>{{ $post->activity->last()->causer->name ?? '' }}</td>
                            <td>{{ $post->activity->last()->created_at->diffForHumans() }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
