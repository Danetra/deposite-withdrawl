@extends('layouts.dashboard.header')

@section('page-title', 'Detail Candidate')

@section('content')
    <div class="container-fluid">
        <div class="card card-body card-outline">
            <div class="card-header">
                <span class="text-center mb-1">
                    <h4>
                        <b>
                            Detail Wallets
                        </b>
                    </h4>
                </span>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: bold; color: black;">Full Name</label><br>
                            <span id="name">{{ $wallets['data']['fullName'] }} </span>
                            <span hidden id="idPerusahaan">{{ $wallets['data']['id'] }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">

                            <label style="font-weight: bold; color: black;">Username</label><br>

                            <span id="education">{{ $wallets['data']['username'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: bold; color: black">Currency</label><br>
                            <span id="emailPerusahaan">{{ $wallets['data']['currency'] }}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: bold; color: black">Wallets Value</label><br>
                            <span id="emailPerusahaan">Rp {{ number_format($wallets['data']['wallet_values']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <br />
            <br />

        </div>
    </div>
    </div>

@endsection
