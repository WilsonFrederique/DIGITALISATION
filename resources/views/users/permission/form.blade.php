@extends('baseUser')

@section('title', "Veuillez donner votre réponse")

@section('containerUser')

    <div class="container">
        <!-- ============= Left sidbar ============= -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a href="{{ route('users.indexPub') }}"><i class='bx bx-news img'></i><span>Dernières nouvelles</span></a>
                <a href="{{ route('users.indexLesEmployes') }}"><i class='bx bx-group img'></i><span>Employés</span></a>
                <a href="{{ route('users.indexPermissions') }}"><i class='bx bxs-hand img'></i><span>Permission</span></a>
                <a href="{{ route('users.indexMissions') }}"><i class='bx bxs-briefcase-alt-2 img'></i><span>Mission</span></a>
                <a href="{{ route('users.indexConges') }}"><i class='bx bx-pause-circle img'></i><span>Congé</span></a>
                <a href="#"><span>Voir plus</span></a>
            </div>
            <div class="shortcut-links">
                <p>Vos raccourcis</p>
                <a href="#"><img src="{{ asset('assets/imagesPersonnel/pub1.png') }}" alt=""><span style="display: none">Web Developers</span></a>
            </div>
        </div>

        {{-- ========= Content et Right =========== --}}
        <div class="ens-cont-et-right">
            <!-- ============= Main content ============ -->
            <div class="main-content">

                {{-- ------------ Affichage Message ------------------- --}}
                <div style="margin-bottom: 0.4rem;" class="white-post-container">
                    {{-- En tête --}}
                    <div class="user-profil title-permission">
                        <div class="txt-titre-img">
                            <p style="font-size: 1.5rem;">Veuillez donner votre réponse</p>
                            <img src="{{ asset('assets/imagesPersonnel/chatPermission.png') }}" alt="">
                        </div>
                        <span style="border-bottom: 1px solid #888; width: 100%; margin-bottom: 1rem;"></span>
                    </div>
                    
                </div>

                <!-- ----- Permission FRM ----- -->
                <div class="white-post-container">

                    <div id="frmPermission" class="post-input-container">
                        {{-- ================ Formulaire Permission =================== --}}
                        <div class="container-frm-rps">
                    
                            <form method="POST" action="{{ route('users.reponsePermission.update', $permission->id) }}">

                                @csrf

                                @if ($permission->exists)
                                    @method('PUT')
                                @endif

                                <div class="form first" style="width: 100%;">
                                    <div class="details personal" style="display: none;">
                                        <span class="title">EXPÉDITEUR</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>CIN de l'expéditeur</label>
                                                <input name="numEmp" value="{{ $permission->numEmp }}" type="text" placeholder="CIN de l'expéditeur">
                                            </div>
                                            <div class="input-field">
                                                <label>Sélectionner votre superviseur</label>
                                                <input name="numSup" value="{{ $permission->numSup }}" type="text" placeholder="CIN de superviseur">
                                            </div>
                                            <div class="input-field">
                                                <label>Année</label>
                                                <input name="Annee" value="{{ $permission->Annee }}" type="text" placeholder="Année">
                                            </div>
                                            <div class="input-field">
                                                <label>Mois</label>
                                                <input name="Mois" value="{{ $permission->Mois }}" type="text" placeholder="Mois">
                                            </div>
                                            <div class="input-field">
                                                <label>Fait le</label>
                                                <input name="FaiLe" value="{{ $permission->FaiLe }}" type="date" placeholder="Fait le">
                                            </div>
                                            <div class="input-field">
                                                <label>Date de début</label>
                                                <input name="DateDebut" value="{{ $permission->DateDebut }}" type="date" placeholder="Fait le">
                                            </div>
                                            <div class="input-field">
                                                <label>Date de fin</label>
                                                <input name="DateFin" value="{{ $permission->DateFin }}" type="date" placeholder="Fait le">
                                            </div>
                                            <div class="fields">
                                                <div class="input-field">
                                                    <label>Raison</label>
                                                    <input name="Raison" value="{{ $permission->Raison }}" type="text" placeholder="Ex : Un voyage personnel, etc...">
                                                </div>
                                                <div class="input-field">
                                                    <label>Nom de l'Organisation</label>
                                                    <input name="NomOrganisation" value="{{ $permission->NomOrganisation }}" type="text" placeholder="Nom de l'Organisation">
                                                </div>
                                                <div class="input-field">
                                                    <label>Engagement</label>
                                                    <textarea name="Engagement" placeholder="Mentionner ce que vous ferez pour compenser votre absence, si applicable" id="">{{ $permission->Engagement }}</textarea>
                                                </div>
                        
                                                <div class="input-field">
                                                    <label>Dispositions</label>
                                                    <textarea name="Dispositions" placeholder="Dispositions, ajouter des détails ( Exemple: J'ai informé mes collègues et préparé le travail en avance. )" id="">{{ $permission->Dispositions }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="details ID" style="width: 100%;">
                                        <span class="title">VALIDATION DES PERMISSIONS</span>
                    
                                        <div class="input-field-div" style="width: 100%;">
                                            <select name="Validation" id="Personnel" class="form-control" style="width: 100%; height: 45px; padding: 0.5rem; border-radius: 7px; outline: 0;">
                                                <option value="En attente..." {{ $permission->Validation == 'En attente...' ? 'selected' : '' }}>En attente...</option>
                                                <option value="Acceptée" {{ $permission->Validation == 'Acceptée' ? 'selected' : '' }}>Acceptée</option>
                                                <option value="Refusée" {{ $permission->Validation == 'Refusée' ? 'selected' : '' }}>Refusée</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="nextBtn">
                                        <span class="btnText">ENVOYER</span>
                                        <i class='bx bx-send'></i>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- ------- Permission ------- -->
                {{-- --- Image Fin Permission --- --}}
                <div class="post-container">
                    <img style="width: 100%;" src="{{ asset('assets/imagesPersonnel/chatPermission.png') }}" alt="">
                </div>

                <button type="button" class="load-more-btn">Charger plus</button>
            </div>

            <!-- ============= Right sidbar ============= -->
            <div class="right-sidebar">
                {{-- ------------ Evenement ------------ --}}
                <div class="sidebar-title">
                    <h4>Evenements</h4>
                    <div>
                        <a href="#">Voir tout</a>
                    </div>
                </div>

                <div class="event" data-date="18 Septembre" data-title="Social Media" data-location="Wilson Frederique">
                    <div class="left-event">
                        <h3>18</h3>
                        <span>Septembre</span>
                    </div>
                    <div class="right-event">
                        <h4>Social Media</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Wilson Frederique</p>
                        <div onclick="infoEvenements(this)">
                            <a href="#">Plus d'informations</a>
                        </div>
                    </div>
                </div>

                <div class="event" data-date="19 Septembre" data-title="Social Media" data-location="Wilson Frederique">
                    <div class="left-event">
                        <h3>19</h3>
                        <span>Septembre</span>
                    </div>
                    <div class="right-event">
                        <h4>Social Media</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Maher Zoh</p>
                        <div onclick="infoEvenements(this)">
                            <a href="#">Plus d'informations</a>
                        </div>
                    </div>
                </div>
                
                <div class="event" data-date="22 Octobre" data-title="Mobile Marketing" data-location="Somal Zaid">
                    <div class="left-event">
                        <h3>22</h3>
                        <span>Octobre</span>
                    </div>
                    <div class="right-event">
                        <h4>Mobile Marketing</h4>
                        <p><i class="fa-solid fa-location-dot"></i> Somal Zaid</p>
                        <div onclick="infoEvenements(this)">
                            <a href="#">Plus d'informations</a>
                        </div>
                    </div>
                </div>

                {{-- ------------- Publicité ------------ --}}
                <div class="sidebar-title">
                    <h4>Publicité</h4>
                    <a href="#">Fermer</a>
                </div>
                
                <img src="{{ asset('assets/imagesPersonnel/publicite.jpg') }}" class="sidebar-ads">

                {{-- --------- Les employes ------------- --}}
                <div class="sidebar-title">
                    <h4>Conversation</h4>
                    <a href="#">Cacher le chat</a>
                </div>

                @foreach ($ToutEmployes as $ToutEmploye)
                    <div class="online-list">
                        <div class="online">
                            {{-- Vérifier si l'employé a une image de profil --}}
                            @if ($ToutEmploye->imgProfil)
                                <img src="{{ asset($ToutEmploye->imgProfil) }}" alt="Image de profil">
                            @else
                                <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                            @endif
                        </div>
                        <p>{{ $ToutEmploye->Nom }} {{ $ToutEmploye->Prenom }}</p>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>

@endsection