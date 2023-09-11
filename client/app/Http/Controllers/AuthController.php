<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class AuthController extends Controller
{
    //

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // $url = Http::post('http://192.168.100.213:2023/login', [
        $url = Http::post('http://localhost:2023/api/v1/login', [
            'username' => $username,
            'password' => $password
        ]);

        $check = User::where('username', '=', $username)->first();

        $response = json_decode($url, true);

        if($response['status'] == 200)
        {
            // dd($response);
            Auth::login($check);
            $request->session()->put('token', $response['token']);
            // echo session('token');
            return redirect('wallet/');
        }
    }

    public function destroy(Request $request)
    {
        // dd(auth()->user());
        Auth::logout();
        $request->session()->flush();
        return redirect('/auth');

    }
}
