@extends('layouts.dashboard.header')

@section('page-title', 'Dashboard')

@section('content')
    <a href="{{ url('wallet/deposite') }}" class="btn btn-success">
        Deposite
    </a>
    <a href="{{ url('wallet/withdrawl') }}" class="btn btn-danger">
        Withdrawl
    </a>
    <span class="text-center mb-1">
        <h4>
            <b>
                Wallets
            </b>
        </h4>
    </span>
    <hr />
    <div class="card">
        <table class="table container-fluid w-100 h-10 text-center" id="myTable">
            <thead>
                <tr>
                    <th class="text-center">
                        No
                    </th>
                    <th class="text-center">
                        Name
                    </th>
                    <th class="text-center">
                        Currency
                    </th>
                    <th class="text-center">
                        Wallet
                    </th>
                    <th class="text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $wallets['data']['fullName'] }}</td>
                    <td>{{ $wallets['data']['currency'] }}</td>
                    <td>Rp {{ number_format($wallets['data']['wallet_values']) }}</td>
                    <td>
                        <a href="{{ url('wallet/detail/' . $wallets['data']['id']) }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
@endsection
