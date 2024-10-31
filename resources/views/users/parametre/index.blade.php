@extends('baseUser')

@section('title', "PARAMETRES")

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

        {{-- =========== Content et Right ========== --}}
        <div class="ens-cont-et-right">
            <!-- ============= Main content ============ -->
            <div class="main-content">

                <!-- ----- Paramètres----- -->
                <div class="white-post-container">
                    <div class="user-profil prfl-catpure-dossie">
                        @if(isset($employe))
                        {{-- ------ Profil ----- --}}
                            <div class="prfl">
                                @if(isset($imgProfil) && !empty($imgProfil->imgProfil))
                                    <img id="preview-image" src="{{ asset($imgProfil->imgProfil) }}" alt="Image de profil" style="width: 50px; height: 50px; border-radius: 50%;">
                                    @else
                                    <div id="preview-image">
                                        <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                                    </div>
                                @endif
                                <div>
                                    <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                    <small>Public <i class="fa-solid fa-caret-down"></i></small>
                                </div>
                            </div>
                            {{-- ------- Form ------- --}}
                            <form action="{{ route('users.users.storeAjoutProfil') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="icon-captr-dossie-save-right">
                            
                                    @if(isset($employe))
                                        <input type="hidden" name="numEmp" value="{{ $employe->numEmp }}" readonly>
                                    @endif
                            
                                    <div class="ens-img-btn">
                                        <div class="rappel-img">
                                            <img id="photoElement" style="display: none;">
                                            <canvas id="canvasElement" style="display: none;"></canvas>
                                        </div>
                                        <div id="btn">
                                            <div class="esn">
                                                <div class="capture-dossie">
                                                    {{-- ---------- Dossier Folder ----------- --}}
                                                    <label for="file-upload" class="custom-file-upload">
                                                        <i style="font-size: 1.2rem;" class="fa-regular fa-image"></i>
                                                        <input name="imgProfil" id="file-upload" type="file" accept="image/*" onchange="previewImage(event)" required />
                                                    </label>
                                                    {{-- ---------- Camera Photo ------------ --}}
                                                    <i style="font-size: 1.2rem;" id="startButton" class="fa-solid fa-camera"></i>
                                                </div>
                                                <button type="submit" style="background: transparent; border: 0; cursor: pointer; font-size: 1.1rem; color: #333;">
                                                    <i style="font-size: 1.2rem;" class="fa-solid fa-floppy-disk"></i>
                                                </button>
                                            </div>
                                            {{-- ----- Capture Photo ------- --}}
                                            <button id="captureButton" type="button">
                                                CAPTURE PHOTO
                                            </button>
                                        </div>
                                    </div>
                            
                                </div>
                            </form>
                            
                        @endif
                    </div>
                </div>

                {{-- ----------- Camera pour capturer --------- --}}
                <div class="post-container">
                    <div class="title-camera">
                        Camera
                    </div>
                    <video id="videoElement" autoplay></video>
                </div>

                <!-- ------- Image Setting ------- -->
                <div class="post-container">
                    <img class="img-setting" src="{{ asset('assets/imagesPersonnel/setting.png') }}" alt="">
                    <div class="place-email-et-btnChangePassword">
                        <p>{{ $email }}</p>
                        <div>
                            <p>Mot de passe</p>
                            <button onclick="formulaireMotDePass()"><i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                    </div>
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

                {{-- --------- Tout les employes --------- --}}
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