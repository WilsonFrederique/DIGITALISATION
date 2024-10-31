@extends('base')

@section('title',  $permission->exists ? "MODIFICATION PERMISSION" : "AJOUT PERMISSION")

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
                            <a href="#">Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.permissions.index') }}">Page Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="">Ajout Permission</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ********************* Formulaire ************************* -->
            <div class="table-date">
                <div class="todo">
                    <ul class="todo-list todo-color">
                        <div class="container-frm-empl">
                            <header>INSCRIPTION</header>
                    
                            <form method="POST" action="{{ $permission->exists ? route('admin.perm.update', $permission->id) : route('admin.permissions.store') }}" class="login__form" enctype="multipart/form-data">
                                
                                @csrf

                                @if ($permission->exists)
                                    @method('PUT')
                                @endif
                                
                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title">Détails de l'identité</span>
                    
                                        <div class="fields">
                                            <div class="input-field-div" style="display: none;">
                                                <label for="Personnel">Sexe</label>
                                                <select name="Validation" id="Personnel" class="form-control">
                                                    <option value="En attente..." {{ $permission->Validation == 'En attente...' ? 'selected' : '' }}>En attente...</option>
                                                    <option value="Acceptée" {{ $permission->Validation == 'Acceptée' ? 'selected' : '' }}>Acceptée</option>
                                                    <option value="Refusée" {{ $permission->Validation == 'Refusée' ? 'selected' : '' }}>Refusée</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>CIN de l'expéditeur</label>
                                                <input name="numEmp" value="{{ $permission->numEmp }}" type="text" placeholder="CIN de l'expéditeur">
                                            </div>
                                            {{-- <div class="input-field-div">
                                                <label>CIN du Destinateur</label>
                                                <input name="numSup" value="{{ $permission->numSup }}" type="text" placeholder="CIN du Destinateur">
                                            </div> --}}
                                            <div class="input-field-div">
                                                <label for="numSup">Nom du Superviseur</label>
                                                <select name="numSup" id="numSup" class="form-control" required>
                                                    <option value="" disabled selected>Sélectionnez un Superviseur</option>
                                                    @foreach($superviseurs as $superviseur)
                                                        <option value="{{ $superviseur->numEmp }}" {{ $permission->numSup == $superviseur->numEmp ? 'selected' : '' }}>
                                                            {{ $superviseur->Nom }} {{ $superviseur->Prenom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="annee">Année</label>
                                                <select name="Annee" id="annee" class="form-control">
                                                    @php
                                                        $currentYear = date('Y'); // Année actuelle
                                                        $selectedYear = $permission->Annee ?? $currentYear; // Année existante ou année actuelle par défaut
                                                    @endphp
                                                    @for ($year = 2017; $year <= 2050; $year++)
                                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                                            {{ $year }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Mois</label>
                                                <select name="Mois" id="Personnel" class="form-control">
                                                    <option value="Janvier" {{ $permission->Mois == 'Janvier' ? 'selected' : '' }}>Janvier</option>
                                                    <option value="Février" {{ $permission->Mois == 'Février' ? 'selected' : '' }}>Février</option>
                                                    <option value="Mars" {{ $permission->Mois == 'Mars' ? 'selected' : '' }}>Mars</option>
                                                    <option value="Avril" {{ $permission->Mois == 'Avril' ? 'selected' : '' }}>Avril</option>
                                                    <option value="Mai" {{ $permission->Mois == 'Mai' ? 'selected' : '' }}>Mai</option>
                                                    <option value="Juin" {{ $permission->Mois == 'Juin' ? 'selected' : '' }}>Juin</option>
                                                    <option value="Juillet" {{ $permission->Mois == 'Juillet' ? 'selected' : '' }}>Juillet</option>
                                                    <option value="Août" {{ $permission->Mois == 'Août' ? 'selected' : '' }}>Août</option>
                                                    <option value="Septembre" {{ $permission->Mois == 'Septembre' ? 'selected' : '' }}>Septembre</option>
                                                    <option value="Octobre" {{ $permission->Mois == 'Octobre' ? 'selected' : '' }}>Octobre</option>
                                                    <option value="Novembre" {{ $permission->Mois == 'Novembre' ? 'selected' : '' }}>Novembre</option>
                                                    <option value="Décembre" {{ $permission->Mois == 'Décembre' ? 'selected' : '' }}>Décembre</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>Fait le</label>
                                                <input name="FaiLe" value="{{ $permission->FaiLe }}" type="date" placeholder="Fait le">
                                                @if ($errors->has('FaiLe'))
                                                    <span style="font-size: 0.6rem; color: rgb(255, 104, 104); font-weight: 400;" class="text-danger">{{ $errors->first('FaiLe') }}</span> 
                                                @endif
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de départ</label>
                                                <input name="DateDebut" value="{{ $permission->DateDebut }}" type="date" placeholder="Date de départ">
                                                @if ($errors->has('DateDebut'))
                                                    <span style="font-size: 0.6rem; color: rgb(255, 104, 104); font-weight: 400;" class="text-danger">{{ $errors->first('DateDebut') }}</span> 
                                                @endif
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de retour</label>
                                                <input name="DateFin" value="{{ $permission->DateFin }}" type="date" placeholder="Date de retour">
                                                @if ($errors->has('DateFin'))
                                                    <span style="font-size: 0.6rem; color: rgb(255, 104, 104); font-weight: 400;" class="text-danger">{{ $errors->first('DateFin') }}</span> 
                                                @endif
                                            </div>
                                            <div class="input-field-div">
                                                <label>Nom de l'Organisation</label>
                                                <input name="NomOrganisation" value="{{ $permission->NomOrganisation }}" type="text" placeholder="Nom de l'Organisation">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="details ID">                    
                                        <div class="fields">
                                            <div style="width: 100%;">
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
                    
                                        <button type="submit" class="nextBtn">
                                            @if ($permission->exists)
                                                <span class="btnText">MODIFIER</span>
                                                <i class='bx bx-edit' ></i>
                                            @else
                                                <span class="btnText">ENVOYER</span>
                                                <i class='bx bx-send' ></i>
                                            @endif
                                        </button>

                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </ul>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div> 
            @endif

        </main>
    </section>

@endsection
