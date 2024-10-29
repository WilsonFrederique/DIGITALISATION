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

        </main>
    </section>

@endsection
