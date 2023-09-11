@extends('layouts.dashboard.header')

@section('page-title', 'Dashboard')

@section('content')
    <div class="jumbotron" style="box-shadow: none; height:auto; margin-left:20px; padding: 15px 30px;">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">

                @if ($option == 'Deposite')
                    <h3 class="text-themecolor">Deposite</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('wallet') }}">Wallets</a></li>
                        <li class="breadcrumb-item active">Deposite</li>
                    </ol>
                @elseif ($option == 'Withdrawl')
                    <h3 class="text-themecolor">Withdrawl</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('wallet') }}">Wallet</a></li>
                        <li class="breadcrumb-item active">Withdrawl</li>
                    </ol>
                @endif
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-md-13">
                <div class="card">
                    <div class="card-block">
                        @if ($option == 'Deposite')
                            <form role="form" action="{{ url('wallet/depo') }}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-6 form-group">
                                        <label>Order Number<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="name" name="order_id" value="{{ $orderCode }}" readonly
                                            placeholder="Your Name" required>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Amount (Rp)<span style="color:red;">*</span></label>
                                        <input type="number" id="education" name="amount" class="form-control"
                                            placeholder="1000">
                                    </div>

                                </div>
                                <button onclick="history.back()" title="Ubah" class="btn btn-danger pull-left float-left">Kembali</button>
                                &nbsp
                                <button type="submit" class="btn btn-primary float-right simpan">Simpan</button>
                            </form>
                        @elseif ($option == 'Withdrawl')
                            <form role="form" action="{{ url('wallet/wd') }}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-6 form-group">
                                        <label>Order Number<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $orderCode }}" readonly
                                            placeholder="Your Name" required>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label>Amount (Rp)<span style="color:red;">*</span></label>
                                        <input type="number" id="amount" name="amount" class="form-control"
                                            placeholder="1000">
                                    </div>

                                </div>
                                <a onclick="history.back()" title="Ubah" class="btn btn-danger pull-left float-left">Kembali</a>
                                &nbsp
                                <button type="submit" class="btn btn-primary float-right simpan">Simpan</button>
                            </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            skills()
            add()
        });

        function skills() {
            var limit = 5;
            $('input.custom-control-input').on('change', function(e) {
                console.log(limit, 'test')
                if ($('input.custom-control-input:checked').length > limit) {
                    $(this).prop('checked', false)

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Select Top 5 Skills',
                    })
                }
            });
        }

        // function add() {
        //     $('.simpan').submit(function() {
        //         console.log($(this).serialize(), 'data')
        //         $.ajax({
        //             method: 'post',
        //             url: '/candidate/create',
        //             data: $(this).serialize(),
        //             // dataType: "json",
        //             success: function(res) {
        //                 console.log(res, 'sukses')
        //                 if (res) {
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'Success',
        //                         text: 'Candidate Successed',
        //                         showConfirmButton: false,
        //                         timer: 1500
        //                     }).then(function() {
        //                         window.location.href = '/candidate'
        //                     })
        //                 }
        //             },
        //             error: function(err) {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Error',
        //                     text: 'Candidate Insert Failed',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 })
        //             }
        //         })
        //     });
        // }

        // function update() {
        //     $('.update').submit(function(e) {
        //         $.ajax({
        //             method: 'post',
        //             url: '/candidate/update',
        //             data: $(this).serialize(),
        //             // dataType: "json",
        //             success: function(res) {
        //                 console.log(res, 'sukses')
        //                 if (res) {
        //                     Swal.fire({
        //                         icon: 'success',
        //                         title: 'Success',
        //                         text: 'Candidate Updated',
        //                         showConfirmButton: false,
        //                         timer: 1500
        //                     }).then(function() {
        //                         window.location = '/candidate'
        //                     })
        //                 }
        //             },
        //             error: function(err) {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Error',
        //                     text: 'Candidate Insert Failed',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 })
        //             }
        //         })
        //     })
        // }
    </script>
@endsection
