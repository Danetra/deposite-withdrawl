<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- favicon -->
    {{-- <link rel="icon" type="image/png" href=" <?php echo base_url(); ?>assets/Images/favicon/IMG_logo.png"> --}}
    {{-- <link rel="mask-icon" href="<?php echo base_url(); ?>assets/Images/favicon/IMG_logo.png" color="#5bbad5"> --}}
    <meta name="msapplication-TileColor" content="#da532c">
    {{-- <meta name="msapplication-config" content="<?php echo base_url(); ?>assets/Images/favicon/browserconfig.xml"> --}}
    <meta name="theme-color" content="#ffffff">
    <title>@yield('page-title') | Coding Collective</title>
    <style>
        form i {
            margin-left: -30px;
            cursor: pointer;
        }
    </style>
</head>

<body style="padding: 0; border: 0; font-family: 'Noto Sans', sans-serif" aria-busy="true">
    <div class="container-fluid">
        <div class="row">
            <div class="col panelheader">
                <i id="menuOpen" class="fas fa-bars fa-2x iconmenu menuOpen" style="cursor: pointer;"
                    onclick="changestate('open');"></i>
                <i id="menuClose" class="fas fa-times fa-2x iconclose menuClose" style="cursor: pointer; display:none;"
                    onclick="changestate('close');"></i>
                <img id="imgLogo" src="{{ asset('assets/img/codingcollective.png') }}"
                    style="height: 60px; margin-bottom: 11px ; cursor: pointer;" />
                <div class="panelauthentication">

                    <a class="panelauthentication">
                        <span><b>
                                {{ auth()->user()->name }}
                        </b></span></b></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-lg-2 panelmenu" style="background-color: #fff; height:auto;">
                    <div class="scrollstyle" style="overflow-y: auto; height: 100%;">
                        <ul class="list-group" style="font-size: 14px;">

                            <li class='list-group-item border border-0 hovermenu' id="menulogout" name="menulogout"
                                href="{{ url('logout') }} " name="menulogout" style='cursor: pointer;'><i
                                    class='fas fa-sign-out-alt' style='margin-right: 7px;'></i><b
                                    style="margin-left: 10px;">Logout</b></li>

                            <li class='list-group-item border border-0 hovermenu' id="menumahasiswa"
                                onclick="window.location.href='{{ url('wallet') }}';" style='cursor: pointer;'><i
                                    class='fa-solid fa-user-group' style='margin-right: 7px;'></i><b
                                    style="margin-left: 10px;">Wallets</b></li>

                        </ul>
                    </div>
                </div>
                <div class="col panelcontent panelcontentweb" style="font-size: 14px; height:650px">
                    <div class="scrollstyle">
                        <nav aria-label=" breadcrumb" style="margin-left: 20px;">
                            <ol class="breadcrumb" style="padding: 0; margin: 0; background-color: #FFF;">
                                <li class="breadcrumb-item text-warning"><a href="/wallet" class="text-warning"
                                        style="text-decoration: none">
                                        <b>
                                            Coding Collective</b></a></li>
                                <li class="breadcrumb-item active"><b>Wallet</b></li>
                            </ol>
                        </nav>
                        <hr style="margin-top: .8em;" />
                        <section class="content">
                            @yield('content')
                        </section>
                    </div>
                </div>
            </div>

            <script>
                $(document).on('click', '#menulogout', function(e) {
                    e.preventDefault();
                    var getLink = $(this).attr('href');
                    // console.log(getLink, 'test link');
                    Swal.fire({
                        title: 'Apakah Anda ingin Logout?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //   Swal.fire(
                            //   'Berhasil!',
                            //   'Terima!',
                            //   'success'
                            // )
                            window.location = getLink;
                        }
                    })
                    return false;
                });
            </script>
