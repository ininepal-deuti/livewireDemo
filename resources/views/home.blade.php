@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <!-- 2FA enabled, we display the QR code : -->
                    @if(auth()->user()->two_factor_secret)
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}

                        <!-- 2FA enabled, we show an 'disable' button  : -->
                        <form action="{{ route('auth.two_factor.disable') }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit">Deactivate 2FA</button>
                        </form>

                    @else
                        <!-- 2FA not enabled, we show an 'enable' button  : -->
                        <form action="{{ route('auth.two_factor.enable') }}" method="post">
                            @csrf
                            <button type="submit">Activate 2FA</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
