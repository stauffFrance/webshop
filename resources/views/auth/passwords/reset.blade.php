@extends('layouts.beforeAuth')

@section('titre','Création du nouveau mot de passe')

@section('content')
<script>
$(document).ready(function(){
    $('#password').on('input',function(){
        var text = $('#password').val();

        if(text.length >= 10){
            $('#cercleLongueur').attr('class','cercleVert');
            $('#longueur').css('color','green');
        }else{
            $('#cercleLongueur').attr('class','cercleRouge');
            $('#longueur').css('color','red');
        }

        var regexChiffre = /[0-9]/;
        if(regexChiffre.test(text)){
            $('#cercleChiffre').attr('class','cercleVert');
            $('#chiffre').css('color','green');
        }else{
            $('#cercleChiffre').attr('class','cercleRouge');
            $('#chiffre').css('color','red');
        }

        var regexMajuscule = /[A-Z]/;
        if(regexMajuscule.test(text)){
            $('#cercleMajuscule').attr('class','cercleVert');
            $('#majuscule').css('color','green');
        }else{
            $('#cercleMajuscule').attr('class','cercleRouge');
            $('#majuscule').css('color','red');
        }

        var regexCaractereSpe = /[!@#$%^&*();,.?:{}\-_|<>=+]/;
        if(regexCaractereSpe.test(text)){
            $('#cercleCaractereSpe').attr('class','cercleVert');
            $('#caractereSpe').css('color','green');
        }else{
            $('#cercleCaractereSpe').attr('class','cercleRouge');
            $('#caractereSpe').css('color','red');
        }
    });
});
</script>

<style>
.cercleVert {
    width: 10px;
    height: 10px;
    border-radius: 10px;
    background: #007857;
}

.cercleRouge {
    width: 10px;
    height: 10px;
    border-radius: 10px;
    background: red;
}
</style>

<form name="resetpw" method="POST" action="{{ route('password.update') }}" onsubmit="showWait('button_reset','sanduhr_reset');">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    @csrf
    <table>
        <tr height="20"><td colspan="2"></td></tr>
        <tr>
            <td style="font-size: 15px;">Adresse Email </td>
            <td>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email" size="{{strlen($email)}}" autofocus style="font-size: 15px;background-color:#e5e5e5">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Nouveau mot de passe</td>
            <td>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" value="" required size="{{strlen($email)}}"style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <table>
                    <tr>
                        <td width="15px"><div id="cercleLongueur" class="cercleRouge"></div></td>
                        <td id='longueur' style='color: red; font-size: 13px; vertical-align: middle'>
                            Longueur minimun, <b>10</b>
                        </td>
                    </tr>

                    <tr>
                        <td><div id="cercleChiffre" class="cercleRouge"></div></td>
                        <td id='chiffre' style='color: red; font-size: 13px; vertical-align: middle'>
                            Au moins un <b>chiffre</b>
                        </td>
                    </tr>

                    <tr>
                        <td><div id="cercleMajuscule" class="cercleRouge"></div></td>
                        <td id='majuscule' style='color: red; font-size: 13px; vertical-align: middle'>
                            Au moins une <b>majuscule</b>
                        </td>
                    </tr>

                    <tr>
                        <td><div id="cercleCaractereSpe" class="cercleRouge"></div></td>
                        <td id='caractereSpe' style='color: red; font-size: 13px; vertical-align: middle'>
                            Au moins un <b>caractère spécial</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Confirmer le mot de passe</td>
            <td>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" value="" required size="{{strlen($email)}}" style="font-size: 15px">

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input id="button_reset" type="submit" class="buttongreen" value="Changer le mot de passe">
                <div id="sanduhr_reset" style="display:none;">
                    <img id="sanduhr_reset_img" src="{{ asset('pictures/preloader.gif')}}" height="20" border="0">
                </div>
            </td>
        </tr>
    </table>



    @error('password')
    <br/><br/>
    <span style="color:red">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    @error('email')
    <br/><br/>
    <span style="color:red">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    @if (session('status'))
    <br/><br/>
    <span style="color:blue" >
        <strong>{{ session('status') }}</strong>
    </span>
    @endif

</form>
@endsection
