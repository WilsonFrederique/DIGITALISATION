@extends('baseUser')

@section('title', "PUBLICATION")

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

                <!-- ----- Add publication ----- -->
                <div class="white-post-container">
                    {{-- ----- Rappel Profil ------ --}}
                    <div class="user-profil">
                        @if(isset($employe))
                            @if(isset($imgProfil) && !empty($imgProfil->imgProfil))
                                <img src="{{ asset($imgProfil->imgProfil) }}" alt="Image de {{ $employe->Nom }}" style="max-width: 200px; max-height: 200px;">
                            @else
                                <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                            @endif
                            <div>
                                <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                <small>Public <i class="fa-solid fa-caret-down"></i></small>
                            </div>
                        @endif
                    </div>

                    <div class="post-input-container">

                        <form method="POST" action="{{ route('users.ajoutPublication') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($employe))
                                <input type="hidden" placeholder="Numéro CIN" name="numEmp" value="{{ $employe->numEmp }}" readonly>
                            @endif
                            <textarea name="txtPartage" rows="3" placeholder="Qu'est-ce que tu as en tête, Frédérique ?"></textarea>
                            <div class="add-post-links">
                                <style>
                                    label {
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                        cursor: pointer;
                                        text-decoration: none;
                                    }

                                    .inp {
                                        display: none;
                                    }

                                    .img {
                                        font-size: 24px;
                                        margin-right: 8px;
                                        color: #444;
                                        transition: 0.3s;
                                    }

                                    .img:hover {
                                        color: #007bff;
                                    }

                                    label .affich-text {
                                        color: #444;
                                        font-size: 12px;
                                        transition: 0.3s;
                                    }

                                    label:hover .affich-text {
                                        color: #007bff;
                                    }

                                    .input-file-et-btn{
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                        gap: 2rem;
                                    }
                                    .rappel-img-pub{
                                        width: 50px;
                                        height: 50px;
                                        /* border: 1px solid red; */
                                        border-radius: 5px;
                                    }
                                </style>
                                <div class="place-img-pub"></div>
                                <div class="input-file-et-btn">
                                    <label>
                                        <i class="fa-solid fa-camera img"></i> 
                                        <input class="inp" id="imgPartage" name="imgPartage" type="file" accept="image/*" onchange="previewImage(event)">
                                        <span class="affich-text">Veuillez cliquer ici pour choisir une image à publier</span>
                                    </label>
                                    <div class="rappel-img-pub">
                                        {{-- <img id="imgPreview" src="" alt="Aperçu de l'image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;"> --}}
                                    </div>
                                    <div class="btn-publie-maintenant">
                                        <button type="submit">Publier</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- ------- Publication ------- -->
                @foreach($publications as $publication)
                    <div class="post-container">
                        <div class="post-row">
                            <div class="user-profil">
                                @if($publication->imgProfil)
                                    <img src="{{ asset($publication->imgProfil) }}" alt="Image de profil">
                                @else
                                <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                                @endif
                                <div>
                                    <p>{{ $publication->Prenom }} {{ $publication->Nom }}</p>
                                    <!-- Formatage de la date created_at -->
                                    <small>{{ \Carbon\Carbon::parse($publication->created_at)->format('d F Y, H:i') }}</small>
                                </div>
                            </div>
                            <form onclick="supprimerLaPublication()">
                                <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                            </form>
                        </div>

                        @if($publication->txtPartage)
                            <p class="post-text">{{ $publication->txtPartage }}</p>
                        @endif

                        @if($publication->imgPartage)
                            <img src="{{ asset($publication->imgPartage) }}" class="post-img" alt="Image partagée">
                        @else
                            <p class="text-warning">Aucune image partagée.</p>
                        @endif

                        <div class="post-row">
                            <div class="activity-icons">
                                <div><i class='bx bxs-like' ></i> 120</div>
                            </div>
                            <div class="post-profile-icon">
                                <img src="{{ asset($publication->imgProfil ?? 'assets/images/userDefaut.png') }}">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- --- Image Fin Publication --- --}}
                <div class="post-container">
                    <img style="width: 100%;" src="{{ asset('assets/imagesPersonnel/pubFin.png') }}" alt="">
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

    <!-- ********* Footer ******** -->
    <div class="footer">
        <p>Droit d'auteur 2024 - GitHub : WILSONFREDERIQUE</p>
    </div>

@endsection