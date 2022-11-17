@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8">
                <!-- 2FA enabled, we display the QR code : -->
                @if(auth()->user()->two_factor_secret)
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    <!-- 2FA not enabled, we show an 'enable' button  : -->
                @else
                    <form action="{{ route('auth.two_factor.confirm') }}" method="post">
                        @csrf
                        <label>{{ __('Code') }}</label>
                        <input type="text" name="code" />
                        <button type="submit">Login</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
