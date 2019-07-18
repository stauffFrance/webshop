<span style='font-size: 10px'>
Objet : <b>{{$numCommande}}</b> du {{$date}} <br/><br/>

De : {{$user->nom}} {{$user->prenom}} - {{$user->email}} <br/><br/>

@foreach($panier as $p)
    ---------------------------------------------------------- <br/>

    Commande de {{$p['qty']}} PC, {{$p['itemCode']}}
    <br>
    Dates Pr&eacute;vues :
    <br>
    @foreach($listDate[$loop->index]['dates'] as $date)
        @if($listDate[$loop->parent->index]['qty'][$loop->index] !== 0)
            {{$listDate[$loop->parent->index]['qty'][$loop->index]}} -- @if($date) {{$date}} @else Nous consulter @endif
            <br>
        @endif
    @endforeach

    <br>
@endforeach
</span>
