@extends('base')

@section('title', "Veuillez répondre")

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
                        <a href="#">
                            <div>
                                <p>Permission</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                        {{-- Congé --}}
                        <a href="#">
                            <div>
                                <p>Congé</p>
                                <div>
                                    <span>0</span>
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
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.permissions.index') }}">Page Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="">Validation</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ********************* Formulaire ************************* -->
            <div class="table-date">
                <div class="todo">
                    <ul class="todo-list todo-color">
                        <div class="container-frm-perm">
                            <header><span style="color: #333; font-weight: 400;">Demande de permission pour</span> {{ $employe->Nom }} {{ $employe->Prenom }}</header>

                            <div class="cont-info-icon">
                                <div class="info-person-permission" style="color: #111; display: flex; align-items: center; gap: 1rem; align-items: flex-start;">
                                    <div class="img-per" style="margin-top: 2rem;">
                                        @php
                                            $image = $latestImages->firstWhere('numEmp', $employe->numEmp);
                                        @endphp
                                        @if($image)
                                            <img style="width: 170px; height: 170px; border-radius: 10%;" class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                        @else
                                            <i class='bx bx-user' style="font-size: 10rem;"></i>
                                        @endif
                                    </div>
                                    <div class="txt-pour-ce-pers" style="margin-top: 2.5rem; font-size: 0.85rem;">
                                        <p><span>Nom et Prenom :</span> {{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                        <p><span>Grade : </span> {{ $employe->Grade }}</p>
                                        <p><span>Service : </span> {{ $employe->Service }}</p>
                                        <p><span>Objectif : </span> Lettre de permission</p>
                                        <p><span>Date debut : </span> {{ \Carbon\Carbon::parse($permission->DateDebut)->translatedFormat('d F Y') }}</p>
                                        <p><span>Date fin : </span> {{ \Carbon\Carbon::parse($permission->DateFin)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ $permission->exists ? route('admin.valid.update', $permission->id) : route('admin.permissions.store') }}" class="login__form" enctype="multipart/form-data">
                                
                                @csrf

                                @if ($permission->exists)
                                    @method('PUT')
                                @endif
                                
                                <div class="form first">
                                    
                                    <div class="details personal" style="width: 100%;">
                                        <span class="title">Veuillez répondre</span>
                    
                                        <div class="fields">
                                            <div class="input-field-div" style="width: 100%;">
                                                <select name="Validation" id="Personnel" class="form-control" style="width: 100%;">
                                                    <option value="En attente..." {{ $permission->Validation == 'En attente...' ? 'selected' : '' }}>En attente...</option>
                                                    <option value="Acceptée" {{ $permission->Validation == 'Acceptée' ? 'selected' : '' }}>Acceptée</option>
                                                    <option value="Refusée" {{ $permission->Validation == 'Refusée' ? 'selected' : '' }}>Refusée</option>
                                                </select>
                                            </div>
                                            <div style="display: none">
                                                <div class="input-field-div">
                                                    <label>CIN de l'expéditeur</label>
                                                    <input name="numEmp" value="{{ $permission->numEmp }}" type="text" placeholder="CIN de l'expéditeur">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>CIN du Destinateur</label>
                                                    <input name="numSup" value="{{ $permission->numSup }}" type="text" placeholder="CIN du Destinateur">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>Année</label>
                                                    <input name="Annee" value="{{ $permission->Annee }}" type="text" placeholder="Année">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>Mois</label>
                                                    <input name="Mois" value="{{ $permission->Mois }}" type="text" placeholder="Mois">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>Fait le</label>
                                                    <input name="FaiLe" value="{{ $permission->FaiLe }}" type="date" placeholder="Fait le">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>Date de départ</label>
                                                    <input name="DateDebut" value="{{ $permission->DateDebut }}" type="date" placeholder="Date de départ">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>Date de retour</label>
                                                    <input name="DateFin" value="{{ $permission->DateFin }}" type="date" placeholder="Date de retour">
                                                </div>
                                                <div class="input-field-div">
                                                    <label>Nom de l'Organisation</label>
                                                    <input name="NomOrganisation" value="{{ $permission->NomOrganisation }}" type="text" placeholder="Nom de l'Organisation">
                                                </div>
                                                <div class="input-field-div" style="width: 100%; margin-bottom: 1rem;">
                                                    <label>Raison</label>
                                                    <input name="Raison" value="{{ $permission->Raison }}" type="text" placeholder="Ex: Un voyage personnel, etc...">
                                                </div>
                                                <div class="input-field-div" style="width: 100%; margin-bottom: 1rem;">
                                                    <label>Engagement</label>
                                                    <textarea name="Engagement" placeholder="Mentionner ce que vous ferez pour compenser votre absence, si applicable" id="">{{ $permission->Engagement }}</textarea>
                                                </div>
                                                <div class="input-field-div" style="width: 100%; margin-bottom: 1rem;">
                                                    <label>Dispositions</label>
                                                    <textarea name="Dispositions" placeholder="Dispositions, ajouter des détails ( Exemple: J'ai informé mes collègues et préparé le travail en avance. )" id="">{{ $permission->Dispositions }}</textarea>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="nextBtn" style="margin-top: 2.8rem;">
                                        <span class="btnText">ENVOYER</span>
                                        <i class='bx bx-send' ></i>
                                    </button>

                                </div>
                            </form>  
                            
                            <style>
                                form .first{
                                    display: flex; 
                                    align-items: center; 
                                    width: 100%; gap: 2rem; 
                                    align-items: flex-start;
                                }

                                .cont-info-icon{
                                    display: flex;
                                    align-items: center;
                                    justify-content: space-between;
                                }
                            </style>

                            <div class="img-style">
                                <img style="width: 100%;" src="{{ asset('assets/images/sendParDeafaut.png') }}" alt="">
                            </div>

                        </div>
                    </ul>
                </div>
            </div>

        </main>
    </section>

@endsection
