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
                {{-- <a href="#"><img src="{{ asset('assets/imagesPersonnel/pub1.png') }}" alt=""><span style="display: none">Web Developers</span></a> --}}
                @foreach($pubRacours as $publication)
                    @if($publication->imgPartage)
                        <img src="{{ asset($publication->imgPartage) }}" class="post-img" alt="Image partagée">
                    @else
                        <p class="no-image-text">Vide</p>
                    @endif
                @endforeach
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
                            <img src="{{ asset('assets/imagesPersonnel/congeUser.png') }}" alt="">
                        </div>
                        <span style="border-bottom: 1px solid #888; width: 100%; margin-bottom: 1rem;"></span>
                    </div>
                    
                </div>

                <!-- ----- Permission FRM ----- -->
                <div class="white-post-container">

                    <div id="frmPermission" class="post-input-container">
                        {{-- ================ Formulaire Permission =================== --}}
                        <div class="container-frm-rps">
                    
                            <form method="POST" action="{{ route('users.reponseConges.update', ['id' => $conge->id]) }}">

                                @csrf

                                @if ($conge->exists)
                                    @method('PUT')
                                @endif

                                <div class="form first" style="width: 100%; height: 40px; border-radius: 7px; padding: 0.4rem;">
                                    <div class="details personal" style="width: 100%;">
                                        <span class="title">VALIDATION DES CONGES</span>
                    
                                        <div class="fields">
                                            <div style="display: none">
                                                <div class="input-field">
                                                    <label>CIN de l'expéditeur</label>
                                                    <input name="numEmp" value="{{ $conge->numEmp }}" type="text" placeholder="CIN de l'expéditeur">
                                                </div>
                                                <div class="input-field">
                                                    <label>Nom de l'approbateur</label>
                                                    <input name="numSup" value="{{ $conge->numSup }}" type="text" placeholder="Nom de l'approbateur">
                                                </div>
                                                <div class="input-field">
                                                    <label>Année</label>
                                                    <input name="Annee" value="{{ $conge->Annee }}" type="text" placeholder="Année">
                                                </div>
                                                <div class="input-field">
                                                    <label>Mois</label>
                                                    <input name="Mois" value="{{ $conge->Mois }}" type="text" placeholder="Mois">
                                                </div>
                                                <div class="input-field">
                                                    <label>Nom de l'Organisation</label>
                                                    <input name="NomOrganisation" value="{{ $conge->NomOrganisation }}" type="text" placeholder="Nom de l'Organisation">
                                                </div>
                                                <div class="input-field">
                                                    <label>Fait le</label>
                                                    <input name="FaiLe" value="{{ $conge->FaiLe }}" type="date" placeholder="Début de congé">
                                                </div>
                                                <div class="input-field">
                                                    <label>Nombre de jours</label>
                                                    <input name="NbrJours" value="{{ $conge->NbrJours }}" type="number" placeholder="Nombre de jours">
                                                </div>
                                                <div class="input-field">
                                                    <label>Début de congé</label>
                                                    <input name="DateDebut" value="{{ $conge->DateDebut }}" type="date" placeholder="Début de congé">
                                                </div>
                                                <div class="input-field">
                                                    <label>Fin de congé</label>
                                                    <input name="DateFin" value="{{ $conge->DateFin }}" type="date" placeholder="Fin de congé">
                                                </div>
                                                <div style="width: 100%; height: 100px;" class="input-field">
                                                    <label>Motif</label>
                                                    <textarea name="Motif" placeholder="Motif si nécessaire" id="">{{ $conge->Motif }}</textarea>
                                                </div>
                                                <div style="width: 100%; height: 100px;" class="input-field">
                                                    <label>Descriptions</label>
                                                    <textarea name="Description" placeholder="Descriptions si nécessaire" id="">{{ $conge->Description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="input-field-div" style="width: 100%; height: 40px; border-radius: 7px; padding: 0.4rem;">
                                                <select name="Validation" id="Personnel" class="form-control" style="width: 100%; height: 40px; border-radius: 7px; padding: 0.4rem;">
                                                    <option value="En attente..." {{ $conge->Validation == 'En attente...' ? 'selected' : '' }}>En attente...</option>
                                                    <option value="Acceptée" {{ $conge->Validation == 'Acceptée' ? 'selected' : '' }}>Acceptée</option>
                                                    <option value="Refusée" {{ $conge->Validation == 'Refusée' ? 'selected' : '' }}>Refusée</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="nextBtn" style="height: 40px; width: 100%;">
                                        <span class="btnText">ENVOYER</span>
                                        <i class='bx bx-send' ></i>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- ------- Permission ------- -->
                {{-- --- Image Fin Permission --- --}}
                <div class="post-container">
                    <img style="width: 100%;" src="{{ asset('assets/imagesPersonnel/congeUser.png') }}" alt="">
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