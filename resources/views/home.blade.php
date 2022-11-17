@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- 2FA enabled, we display the QR code : -->
                    @if(auth()->user()->two_factor_confirmed)
                        <!-- 2FA enabled, we show an 'disable' button  : -->
                        <form action="{{ route('auth.two_factor.disable') }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit">Deactivate 2FA</button>
                        </form>
                    @elseif(auth()->user()->two_factor_secret)
                        <!-- 2FA enabled, but not valid  : -->
                        <p>Validate 2FA by scanning the floowing QRcode and entering the TOTP (Time-Base OTP)</p>
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        <form class="form col-md-3 m-1" action="{{ route('auth.two_factor.confirm') }}" method="post">
                            @csrf
                            <div class="form-control">
                                <input type="text" name="code" required/>
                            </div>
                            <button class="btn btn-success" type="submit">Validate 2FA</button>
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
