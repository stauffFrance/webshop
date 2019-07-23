@extends('layouts.afterAuth')

@section('titre','Confirmation d\'envoi des demandes')

@section('requestList', 'oui')

@section('content')

    <center>

        <table border="0">
            <tr height="15px"></tr>

            <tr>
                <td width="45px">
                    <img src="{{asset('pictures/Tick.png')}}" width="35"/>
                </td>

                <td style="vertical-align: middle">
                    <span style='font-size: 25px'>Nous vous remercions de votre demande.</span>
                </td>
            </tr>

            <tr height="15px"></tr>

        </table>

        <span style='font-size: 20px'>Vous recevrez notre offre par E-mail.</span>

    <center/>

@endsection
