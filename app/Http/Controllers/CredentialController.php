<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    public function index()
    {
        $credentials = Credential::all();
        $count = Credential::all()->where('id')->count();
        return view('credentials.index', compact('credentials', 'count'));
    }
    public function create()
    {
        return view('credentials.create');
    }
    public function store(Request $request)
    {
        $credential = new Credential();

        $credential->login = $request->input('login');
        $credential->secret_key = $request->input('secret_key');
        $credential->url = $request->input('url');

        if($request->input('local') == 'Colombia'){
            $credential->local = 'CO';
        }

        if($request->input('local') == 'Ecuador'){
            $credential->local = 'EC';
        }

        if($request->input('local') == 'Puerto Rico'){
            $credential->local = 'PR';
        }

        $credential->save();

        return redirect(route('credential.index'));
    }
}
