@extends('loginlayout')

@section('content')
<style>
    .main-content {
        display: flex;
        height: 100vh;
        align-items: center;
        justify-content: center;
        background-image: url('/asset/images/bg-azzo-pay.png');
        background-size: cover;
        background-position: center;
    }
    .left-panel {
        width: 45%; /* Reduzindo a largura do painel esquerdo */
        padding: 20px;
        color: white;
    }
    .left-panel h2 {
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .left-panel img {
        max-width: 100%;
        margin-top: 15px;
    }
    .right-panel {
        width: 45%; /* Reduzindo a largura do painel direito */
        background: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-left: -20px; /* Ajustando a posição para a esquerda */
        background-image: url('');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .form-group {
        position: relative;
        margin-bottom: 20px;
    }
    .form-control {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 16px;
        width: 100%;
        transition: 0.3s ease-in-out;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.25);
        outline: none;
    }
    .input-group-text {
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 8px 0 0 8px;
    }
    .btn-neutral, .btn-primary {
        font-weight: bold;
        border-radius: 20px;
        padding: 12px 24px;
        transition: background-color 0.3s ease-in-out;
        width: 48%;
    }
    .btn-neutral {
        background-color: #007bff;
        color: white;
    }
    .btn-primary {
        background-color: #f07800;
        color: white;
    }
    .btn-neutral:hover {
        background-color: #0056b3;
    }
    .btn-primary:hover {
        background-color: #c86300;
    }
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        .main-content {
            flex-direction: column; /* Muda a direção do flex para coluna em telas pequenas */
            height: auto; /* Permite que a altura se ajuste ao conteúdo */
        }
        .left-panel, .right-panel {
            width: 100%; /* Painéis ocupam a largura total em mobile */
            margin-left: 0; /* Remove a margem esquerda */
        }
        .left-panel {
            padding: 20px 10px; /* Ajusta o padding para mobile */
            text-align: center; /* Centraliza texto em mobile */
        }
        .right-panel {
            padding: 20px 10px; /* Ajusta o padding para mobile */
        }
        .btn-neutral, .btn-primary {
            width: 100%; /* Botões ocupam a largura total */
            margin: 5px 0; /* Adiciona margem entre botões */
        }
        .button-group {
            flex-direction: column; /* Alinha botões em coluna */
        }
    }
</style>

<div class="main-content">
    <div class="left-panel text-center">
<br>
        <h2 style="color:white;">A única plataforma de<br>processamento de pagamentos digitais<br>com Internet Banking 100% integrado.</h2>
        <img src="asset/images/gitazzo.png" width="80%" alt="Imagem ilustrativa">
    </div>
    
    <div class="right-panel">
        <div class="text-center mb-4">
            <img src="{{url('/')}}/asset/{{$logo->image_link}}" width="30%" alt="Logo">
        </div>
        
        <div class="text-center text-dark mb-4">
            <h3 class="text-dark font-weight-bolder">{{$lang["login_sign_in"]}}</h3>
            <small>{{$lang["login_welcome_back_login_to_manage_account"]}}</small>
        </div>
        
        <form role="form" action="{{route('submitlogin')}}" method="post">
            @csrf
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{$lang["login_email"]}}" type="email" name="email" required>
                </div>
                @if ($errors->has('email'))
                    <span class="error form-error-msg">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-unlock"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{$lang["login_password"]}}" type="password" name="password" required>
                </div>
                @if ($errors->has('password'))
                    <span class="error form-error-msg">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="row mt-3 mb-3">
                <div class="col-6">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id="customCheckLogin" type="checkbox" name="remember_me">
                        <label class="custom-control-label" for="customCheckLogin">
                            <span class="text-dark">{{$lang["login_remember_me"]}}</span>
                        </label>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <a href="{{route('user.password.request')}}" class="text-primary"><small>{{$lang["login_forgot_password"]}}</small></a>
                </div>
            </div>
            
            @if($set->recaptcha==1)
                {!! app('captcha')->display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        {{ $errors->first('g-recaptcha-response') }}
                    </span>
                @endif
            @endif
            
            <div class="button-group text-center mt-4">
                <button type="submit" class="btn btn-neutral text-uppercase">{{$lang["login_login"]}}</button>
                <a href="{{route('register')}}" class="btn btn-primary text-uppercase">Abrir conta</a>
            </div>
        </form>
    </div>
</div>
@stop