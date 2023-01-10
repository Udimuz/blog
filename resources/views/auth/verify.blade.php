@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтверждение адреса Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Свежая ссылка для подтверждения отправлена на ваш Email-адрес.') }}
                        </div>
                    @endif

                    {{ __('Для продолжения, пожалуйста проверьте ссылку, отправленую на вашу почту.') }}
                    <br>{{ __('Если письмо не найдено') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('запросить новую ссылку') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
