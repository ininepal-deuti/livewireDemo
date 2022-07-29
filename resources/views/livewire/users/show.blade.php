@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('User Show') }}</div>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-bordered mt-5">
                            <tbody>
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered mt-5">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Type</th>
                                <th>Data</th>
                                <th width="150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->notifications as $notification)
                                <tr>
                                    <td>{{ $notification->id }}</td>
                                    <td>{{ $notification->type }}</td>
                                    <td>{{ json_encode($notification->data) }}</td>
                                    <td>@if(!is_null($notification->read_at) )
                                            {{ $notification->read_at->diffForHumans() }}
                                        @else
                                            <a class="btn btn-success" href="{{ route('users.notify',['userId'=>$user->id,'notifyId'=>$notification->id]) }}">Mark as read</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
