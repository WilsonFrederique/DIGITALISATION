@extends('base')

@section('title', "PAGE CONGES")

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

            <!-- ********************** Header Main ************************ -->
            <div class="head-title">
                <div class="left">
                    <h1>CONGES</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Conge</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Page Conge</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="#" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                    <a href="{{ route('admin.conges.create') }}" class="btn-download">
                        <i class='bx bx-plus-medical'></i>
                        <span class="text">Nouveau Conge</span>
                    </a>
                </div>
            </div>

            <!-- ********************* TBL AFFICHAGE En Attente *********************** -->
            <div class="table-date">
                <div class="orber">
                    <div class="head">
                        <h3 style="color: #2271ff; font-size: 1rem;">Liste des conges en attente...</h3>
                        <form class="tbl-tete-droit" action="#">
                            <div class="inputDate">
                                <input class="input-rech-date-point" type="date">
                            </div>
                        </form>
                        <i class='bx bx-search icon-tbl' ></i>
                        <i class='bx bx-filter icon-tbl'></i>
                    </div>
                    <table>
                        <thead class="thead">
                            <tr>
                                <th>Profil</th>
                                <th>Jours de conge</th>
                                <th>Reste de conge</th>
                                <th>Validation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($employesAttente as $attente)
                        <tbody class="tbody">
                            @foreach ($attente->conges as $conge)

                            <tr>
                                <td>
                                    @php
                                    $image = $latestImages->firstWhere('numEmp', $attente->numEmp);
                                    @endphp
                                    @if($image)
                                        <img class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                                    @endif
                                    <p>{{ $attente->Nom }} {{ $attente->Prenom }}</p>
                                </td>
                                <td><span class="status jours">{{ $conge->NbrJours }}</span></td>
                                <td><span class="status reste">{{ $conge->Solde }}</span></td>
                              
                                <td><span style="color: #28509b;">En attente...</span></td>
                                <td>
                                    <div class="icon-container">
                                        <a href="{{ route('admin.valid.edit', $conge->id) }}" style="padding-right: 1.5rem;">
                                            <i class='bx bx-send icon-mod-del-pointag' style='color:#228e8a'  ></i>
                                        </a>
                                        <a href="#">
                                            <i class='bx bx-detail icon-mod-del-pointag' style='color:#1f2dad'  ></i>
                                        </a>
                                        <a href="{{ route('admin.conges.edit', $conge->id) }}" class="icon-modif">
                                            <i class='bx bx-edit icon-mod-del-pointag' style='color:#0a6202'  ></i>
                                        </a>
                                        <form action="{{ route('admin.conges.destroy', $conge->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                  <a href=""><i class='bx bx-trash icon-mod-del-pointag' style='color:#d01616'  ></i></a>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

            <!-- ********************* Table Valid ou Invalid ************************* -->
            <div class="table-date">
                {{-- Validation Oui --}}
                <div class="todo">
                    <div class="head">
                        <h3 style="color: #450ae7; font-size: 1rem;">Liste des congés générée avec succès</h3>
                        <i class='bx bx-plus icon-tbl icon-btn-plus' ></i>
                        <i class='bx bx-filter icon-tbl'></i>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employesValide as $valide)
                           @foreach ($valide->conges as $conge)

                            {{-- ------- Date en tête -------- --}}
                            <div class="bottom-oui" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                                <div class="date" style="display: flex; align-items: center; gap: 0.5rem;">
                                    <p>{{ $conge->DateDebut }}</p>
                                    au
                                    <p>{{ $conge->DateFin }}</p>
                                </div>
                                <div class="vald">
                                    <p>Validation <span style="background: #2271ff; padding: 0 0.5rem; color: #fff; border-radius: 10px;">Oui</span></p>
                                </div>
                            </div>
                            {{-- ------- Content Oui ------- --}}
                            <li class="Coge-oui">
                                <div class="todo-item">
                                    @php
                                        $image = $latestImages->firstWhere('numEmp', $valide->numEmp);
                                    @endphp
                                    @if($image && $image)
                                        <img class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                                    <div class="txt-left">
                                        <p>{{ $valide->Nom }} {{ $valide->Prenom }}</p>
                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr">
                                        <a href=""><i class='bx bx-detail' style='color:#1f2dad'  ></i></a>
                                        <form action="{{ route('admin.conges.destroy', $conge->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                  <a href=""><i class='bx bx-trash delt-qr' style='color:#d01616'  ></i></a>
                                             </button>
                                       </form>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>


                {{-- Validation Non --}}
                <div class="todo">
                    <div class="head">
                        <h3 style="color: #f04040; font-size: 1rem;">Liste des congés refusés</h3>
                        <i class='bx bx-plus icon-tbl icon-btn-plus' ></i>
                        <i class='bx bx-filter icon-tbl'></i>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employesRefuse as $refuse)
                        @foreach ($refuse->conges as $conge)

                            {{-- ------- Date en tête -------- --}}
                            <div class="bottom-oui" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                                <div class="vald">
                                    <p>Validation <span style="background: #fd6a57; padding: 0 0.5rem; color: #fff; border-radius: 10px;">Non</span></p>
                                </div>
                            </div>
                            {{-- ------- Content Non ------- --}}
                            <li class="conge-non">
                                <div class="todo-item">
                                    @php
                                        $image = $latestImages->firstWhere('numEmp', $refuse->numEmp);
                                    @endphp
                                    @if($image && $image)
                                        <img class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                                    <div class="txt-left">
                                        <p>{{ $refuse->Nom }} {{ $refuse->Prenom }}</p>
                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr">
                                        <a href=""><i class='bx bx-detail' style='color:#1f2dad'  ></i></a>
                                        <form action="{{ route('admin.conges.destroy', $conge->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <a href="#"><i class='bx bx-trash delt-qr' style='color:#d01616'  ></i></a>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- *********************** FORMULAIRE ************************ -->
            <div class="overlay hidden"></div>
            <div class="container-conge hidden">
                <div class="form-conge">
                    <form action="#">
                        <p class="p-x"><i class='bx bx-x icon-x'></i></p>
                        <div class="input1">
                            <p>Numéro CIN</p>
                            <input type="text" placeholder="Numéro CIN" id="vid1">
                        </div>
                        <div class="frm1">
                            <div class="input1">
                                <p>Numéro Congé</p>
                                <input type="text" placeholder="Numéro Congé" id="vid2">
                            </div>
                            <div class="input1">
                                <p>Nombre du jour</p>
                                <input type="number" placeholder="Nombre du jour" id="vid3">
                            </div>
                        </div>
                        <div class="input1">
                            <p>Demande</p>
                            <input type="date" placeholder="Date de la demande" id="vid4">
                        </div>
                        <div class="input1">
                            <p>Description</p>
                            <textarea name="" required placeholder="Description" id="" cols="30" rows="10" id="vid5"></textarea>
                        </div>

                        <button onclick="genererQR()">Generer QR</button>
                    </form>
                </div>
            </div>

        </main>
    </section>

@endsection

{{-- ------------------- Css pour visible ei invisible du fr------------------------- --}}
<style>
    /* ------------------------ ETO MIGERER ANLE IZ HOE REHEFA MIALA LE FRM DE AZO KITIHINA TSARA LE PROGE ---------------------- */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Couleur de fond avec opacité */
        z-index: 999; /* Met l'overlay derrière le formulaire */
        display: none; /* Caché par défaut */
    }

    .overlay.hidden {
        display: none;
    }

    .container-conge.hidden {
        display: none;
    }

    .container-conge {
        top: 0%;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        height: 100vh;
        position: fixed;
        padding: 36px 24px;
        /* background: rgb(192, 39, 39); */
    }

</style>

{{-- -------------------------- Css pour la formulaire ------------------------------ --}}
<style>
    *{
        padding: 0;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    body{
        background: #262a2f;
    }

    .frm1{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .form-conge textarea {
        width: 100%;
        height: 50px;
        border: 1px solid #494eea;
        outline: 0;
        padding: 10px;
        margin: 10px 0 20px;
        border-radius: 5px;
    }

    .form-conge{
        width: 400px;
        padding: 25px 35px;
        position: absolute;
        top: 52%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: var(--color-bg-form-conge);
        border-radius: 10px;
    }

    /* ****** Ito no mampipoitra anle css rehefa nikitik btn ajout ****** */
    .form-conge.active-poput {
        transform: translate(-50%, -50%) scale(1);
    }

    .form-conge p{
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 3px;
        color: var(--txt-header-input-qr);
    }

    .form-conge input{
        width: 100%;
        height: 50px;
        border: 1px solid #494eea;
        outline: 0;
        padding: 10px;
        margin: 10px 0 20px;
        border-radius: 5px;
    }

    .form-conge button{
        width: 100%;
        height: 50px;
        background: #494eea;
        color: #fff;
        border: 0;
        outline: 0;
        border-radius: 5px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        margin: 15px 0;
        font-weight: 500;
    }

    #imgBox{
        width: 200px;
        border-radius: 5px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 1s;
    }

    #imgBox img{
        width: 100%;
        height: 200px;
    }

    #imgBox.show-img{
        max-height: 300px;
        margin: 10px auto;
        border: 1px solid #d1d1d1;
    }

    .error{
        animation: shake 0.1s linear 10;
    }

    /* ---- Btn x pour qr ----  */
    .icon-x{
        position: absolute;
        top: 8px;
        right: 7px;
        border: 1px solid var(--color-border-btn-x);
        height: 23px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 20px;
        color: rgb(223, 75, 75);
    }
    .icon-x:hover{
        background: rgb(185, 42, 42);
        color: #fff;
        border-radius: 50%;
        height: 23px;
        border: 1px solid var(--color-border-btn-x-hover);
    }

    @keyframes shake{
        0%{
            transform: translateX(0);
        }
        25%{
            transform: translateX(-2px);
        }
        50%{
            transform: translateX(0);
        }
        75%{
            transform: translateX(2px);
        }
        100%{
            transform: translateX(0);
        }
    }
</style>

{{-- ---------------------- Scrip pour visible ou invisible -------------------------- --}}
<script>

    // ================= Pour la btn Ajout =================
    document.addEventListener('DOMContentLoaded', function () {

        const overlay = document.querySelector('.overlay');
        const formQR = document.querySelector('.container-conge');
        const btnGenererQR = document.querySelector('.btn-download.ajoutConge');
        const btnClose = document.querySelector('.icon-x');

        if (btnGenererQR && overlay && formQR && btnClose) {
            btnGenererQR.addEventListener('click', function (event) {
                event.preventDefault();
                overlay.classList.remove('hidden');
                formQR.classList.remove('hidden');
                document.querySelector('.form-conge').classList.add('active-poput');
            });

            overlay.addEventListener('click', function () {
                overlay.classList.add('hidden');
                formQR.classList.add('hidden');
                document.querySelector('.form-conge').classList.remove('active-poput');
            });

            // Fonction pour fermer le formulaire QR
            btnClose.addEventListener('click', function () {
                overlay.classList.add('hidden');
                formQR.classList.add('hidden');
                document.querySelector('.container-QR').classList.remove('active-poput');
            });

        } else {
            console.error('Un ou plusieurs éléments sont introuvables.');
        }
    });

    // ================= Pour la btn Modif =================
    document.addEventListener('DOMContentLoaded', function () {

        const overlay = document.querySelector('.overlay');
        const formQR = document.querySelector('.container-conge');
        const btnGenererQR = document.querySelector('.icon-modf-conge');
        const btnClose = document.querySelector('.icon-x');

        if (btnGenererQR && overlay && formQR && btnClose) {
            btnGenererQR.addEventListener('click', function (event) {
                event.preventDefault();
                overlay.classList.remove('hidden');
                formQR.classList.remove('hidden');
                document.querySelector('.form-conge').classList.add('active-poput');
            });

            overlay.addEventListener('click', function () {
                overlay.classList.add('hidden');
                formQR.classList.add('hidden');
                document.querySelector('.form-conge').classList.remove('active-poput');
            });

            // Fonction pour fermer le formulaire QR
            btnClose.addEventListener('click', function () {
                overlay.classList.add('hidden');
                formQR.classList.add('hidden');
                document.querySelector('.container-QR').classList.remove('active-poput');
            });

        } else {
            console.error('Un ou plusieurs éléments sont introuvables.');
        }
    });

</script>

