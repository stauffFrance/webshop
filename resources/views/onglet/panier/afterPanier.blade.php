@extends('layouts.afterAuth')

@section('titre','Confirmation de commande')

@section('panier','oui')

@section('content')
    <center>

        <table border="0">
            <tr height="15px"></tr>
            
            <tr>
                <td width="45px">
                    <img src="{{asset('pictures/Tick.png')}}" width="35"/>
                </td>

                <td style="vertical-align: middle">
                    <span style='font-size: 25px'>Nous vous remercions de votre commande.</span>
                </td>
            </tr>

            <tr height="15px"></tr>

        </table>

        <span style='font-size: 20px'>Vous recevrez un accusé de réception dès le traitement de votre commande.</span>

    <center/>
@endsection
