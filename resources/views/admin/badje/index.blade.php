@extends('base')

@section('title', "BADJE")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>

            {{-- --------- Plus d'info ------------ --}}
            <div class="place-plus-info">
                <div class="plc">
                    {{-- icon --}}
                    <a href="">
                        <div class="i-icon">
                            <i class='bx bx-pin'></i>
                        </div>
                    </a>
                    {{-- btns --}}
                    <div class="a-txt">
                        {{-- Permission --}}
                        <a href="{{ route('admin.permissions.index') }}" class="notification1" id="notificationBtn1">
                            <div>
                                <p>Permission en attente</p>
                                <div>
                                    <span  class="num1">{{ $countInfo1 }}</span> 
                                </div>
                            </div>
                        </a>
                        {{-- Congé --}}
                        <a href="{{ route('admin.conges.index') }}"  class="notification2" id="notificationBtn2">
                            <div>
                                <p>Congé en attente</p>
                                <div>
                                    <span class="num2">{{ $countInfo2 }}</span>
                                </div>
                            </div>
                        </a>
                        {{-- Mission --}}
                        <a href="#">
                            <div>
                                <p>Mission</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                        {{-- Messages --}}
                        <a href="#">
                            <div>
                                <p>Messages</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="head-title">
                <div class="left">
                    <h1>CODE QR</h1>
                    <div id="reader" style="width:300px;"></div>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Code QR</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.genereqrs.index') }}">Générer code QR</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="">Code QR de {{ $genererqr->Nom }}</a>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('badge_pdf', ['id' => $genererqr->id]) }}" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">IMPRIMER</span>
                </a>
            </div>

            <!-- ************************************************ -->

            <ul class="box-info">
                <li class="li">
                    <section class="sectBadje">
                        <div class="container container-badje">
                            <div class="en-tete-badje">
                                <div class="profil-badje">
                                    {{-- <img class="img-tete-badje" src="{{ $genererqr->imageqr }}" alt=""> --}}
                                    @if($genererqr->employes)
                                    <img src="{{ asset('images/' . $genererqr->imageqr) }}" alt="" class="img-tete-badje">
                                    @else
                                    @endif
                                </div>
                                <div class="txt-profil-badje">
                                    <h5 class="number">{{ $genererqr->numEmp }}</h5>
                                    {{-- Affichage des données employes --}}
                                    <h3 class="txt-info-badje">{{ $genererqr->employes->Nom }}</h3>
                                    <h3 class="txt-info-badje">{{ $genererqr->employes->Prenom }}</h3>
                                    <p>{{ $genererqr->employes->Grade }}</p>
                                </div>
                            </div>
                            <div class="en-pied-badje">
                                <br>
                                <div class="place-num">
                                    <h1 class="h1">Numéro : <span class="span-num">{{ $genererqr->employes->Telephone }}</span></h1>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="sectBadje">
                        <div class="container container-badje">
                            <header class="header">
                                <span class="logo logo-badje">
                                    {{-- ---------- IMG Logo ---------- --}}
                                    <img class="img-badje" src="{{ asset('assets/images/logo1.png') }}" alt="">
                                    <h5 class="h5">REGION ANOSY</h5>
                                </span>
                                {{-- ---------- IMG Profil ---------- --}}
                                {{-- <img class="img-qr-badje" src="{{ asset($genererqr->employes->images) }}" alt="" class="chip"> --}}
                                    @php
                                        $image = $latestImages->firstWhere('numEmp', $genererqr->numEmp);
                                    @endphp
                                    @if($image)
                                        <img class="img-qr-badje" src="{{ asset($image->imgProfil) }}" alt="Image de profil">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                            </header>

                            <div class="card-details">
                                <div class="name-number">
                                    <h6>Numéro CIN</h6>
                                    <h5 class="number">{{ $genererqr->numEmp }}</h5>
                                    <h5 class="name">{{ $genererqr->employes->Nom }} {{ $genererqr->employes->Prenom }}</h5>
                                </div>
                                <div class="valid-date">
                                    <h6>Validation</h6>
                                    <h5>{{ $genererqr->employes->DatEntre }}</h5>
                                </div>
                            </div>
                        </div>
                    </section>
                </li>
            </ul>

        </main>
    </section>

@endsection

<style>
    .en-tete-badje{
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .img-tete-badje{
        width: 120px;
        height: 120px;
        object-fit: cover;
    }
    .txt-profil-badje{
        grid: 5px;
    }
    .place-num{
        width: 100%;
        height: 50px;
        box-shadow: 0 0 3px #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        backdrop-filter: blur(10px);
    }
    .h1{
        font-size: 25px;
        font-weight: 500;
        margin-left: 13px;
        color: #aaa7a7;
    }
    .span-num{
        font-size: 25px;
        font-weight: 500;
        margin-left: 13px;
        letter-spacing: 2px;
    }
</style>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    .sectBadje{
        position: relative;
        min-height: 55vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        perspective: 1000px;
    }

    .container-badje{
        background-image: url("assets/images/bg.png");
    }

    .container-badje{
        background-size: cover;
        position: relative;
        padding: 25px;
        border-radius: 28px;
        max-width: 400px;
        width: 100%;
        background-image: url('{{ asset('assets/images/bg.png') }}');
        box-shadow: 0 5px 10px rgba(88, 88, 88, 0.1);
    }

    header, .logo-badje{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-left: 0;
    }

    .logo-badje .img-badje{
        width: 75px;
        height: 70px;
    }

    .img-qr-badje{
        width: 65px;
        height: 65px;
        border-radius: 50%;
        box-shadow: 0 0 5px #fff;
    }

    h5{
        font-size: 16px;
        font-weight: 400;
        color: #fff;
    }

    header .chip{
        width: 60px;
    }

    h6{
        color: #fff;
        font-size: 11px;
        font-weight: 400;
    }

    h5.number{
        margin-top: 4px;
        font-size: 18px;
        letter-spacing: 1px;
    }

    h5.name{
    margin-top: 20px;
    }

    .container-badje .card-details{
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }
</style>
