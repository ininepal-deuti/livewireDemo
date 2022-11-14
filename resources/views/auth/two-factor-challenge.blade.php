@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- 2FA enabled, we display the QR code : -->
                @if(auth()->user()->two_factor_secret)
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    <!-- 2FA not enabled, we show an 'enable' button  : -->
                @else
                    <form action="{{ route('auth.two_factor') }}" method="post">
                        @csrf
                        <button type="submit">Activate 2FA</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
