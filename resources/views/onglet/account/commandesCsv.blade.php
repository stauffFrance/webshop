@extends('layouts.afterAuth')

@section('titre','Télécharger les commandes')

@section('content')

@isset($clientEtDate)
    <script type="text/javascript">
    function checkCase(nb){
        var bool = false;
        $('input:checked').each(function(){
            bool = true;
        });

        if(bool){
            $('#button_download').attr('class','buttongreen');
            $('#button_download').removeAttr('disabled');
        }else{
            $('#button_download').attr('class','buttongray');
            $('#button_download').attr('disabled',true);
        }
    }

    </script>

    <script type="text/javascript">
        $(document).ready(function(){

            checkCase({{sizeof($clientEtDate)}});

            $('#button_download').click(function(){
                $.confirm({
                    title: '<br/> Que voulez vous faire ?',
                    content: '',
                    draggable: false,
                    buttons: {
                        telechargerEtSupprimer:{
                            text: 'Télécharger et supprimer',
                            btnClass: 'btn-stauff',
                            keys: ['enter'],
                            action: function(){
                                $('#supprimer').val('oui');
                                $('#form_download').submit();
                            }
                        },
                        justTelecharger:{
                            text: 'Juste télécharger',
                            action: function(){
                                $('#supprimer').val('non');
                                $('#form_download').submit();
                            }
                        },
                        annuler:{

                        },

                    }
                });
            });
        });

    </script>


    <form id="form_download" action="{{route('telechargercommandescsv')}}" method="post">
        @csrf

        <input id="supprimer" type="hidden" name="supprimer" value="">

        <table width='90%' align='left' border="0">

            @foreach($clientEtDate as $i)

                <tr>
                    <td align='left' style="vertical-align: middle">
                        <span style="font-size: 15px">
                            {{$i['client']}}
                        </span>
                    </td>

                    <td align='left' style="vertical-align: middle">
                        <span style="font-size: 15px">
                            <b>{{$i['date']->format('d/m/Y H:i')}}</b>
                        </span>
                    </td>

                    <td style="vertical-align: middle">
                        <input type="checkbox" name="box_{{$i['timestamp']}}" value="on" style="zoom: 1.5;" onchange="checkCase({{sizeof($clientEtDate)}})">
                    </td>

                    <td align='right' style="vertical-align: middle">
                        <a href="#" onclick="return confirmDelete('Voulez vous supprimer cette commande ?','{{route('affichecommandescsv')}}?delete={{$i['timestamp']}}'); return false;" id="" title="supprimer la commande" >
                            <img src="{{asset('pictures/del-blanc.jpg')}}" border="0" width='18px' />
                        </a>
                    </td>

                </tr>

                <tr>
                    <td colspan="5">
                        <hr width='100%' align='left'>
                    </td>
                </tr>

            @endforeach
            <tr height="20px"></tr>
        </table>


        <div align="right">
            <input id="button_download" type="button" class="buttongray" disabled value="Télecharger la sélection">
        </div>

    </form>
@else
    <div style="font-size:16px;">Il n'y a aucune commande.</div>
@endisset

@endsection
