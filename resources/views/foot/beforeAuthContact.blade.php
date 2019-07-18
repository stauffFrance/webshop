@extends('layouts.beforeAuth')

@section('connexion','oui')
@section('contact', 'oui')

@section('titre','Informations de contact')

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <div class="csc-header csc-header-n2">
                    <h2>Stauff S.A.S</h2>
                </div>
                230 Avenue du Grain d'Or<br/>
                41350 Vineuil-Cedex<br/>
                France
            </td>
            <td>
                <img src="{{asset('pictures/')}}" alt="" width="" border="0"/>
            </td>
        </tr>
    </table>

    <br/>

    <strong>
        <table width="100%">
            <tr>
                <td>Téléphone</td>
                <td>+33 (0) 2 54 50 55 50</td>
            </tr>
            <tr>
                <td>e-Mail</td>
                <td><a href="mailto:commercial@stauffsa.com">commercial@stauffsa.com</a></td>
            </tr>
        </table>
    </strong>

@endsection
