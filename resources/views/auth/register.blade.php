@extends('layouts.afterAuth')

@section('titre','Créer un compte Administrateur')

@section('monCompte')
<td id='monCompte' class="item active" style="border-right: solid 2px #007857;; border-left: solid 1px #007857;; border-top: solid 1px #007857;">
@endsection

@section('content')
<form name="register" method="POST" action="{{ route('register') }}" onsubmit="showWait('button_register','sanduhr_register');">
    @csrf
    <?php
        use App\Repositories\InfoArticleRepository;

$hashed_random_password = InfoArticleRepository::genere_password();
    ?>

    <table>
        <tr>
            <td style="font-size: 15px;">Nom<span style="color: red">*</span></td>
            <td>
                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required size="35" autofocus style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Prénom<span style="color: red">*</span></td>
            <td>
                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required size="35"style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Adresse Email<span style="color: red">*</span></td>
            <td>
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required size="35" style="font-size: 15px"> <span style="font-size: 15px;" ></span>

            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Téléphone fixe<span style="color: red">*</span></td>
            <td>
                <input id="telephone_fixe" type="text" class="form-control @error('telephone_fixe') is-invalid @enderror" name="telephone_fixe" value="{{ old('telephone_fixe') }}" required size="35" style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Téléphone portable</td>
            <td>
                <input id="telephone_portable" type="text" class="form-control @error('telephone_portable') is-invalid @enderror" name="telephone_portable" value="{{ old('telephone_portable') }}" size="35" style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Fonction<span style="color: red">*</span></td>
            <td>
                <input id="fonction" type="text" class="form-control @error('fonction') is-invalid @enderror" name="fonction" value="{{ old('fonction') }}" required size="35" style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Service<span style="color: red">*</span></td>
            <td>
                <input id="service" type="text" class="form-control @error('service') is-invalid @enderror" name="service" value="{{ old('service') }}" required size="35" style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">Mot de passe<span style="color: red">*</span></td>
            <td>
                <input id="password" type="text" class="form-control @error('service') is-invalid @enderror" name="password" value="{{$hashed_random_password}}" required size="35" style="font-size: 15px; background-color:#e5e5e5" readonly >
            </td>
        </tr>

        <tr>
            <td style="font-size: 15px;">CardCode<span style="color: red">*</span></td>
            <td>
                <input id="CardCode" type="text" class="form-control @error('CardCode') is-invalid @enderror" name="CardCode" value="{{ old('CardCode') }}" required size="35" style="font-size: 15px">
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <br/>
                <span style="color: red">* Champ obligatoire</span>
            </td>
        </tr>

        <tr>
            <td colspan="2" align='right'>
                <div align="right">
                    <input id="button_register" type="submit" class="buttongreen" value="Créer le compte">
                    <div id="sanduhr_register" style="display:none;"><img id="sanduhr_register_img" src="{{ asset('pictures/preloader.gif')}}" height="20" border="0"></div>
                </div>
            </td>
        </tr>

    </table>

    @error('telephone_fixe')
        <br/><br/>
        <span style="color:red">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    @error('telephone_portable')
        <br/><br/>
        <span style="color:red">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    @error('fonction')
        <br/><br/>
        <span style="color:red">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    @error('service')
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

    @error('CardCode')
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
