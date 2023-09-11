<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class WalletController extends Controller
{
    //
    public function index(Request $request)
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }
        else{
            $token = $request->session()->get('token');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get('http://localhost:2023/api/v1/wallet/' . auth()->user()->id);

            $wallets = json_decode($response, true);

            return view('dashboard.index', ['wallets' => $wallets]);
        }

    }

    public function deposite()
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $option = 'Deposite';

            $randomInt = random_int(1000000000, 9999999999);
            $orderCode = "DP" . $randomInt;

            $data['option'] = $option;
            $data['orderCode'] = $orderCode;
            return view('dashboard.form', $data);
        }
    }

    public function withdrawl()
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $option = 'Withdrawl';

            $randomInt = random_int(1000000000, 9999999999);
            $orderCode = "WD" . $randomInt;

            $data['option'] = $option;
            $data['orderCode'] = $orderCode;
            return view('dashboard.form', $data);
        }
    }

    public function createDepo(Request $request)
    {
        // $form = $request->all();
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $token = $request->session()->get('token');
            // dd($request);

            $post = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->post('http://localhost:2023/api/v1/deposite', [
                'order_id' => $request->input('order_id'),
                'amount' => floatval($request->input('amount')),
                'timestamp' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $response = json_decode($post, true);
            return redirect('wallet');

        }
    }

    public function createWd(Request $request)
    {
        // $form = $request->all();
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $token = $request->session()->get('token');
            // dd($request);

            $post = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->post('http://localhost:2023/api/v1/wd', [
                'order_id' => $request->input('order_id'),
                'amount' => floatval($request->input('amount')),
                'timestamp' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $response = json_decode($post, true);
            return redirect('wallet');

        }
    }

    public function detail(Request $request, $id)
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $token = $request->session()->get('token');
            $url = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get('http://localhost:2023/api/v1/wallet/'.$id);
            $wallets = json_decode($url, true);

            $data['wallets'] = $wallets;
            return view('dashboard.detail', $data);
        }
    }

    public function edit(Request $request, $id)
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $option = 'Edit';
            $token = $request->session()->get('token');
            $skills = Http::get('http://192.168.100.213:2023/skills/');
            $url = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get('http://192.168.100.213:2023/candidate/edit/'.$id);
            $candidate = json_decode($url, true);
            $skill = json_decode($skills, true);
            $check_skills = json_decode($candidate['data'][0]['skills'], true);
            $checked = $this->array_checked($check_skills);

            // dd($checked);
            $data['option'] = $option;
            $data['skills'] = $skill;
            $data['candidate'] = $candidate['data'][0];
            // $data['checklist'] = "$check_skills[0], $check_skills[1], $check_skills[2], $check_skills[3], $check_skills[4]";
            $data['checklist'] = $checked;
            return view('dashboard.form', $data);
        }
    }

    public function update(Request $request)
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $token = $request->session()->get('token');
            // dd($request);
            $update = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->post('http://192.168.100.213:2023/candidate/update', [
                'id' => $request->input('id'),
                'name' => $request->input('name'),
                'education' => $request->input('education'),
                'birthday' => $request->input('birthday'),
                'experience' => $request->input('experience'),
                'last_position' => $request->input('last_position'),
                'applied_position' => $request->input('applied_position'),
                'skills' => $request->input('skills'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'update_at' => date("Y-m-d H:i:s")
            ]);
            return redirect('candidate');
        }

    }

    public function delete(Request $request, $id)
    {
        if(!auth()->user())
        {
            return redirect('auth');
        }else{
            $token = $request->session()->get('token');
            $url = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->delete('http://192.168.100.213:2023/candidate/delete/'.$id);
            $candidate = json_decode($url, true);
            // dd($candidate);
            return redirect('candidate');
        }
    }

    public function array_checked($check_skills)
    {
        $checked = array(
            [
                'skills' => $check_skills[0]
            ],
            [
                'skills' => $check_skills[1]
            ],
            [
                'skills' => $check_skills[2]
            ],
            [
                'skills' => $check_skills[3]
            ],
            [
                'skills' => $check_skills[4]
            ],

        );
        return $checked;
    }
}
