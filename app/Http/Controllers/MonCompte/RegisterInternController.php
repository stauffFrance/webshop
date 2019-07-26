<?php

namespace App\Http\Controllers\MonCompte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Notifications\WelcomeUser;
use App\User;
use Auth;

class RegisterInternController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/monCompte/registerIntern';

    public function __construct()
    {
        $this->middleware('superAdmin');
    }

    public function afficheCreateIntern()
    {
        return view('onglet.account.newUserIntern');
    }

    protected function validator(array $data)
    {
        $data['email'].= '@stauffsa.com';

        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string','email', 'max:80', 'unique:STAUFF_Users'],
            'telephone_fixe' => ['required', 'digits:10'],
            'telephone_portable' => ['regex:/^([0-9]{10})$/','nullable'],
            'service' => ['required', 'string', 'max:255'],
            'fonction' => ['required', 'string', 'max:255'],
        ]);
    }

    public function create(array $data)
    {
        if ($data['telephone_portable'] !== null) {
            if (trim($data['telephone_portable']) !== '') {
                $portable = $data['telephone_portable'];
            } else {
                $portable = null;
            }
        } else {
            $portable = null;
        }

        $u = User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'] . '@stauffsa.com',
            'telephone_fixe' => $data['telephone_fixe'],
            'telephone_portable' => $portable,
            'service' => $data['service'],
            'fonction' => $data['fonction'],
            'password' => bcrypt($data['password']),
            'CardCode' => Auth::user()->CardCode,
            'acces_prix' => isset($data['prix']) ? 1 : 0,
            ]);

        $user = new User();
        $data['email'] .= '@stauffsa.com';
        $user->email = $data['email'];
        $user->notify(new WelcomeUser($data));
    }
}
