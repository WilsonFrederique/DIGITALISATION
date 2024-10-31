@extends('base')

@section('title', "AJOUT CONGES")

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
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Congé</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.permissions.index') }}">Page Congé</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="">Ajout Congé</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ********************* Formulaire ************************* -->
            <div class="table-date">
                <div class="todo">
                    <ul class="todo-list todo-color">
                        <div class="container-frm-empl-conge">
                            <header>INSCRIPTION</header>

                            <form method="POST" action="{{ $conge->exists ? route('admin.conges.update', $conge->id) : route('admin.conges.store') }}" class="login__form" enctype="multipart/form-data">
                                @csrf
                                @if ($conge->exists)
                                    @method('PUT')
                                @endif
                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title">Détails de l'identité</span>
                                        <div class="fields">
                                            <div class="input-field-div" style="display: none;">
                                                <label for="Personnel">Validation</label>
                                                <select name="Validation" id="Personnel" class="form-control">
                                                    <option value="En attente...">En attente...</option>
                                                    <option value="Acceptée">Acceptée</option>
                                                    <option value="Refusée">Refusée</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>CIN de l'expéditeur</label>
                                                <input name="numEmp" value="{{ $conge->numEmp }}" type="text" placeholder="CIN de l'expéditeur">
                                            </div>
                                            {{-- <div class="input-field-div">
                                                <label>Superviseur</label>
                                                <input name="numSup" value="{{ $conge->numSup }}" type="text" placeholder="Superviseur">
                                            </div> --}}
                                            <div class="input-field-div">
                                                <label for="numSup">Nom du Superviseur</label>
                                                <select name="numSup" id="numSup" class="form-control" required>
                                                    <option value="" disabled selected>Sélectionnez un Superviseur</option>
                                                    @foreach($superviseurs as $superviseur)
                                                        <option value="{{ $superviseur->numEmp }}" {{ $conge->numSup == $superviseur->numEmp ? 'selected' : '' }}>
                                                            {{ $superviseur->Nom }} {{ $superviseur->Prenom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="input-field-div">
                                                <label>Année</label>
                                                <input name="Annee" value="{{ $conge->Annee }}" type="text" placeholder="Année">
                                            </div> --}}
                                            <div class="input-field-div">
                                                <label for="annee">Année</label>
                                                <select name="Annee" id="annee" class="form-control">
                                                    @php
                                                        $currentYear = date('Y'); // Année actuelle
                                                        $selectedYear = $conge->Annee ?? $currentYear; // Année existante ou année actuelle par défaut
                                                    @endphp
                                                    @for ($year = 2017; $year <= 2050; $year++)
                                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                                            {{ $year }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            {{-- <div class="input-field-div">
                                                <label>Mois</label>
                                                <input name="Mois" value="{{ $conge->Mois }}" type="text" placeholder="Mois">
                                            </div> --}}
                                            <div class="input-field-div">
                                                <label for="Personnel">Mois</label>
                                                <select name="Mois" id="Personnel" class="form-control">
                                                    <option value="Janvier" {{ $conge->Mois == 'Janvier' ? 'selected' : '' }}>Janvier</option>
                                                    <option value="Février" {{ $conge->Mois == 'Février' ? 'selected' : '' }}>Février</option>
                                                    <option value="Mars" {{ $conge->Mois == 'Mars' ? 'selected' : '' }}>Mars</option>
                                                    <option value="Avril" {{ $conge->Mois == 'Avril' ? 'selected' : '' }}>Avril</option>
                                                    <option value="Mai" {{ $conge->Mois == 'Mai' ? 'selected' : '' }}>Mai</option>
                                                    <option value="Juin" {{ $conge->Mois == 'Juin' ? 'selected' : '' }}>Juin</option>
                                                    <option value="Juillet" {{ $conge->Mois == 'Juillet' ? 'selected' : '' }}>Juillet</option>
                                                    <option value="Août" {{ $conge->Mois == 'Août' ? 'selected' : '' }}>Août</option>
                                                    <option value="Septembre" {{ $conge->Mois == 'Septembre' ? 'selected' : '' }}>Septembre</option>
                                                    <option value="Octobre" {{ $conge->Mois == 'Octobre' ? 'selected' : '' }}>Octobre</option>
                                                    <option value="Novembre" {{ $conge->Mois == 'Novembre' ? 'selected' : '' }}>Novembre</option>
                                                    <option value="Décembre" {{ $conge->Mois == 'Décembre' ? 'selected' : '' }}>Décembre</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>Nom de l'Organisation</label>
                                                <input name="NomOrganisation" value="{{ $conge->NomOrganisation }}" type="text" placeholder="Nom de l'Organisation">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Fait le</label>
                                                <input name="FaiLe" value="{{ $conge->FaiLe }}" type="date" placeholder="Fait le">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Nombre de jours</label>
                                                <input name="NbrJours" min="1" value="{{ $conge->NbrJours }}" type="number" placeholder="Nombre de jours">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date début</label>
                                                <input name="DateDebut" value="{{ $conge->DateDebut }}" type="date" placeholder="Date de départ">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date fin</label>
                                                <input name="DateFin" value="{{ $conge->DateFin }}" type="date" placeholder="Date de retour">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details ID">                    
                                        <div class="fields">
                                            <div style="width: 100%;">
                                                <div class="input-field-div" style="width: 100%; margin-bottom: 1rem;">
                                                    <label>Motif</label>
                                                    <input name="Motif" value="{{ $conge->Motif }}" type="text" placeholder="Ex: Un voyage personnel, etc...">
                                                </div>
                                                <div class="input-field-div" style="width: 100%;">
                                                    <label>Descriptions</label>
                                                    <textarea name="Description" placeholder="Descriptions, ajouter des détails" id="">{{ $conge->Description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="nextBtn">
                                            @if ($conge->exists)
                                                <span class="btnText">MODIFIER</span>
                                                <i class='bx bx-edit' ></i>
                                            @else
                                                <span class="btnText">ENVOYER</span>
                                                <i class='bx bx-save' ></i>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </form>                            

                        </div>
                    </ul>
                </div>
            </div>

        </main>
    </section>

@endsection