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
        width: 35%; /* Reduzindo a largura do painel esquerdo */
        padding: 10px;
        color: white;
    }
    .left-panel h2 {
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: bold;
    }
    .left-panel img {
        max-width: 80%;
        margin-top: 10px;
    }
    .right-panel {
        width: 35%; /* Reduzindo a largura do painel direito */
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .form-group {
        position: relative;
        margin-bottom: 15px;
    }
    .form-control {
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 8px 10px;
        font-size: 14px;
        width: 100%;
        transition: 0.3s ease-in-out;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.25);
        outline: none;
    }
    .input-group-text {
        background-color: #007bff;
        border: none;
        color: white;
        border-radius: 6px 0 0 6px;
    }
    .btn-neutral, .btn-primary {
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 20px;
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
    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 8px;
    }
</style>

<div class="main-content">
    <div class="left-panel text-center">
        <h2 style="color:white; font-size: 50px;">Seja bem-vindo(a) á AzzoPay</h2>
        <h3 style="color:white; font-size: 18px;">Você está a alguns passos de fazer parte<br> do <b>maior ecossistema financeiro</b> <br>para negócios digitais do Brasil <3</h3>
    </div>
    
    <div class="right-panel">
        <div class="text-center mb-3">
            <img src="{{ asset('asset/images/logo_1729893253.png') }}" width="30%" alt="Logo">
        </div>
        
        <div class="text-center text-dark mb-3">
            <h3 class="text-dark font-weight-bolder">{{$lang["regiter_sign_up"]}}</h3>
            <small>{{$set->title}}</small>
        </div>
        
        <form role="form" action="{{route('submitregister')}}" method="post">
            @csrf
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-briefcase"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{$lang["regiter_business_name"]}}" type="text" name="business_name" required>
                </div>
                @if ($errors->has('business_name'))
                    <span class="text-xs text-uppercase">{{$errors->first('business_name')}}</span>
                @endif
            </div>
            <!-- Campo CPF/CNPJ -->
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-id-card"></i></span>
                    </div>
                    <input class="form-control" placeholder="CPF ou CNPJ" type="text" name="cpf_cnpj" id="cpf_cnpj" required maxlength="18" oninput="maskCPF_CNPJ(this)">
                </div>
                @if ($errors->has('cpf_cnpj'))
                    <span class="text-xs text-uppercase">{{$errors->first('cpf_cnpj')}}</span>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fad fa-user"></i></span>
                        </div>
                        <input class="form-control" placeholder="{{$lang["regiter_first_name"]}}" type="text" name="first_name" required>
                    </div>
                </div>      
                <div class="col-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fad fa-user"></i></span>
                        </div>
                        <input class="form-control" placeholder="{{$lang["regiter_last_name"]}}" type="text" name="last_name" required>
                    </div>
                </div>
            </div>
          
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{$lang["regiter_email"]}}" type="email" name="email" required>
                </div>
                @if ($errors->has('email'))
                    <span class="text-xs text-uppercase">{{$errors->first('email')}}</span>
                @endif
            </div>
          
            <div class="form-group mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-phone-alt"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{$lang["regiter_mobile"]}}" type="text" name="phone" id="phone" maxlength="15" required oninput="maskPhone(this)">
                </div>
                @if ($errors->has('phone'))
                    <span class="text-xs text-uppercase">{{$errors->first('phone')}}</span>
                @endif
            </div>
          
            <div class="form-group">
                <select class="form-control select" name="country" required>
                    <option value="">{{$lang["regiter_select_country"]}}</option> 
                    @foreach($country as $val)
                        <option value="{{$val->country_id}}">{{$val->real['nicename']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fad fa-unlock"></i></span>
                    </div>
                    <input class="form-control" id="new_password" placeholder="{{$lang["regiter_password"]}}" type="password" name="password" required>
                </div>
            </div>
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" id="customCheckLogin" type="checkbox" required>
                <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">{{$lang["regiter_agree_to"]}} <a href="{{route('terms')}}">{{$lang["regiter_terms_and_conditions"]}}</a></span>
                </label>
            </div>
            <div class="button-group text-center mt-3">
                <button type="submit" class="btn btn-neutral text-uppercase">{{$lang["regiter_create_account"]}}</button>
                <a href="{{route('login')}}" class="btn btn-primary text-uppercase">{{$lang["regiter_got_an_account"]}}</a>
            </div>
        </form>
    </div>
</div>
<script>
    function maskCPF_CNPJ(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length <= 11) {
            input.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        } else {
            input.value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
        }
    }
    function maskPhone(input) {
        // Remove qualquer caractere que não seja um número
        let value = input.value.replace(/\D/g, '');
        
        // Aplica a máscara de telefone durante a digitação
        if (value.length <= 10) {
            input.value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        } else {
            input.value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
    }
</script>
@endsection
