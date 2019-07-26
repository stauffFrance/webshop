<?php

namespace App\Http\Controllers\MonCompte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use ZipArchive;

class CommandCsvController extends Controller
{
    public function __construct()
    {
        $this->middleware('superAdmin');
    }

    public function afficheCommandesCsv(Request $request)
    {
        $list = array_diff(scandir('CSV/achat'), array('..', '.','nepastoucher.txt'));

        if (sizeof($list) !== 0) {
            if (isset($request->delete)) {
                array_map('unlink', glob("CSV/achat/*$request->delete*.csv"));
                return redirect()->route('affichecommandescsv');
            }
            $i=-1;
            foreach ($list as $n) {
                $infos = explode(';', $n);

                if ($infos[1] === 'entete') {
                    continue;
                }

                $i++;

                $nomFichierCommandes[] = $n;

                $timestamp = substr($infos[2], 0, strlen($infos[2])-4);
                $date = new Carbon($timestamp);
                //$date->format('d/m/Y h:m'));

                $clientEtDate[$i]['client'] = $infos[0];
                $clientEtDate[$i]['date'] = $date;
                $clientEtDate[$i]['timestamp'] = $timestamp;
            }

            usort(
                $clientEtDate,
                function ($x, $y) {
                    if ($x['date'] === $y['date']) {
                        return 0;
                    }

                    return $x['date'] > $y['date'] ? 1 : -1;
                }
        );

            if (session('clientEtDate') !== null) {
                session()->forget('clientEtDate');
            }
            session()->put('clientEtDate', $clientEtDate);

            return view('onglet.account.commandesCsv')->with(array('clientEtDate' => $clientEtDate));
        } else {
            return view('onglet.account.commandesCsv');
        }
    }

    public function telechargerCommandesCsv(Request $request)
    {
        $clientEtDate = session('clientEtDate');
        $listFichier = $this->createZip($clientEtDate, $request);
        header('content-type:application/octet-stream');
        header("content-disposition: attachement; filename=commande.zip");
        readfile('ZIP/commande.zip');
        if ($request->supprimer === "oui") {
            foreach ($listFichier as $filename) {
                unlink("CSV/achat/$filename");
            }
        }
    }

    private function createZip($clientEtDate, $request)
    {
        $listFichier = [];
        $zip = new ZipArchive;

        if (file_exists('ZIP/commande.zip')) {
            unlink('ZIP/commande.zip');
        }

        if ($zip->open('ZIP/commande.zip', ZipArchive::CREATE) === true) {
            foreach ($clientEtDate as $i) {
                if (request("box_" . $i['timestamp']) !== null) {
                    $entete = $i['client'] . ';entete;' . $i['timestamp'] . '.csv';
                    $ligne =  $i['client'] . ';ligne;' . $i['timestamp'] . '.csv';
                    array_push($listFichier, $entete, $ligne);
                    $zip->addFile("CSV/achat/$entete", $entete);
                    $zip->addFile("CSV/achat/$ligne", $ligne);
                }
            }

            $zip->close();
        }

        return $listFichier;
    }
}
