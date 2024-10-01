@extends('base')

@section('title', "PAGE PERMISSION")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>PERMISSION</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="">Page Permission</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="#" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                    <a href="#" class="btn-download btn-permission">
                        <i class='bx bx-plus-medical'></i>
                        <span class="text">Nouveau Permission</span>
                    </a>
                </div>
            </div>

            <!-- ********************* Table ************************* -->

            <div class="table-date">
                <div class="todo">
                    <div class="head">
                        <h3>EMPLOYÉS QUI ONT PRIS DES PERMISSIONS</h3>
                        <i class='bx bx-plus icon-tbl icon-btn-plus' ></i>
                        <i class='bx bx-filter icon-tbl'></i>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employes as $employe)
                            <li class="permission">
                                <div class="todo-item">
                                    <img class="imgTodo" src="{{ asset($employe->images) }}" alt="">
                                    <div class="txt-left">
                                        <p id="p">{{ $employe->numEmp }}</p>
                                        <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>

                                        @foreach ($employe->permissions as $permission)
                                            <p class="date-permission">{{ $permission->FaiLe }}</p>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr">
                                        <a href=""><i class='bx bx-printer' style='color:#228e8a'  ></i></a>
                                        <a href=""><i class='bx bx-detail' style='color:#1f2dad'  ></i></a>
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}"><i class='bx bx-edit' style='color:#0a6202'  ></i></a>
                                        {{-- <a href=""><i class='bx bx-trash' style='color:#d01616'  ></i></a> --}}
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
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
                        {{-- <li class="">
                            <div class="box-permission">
                                <div class="lettre">

                                    <div class="en-tete">
                                        <div class="votre">
                                            <p>Votre Nom</p>
                                            <p>Votre Adresse</p>
                                            <p>Code Postal, Ville</p>
                                            <p>Adresse Email</p>
                                            <p>Numéro de Téléphone</p>
                                        </div>
                                        <div class="destination">
                                            <p>À l'attention de</p>
                                            <p>Nom du Responsable</p>
                                            <p>Poste du Responsable</p>
                                            <p>Nom de l'Organisation</p>
                                            <p>Adresse de l'Organisation</p>
                                            <p>Code Postal, Ville</p>
                                        </div>
                                    </div>

                                    <div class="date">
                                        <p>Date</p>
                                    </div>

                                    <div class="date-objectif">
                                        <div class="line-Mm-Mr-p"></div>

                                        <div class="objet-lettre">
                                            <p>Objet : Demande de permission pour [préciser le motif]</p>
                                        </div>

                                        <div class="line-Mm-Mr-p"></div>

                                        <div class="Mm-Mr">
                                            <p>Madame, Monsieur,</p>
                                        </div>
                                    </div>

                                    <div class="line-Mm-Mr-p"></div>

                                    <div class="prgph">
                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> me permets de vous adresser cette lettre pour solliciter une
                                            permission exceptionnelle pour ........Raison.......</p>
                                        </div>

                                        <div class="line-p"></div>

                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> souhaiterais obtenir cette permission pour la période allant du [Date de début]
                                            au [Date de fin]. Pendant cette période, je m'engage à [Mentionner ce que vous ferez pour compenser
                                            votre absence, si applicable].</p>
                                        </div>

                                        <div class="line-p"></div>

                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> vous assure que j'ai pris toutes les dispositions nécessaires pour que mes
                                            responsabilités soient couvertes durant mon absence. [Dispositions, ajouter des détails (Ex: J'ai informé mes
                                            collègues et préparé le travail en avance.)]</p>
                                        </div>

                                        <div class="line-p"></div>

                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> reste à votre disposition pour toute information complémentaire
                                                 ou tout document nécessaire pour appuyer ma demande. Vous pouvez me contacter [Téléphone] ou
                                                [Adresse email].</p>
                                        </div>

                                        <div class="line-p"></div>

                                        <div class="pr1">
                                            <p class="pr"><span>En</span> vous remerciant de votre compréhension et de votre soutien, je
                                                vous prie d’agréer, Madame, Monsieur, l’expression de mes salutations distinguées.</p>
                                        </div>
                                    </div>


                                    <div class="signature">
                                        <div></div>
                                        <div id="signature">
                                            <div class="line-h"></div>
                                            [Signature] <br>
                                            [Nom de l'expéditeur]
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>


            <!-- *********************** FORMULAIRE ************************ -->

            <div class="overlay hidden"></div>
            <div class="container-conge hidden">
                <div class="form-conge">
                    <form method="POST" action="{{ route('admin.permissions.store') }}">
                        <p class="p-x"><i class='bx bx-x icon-x'></i></p>

                        @csrf


                        <div class="frm1">
                            <div class="input1">
                                {{-- <p>CIN de l'expéditeur</p>
                                <select class="form-control" id="numEmp" name="numEmp">
                                    @foreach($employes as $employe)
                                        <option value="{{ $employe->numEmp }}" {{ $employe->numEmp == $permission->numEmp ? 'selected' : '' }}>
                                            {{ $employe->numEmp }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <p>CIN de l'expéditeur</p>
                                <input type="text" name="numEmp" placeholder="CIN de l'expéditeur" id="vid1">
                            </div>
                            <div class="input1">
                                <p>Nom du Destinateur</p>
                                <input type="text" name="NomPrenomDestinateur" placeholder="Nom du Destinateur" id="vid2">
                            </div>
                            <div class="input1">
                                <p>Poste du Destinateur</p>
                                <input type="text" name="PosteDestinateur" placeholder="Poste du Destinateur" id="vid3">
                            </div>
                        </div>
                        <div class="frm1">
                            <div class="input1">
                                <p>Fait le</p>
                                <input type="date" name="FaiLe" placeholder="Fait le" id="vid4">
                            </div>
                            <div class="input1">
                                <p>Date de début</p>
                                <input type="date" name="DateDebut" placeholder="Date de début" id="vid5">
                            </div>
                            <div class="input1">
                                <p>Date de fin</p>
                                <input type="date" name="DateFin" placeholder="Date de fin" id="vid6">
                            </div>
                        </div>
                        <div class="raison-nomEntreprise">
                            <div class="input1 deux-input">
                                <p>Raison</p>
                                <input type="text" name="Raison" placeholder="Ex : Un voyage personnel, etc..." id="vid7">
                            </div>
                            <div class="input1 deux-input">
                                <p>Nom de l'Organisation</p>
                                <input type="text" name="NomOrganisation" placeholder="Nom de l'Organisation" id="vid7">
                            </div>
                        </div>
                        <div class="frm1">
                            <div class="input1">
                                <p>Engagement</p>
                                <textarea name="Engagement" placeholder="Mentionner ce que vous ferez pour compenser votre absence, si applicable" cols="30" rows="10" id="vid8"></textarea>
                            </div>
                            <div class="input1">
                                <p>Dispositions</p>
                                <textarea name="Dispositions" placeholder="Dispositions, ajouter des détails ( Exemple: J'ai informé mes collègues et préparé le travail en avance. )" cols="30" rows="10" id="vid9"></textarea>
                            </div>
                        </div>

                        <button type="submit" onclick="genererQR()">ENREGISTRER</button>
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

    .raison-nomEntreprise{
        display: flex;
        justify-content: center;
        gap: 15px
    }

    .deux-input{
        width: 100%;
    }

    .form-conge textarea {
        width: 100%;
        height: 120px;
        border: 1px solid #494eea;
        outline: 0;
        padding: 10px;
        margin: 10px 0 20px;
        border-radius: 5px;
    }

    .form-conge{
        width: 540px;
        padding: 30px 35px 10px;
        position: absolute;
        top: 54%;
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
        font-size: 13px;
        margin-bottom: 3px;
        color: var(--txt-header-input-qr);
    }

    .form-conge input{
        width: 100%;
        height: 40px;
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

{{-- ---------------------------- Css pour lettre de permission ---------------------- --}}
{{-- <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        background: #e7e6e6;
    }
    .container-permission{
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 100;
    }

    .box-permission{
        width: 90%;
        height: auto;
        padding: 30px 35px 50px 40px;
        margin: 10px;
        background: #fff;
    }

    .en-tete{
        display: flex;
        justify-content: space-between;
        line-height: 1.5;
    }

    .date{
        display: flex;
        align-items: center;
    }

    .date-objectif{
        font-size: 20px;
        line-height: 2;
        margin-left: 10%;
    }

    span{
        margin-left: 10%;
    }

    .entre-obje-Mm-Mr{
        line-height: 0;
    }

    .pr{
        line-height: 1.4;
    }

    .prgph{
        font-size: 20px;
        line-height: 1;
    }

    .signature{
        line-height: 7;
        position: relative;
        margin: 10px;
        display: flex;
        justify-content: space-between;
    }

    #signature{
        line-height: 1.5;
    }

    p{
        font-size: 19px;
    }

    .line-h{
        margin-top: 20%;
    }

    .line-p{
        margin-top: 2%;
    }

    .line-Mm-Mr-p{
        margin-top: 3.5%;
    }
</style> --}}

{{-- ---------------------- Scrip pour visible ou invisible -------------------------- --}}
<script>

    // ================= Pour la btn Ajout =================
    document.addEventListener('DOMContentLoaded', function () {

        const overlay = document.querySelector('.overlay');
        const formQR = document.querySelector('.container-conge');
        const btnGenererQR = document.querySelector('.btn-download.btn-permission');
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

    // ================= Pour la btn icon Plus =================
    document.addEventListener('DOMContentLoaded', function () {

        const overlay = document.querySelector('.overlay');
        const formQR = document.querySelector('.container-conge');
        const btnGenererQR = document.querySelector('.icon-btn-plus');
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


    // ================= Pour la btn icon Modif =================
    // document.addEventListener('DOMContentLoaded', function () {

    //     const overlay = document.querySelector('.overlay');
    //     const formQR = document.querySelector('.container-conge');
    //     const btnGenererQR = document.querySelector('.btn-icon-modf');
    //     const btnClose = document.querySelector('.icon-x');

    //     if (btnGenererQR && overlay && formQR && btnClose) {
    //         btnGenererQR.addEventListener('click', function (event) {
    //             event.preventDefault();
    //             overlay.classList.remove('hidden');
    //             formQR.classList.remove('hidden');
    //             document.querySelector('.form-conge').classList.add('active-poput');
    //         });

    //         overlay.addEventListener('click', function () {
    //             overlay.classList.add('hidden');
    //             formQR.classList.add('hidden');
    //             document.querySelector('.form-conge').classList.remove('active-poput');
    //         });

    //         // Fonction pour fermer le formulaire QR
    //         btnClose.addEventListener('click', function () {
    //             overlay.classList.add('hidden');
    //             formQR.classList.add('hidden');
    //             document.querySelector('.container-QR').classList.remove('active-poput');
    //         });

    //     } else {
    //         console.error('Un ou plusieurs éléments sont introuvables.');
    //     }
    // });

    // document.addEventListener('DOMContentLoaded', function () {
    //     const overlay = document.querySelector('.overlay');
    //     const formQR = document.querySelector('.container-conge');
    //     const btnClose = document.querySelector('.icon-x');

    //     // Écouteur d'événements pour tous les boutons d'édition
    //     document.addEventListener('click', function (event) {
    //         if (event.target.closest('.btn-icon-modf')) {
    //             event.preventDefault();
    //             overlay.classList.remove('hidden');
    //             formQR.classList.remove('hidden');
    //             document.querySelector('.form-conge').classList.add('active-poput');
    //         }
    //     });

    //     if (overlay && formQR && btnClose) {
    //         overlay.addEventListener('click', function () {
    //             overlay.classList.add('hidden');
    //             formQR.classList.add('hidden');
    //             document.querySelector('.form-conge').classList.remove('active-poput');
    //         });

    //         // Fonction pour fermer le formulaire QR
    //         btnClose.addEventListener('click', function () {
    //             overlay.classList.add('hidden');
    //             formQR.classList.add('hidden');
    //             document.querySelector('.container-QR').classList.remove('active-poput');
    //         });
    //     } else {
    //         console.error('Un ou plusieurs éléments sont introuvables.');
    //     }
    // });


</script>
