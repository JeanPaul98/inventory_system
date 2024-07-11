@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 2%">
                <div class="card" style="width: 40rem;">
                    <div class="card-body">
                        <h4 class="card-title">Vérifiez votre adresse e-mail</h4>
                        @if (session('resent'))
                            <p class="alert alert-success" role="alert">Un nouveau lien de vérification a été envoyé à votre adresse e-mail.</p>
                        @endif
                        <p class="card-text">Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification. Si vous n'avez pas reçu l'e-mail,</p>
                        <a href="{{ route('verification.resend') }}">cliquez ici pour en demander un autre</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
