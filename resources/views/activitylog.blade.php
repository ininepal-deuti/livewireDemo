
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Activity Logs') }}</div>

                    <div class="card-body">
                        <div class="container">
                            <table class="table table-bordered mt-5">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>LogName</th>
                                    <th>Description</th>
                                    <th>PerformOn</th>
                                    <th>CausedBy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($activityLogs as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->log_name }}</td>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ $activity->subject->title ?? ''}}</td>
                                        <td>{{ $activity->causer->name ?? '' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
