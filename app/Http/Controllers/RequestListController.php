<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use App\Notifications\RequestMail;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;

//use Notification;

class RequestListController extends Controller
{
    public function __construct()
    {
        $this->middleware('demande');
    }

    public function afficheRequestList(Request $request)
    {
        if (session('requestList') !== null) {
            $requestList = session('requestList');
            foreach ($requestList as &$article) {
                if ($article['desc'] === null and $article['itemCode'] !== null) {
                    $desc = DB::table('OITM')
                                ->select('itemName')
                                ->where('itemcode', '=', $article['itemCode'])
                                ->get();
                    $article['desc'] = $desc[0]->itemName;
                }
            }
            session()->put('requestList', $requestList);
            unset($article);

            if (isset($request->delete)) {
                $index = $request->delete;
                $oldList = session('requestList');
                $request->session()->forget('requestList');

                if ($index !== 'all') {
                    $i = -1;
                    foreach ($oldList as $o) {
                        $i++;
                        if ($i !== intval($index)) {
                            $request->session()->push('requestList', array('itemCode' => $o['itemCode'], 'desc' => $o['desc'], 'qty' => $o['qty'], 'text' => $o['text'], 'prix' => $o['prix'], 'delai' => $o['delai']));
                        }
                    }
                }
                return redirect()->route('afficherequestlist');
            }
        }

        return view('onglet.requestList.request')->with(array('requestList' => session('requestList')));
    }

    public function envoyerRequestList(Request $request)
    {
        $date = Carbon::now()->setTimezone('Europe/Paris');
        $date = $date->format('d/m/Y');
        $user = Auth::user();
        $numCommande = $request->numCommande;
        $requestList = session('requestList');

        $cardNameRequest = DB::table('STAUFF_webshop_client')
                    ->select('CardName as nom')
                    ->where('CardCode', '=', $user->CardCode)
                    ->get();
        $cardName = $cardNameRequest[0]->nom;

        for ($i=0; $i < count($requestList) ; $i++) {
            if ($request->file("FileUpload$i") !== null) {
                for ($j=0; $j < count($request->file("FileUpload$i")) ; $j++) {
                    $file[] = $request->file("FileUpload$i")[$j];
                }
            }
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'webshopfrance@stauffsa.com';
        $mail->Password = 'Cax12940';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('webshopfrance@stauffsa.com', 'STAUFF');
        $mail->addAddress('informatique.stagiaire@stauffsa.com', 'Auger Nathan');
        if (isset($file)) {
            foreach ($file as $f) {
                $mail->addAttachment($f->getRealPath(), $f->getClientOriginalName());
            }
        }
        $mail->Subject = "Webshop - Dem. de Prix/Delai - $cardName";
        $mail->Body = view('emails.requestList', ['date' => $date, 'user' => $user, 'numCommande' => $numCommande, 'requestList' => $requestList])->render();
        $mail->isHTML(true);

        $mail->send();

        /*$html = view('emails.requestList', ['date' => $date, 'user' => $user, 'numCommande' => $numCommande, 'requestList' => $requestList, 'cardName' => $cardName])->render();
        dump($html);
        die();

        Mail::send('emails.requestList', ['date' => $date, 'user' => $user, 'numCommande' => $numCommande, 'requestList' => $requestList, 'cardName' => $cardName], function ($message) use ($cardName) {
            $message->to('informatique.stagiaire@stauffsa.com');
            $message->subject("Webshop - Dem. de Prix/Délai - $cardName");
        });*/

        $request->session()->forget('requestList');
        return back();
    }

    public function ajouterRequestList()
    {
        /*$key = -1;
        if (request('itemCode') !== null) {
            $key = array_search(request('itemCode'), array_column(session('requestList'), 'itemCode'));
            //return $key;
            if ($key > 0) {
                return 'oui';
            }
        }*/

        session()->push('requestList', array('itemCode' => request('itemCode'),
                                             'desc' => request('desc'),
                                             'qty' => request('qty'),
                                             'text' => request('text'),
                                             'delai' => request('delai') !== null ? 'true' :'false',
                                             'prix' => request('prix') !== null ? 'true' :'false'));
        //return 'non';
    }

    public function saveRequestListInput()
    {
        if (request('text') !== null) {
            $type = 'text';
        } elseif (request('qty') !== null) {
            $type = 'qty';
        } elseif (request('prix') !== null) {
            $type = 'prix';
        } elseif (request('delai') !== null) {
            $type = 'delai';
        }
        $requestList = session('requestList');
        $i=-1;
        foreach ($requestList as &$article) {
            $i++;
            if (intval(request('index')) === $i) {
                $article[$type] = request($type);
                break;
            }
        }
        session()->put('requestList', $requestList);
        unset($article);
    }
}
