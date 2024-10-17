@extends('baseUser')

@section('title', "BIENVENU A VOUS")

@section('containerUser')

    <div class="container">
        <!-- ============= Left sidbar ============= -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a href="{{ route('users.indexPub') }}"><i class='bx bx-news img'></i><span>Dernières nouvelles</span></a>
                <a href="{{ route('users.indexLesEmployes') }}"><i class='bx bx-group img'></i><span>Employés</span></a>
                <a href="#"><i class='bx bxs-hand img'></i><span>Permission</span></a>
                <a href="#"><i class='bx bxs-briefcase-alt-2 img'></i><span>Mission</span></a>
                <a href="#"><i class='bx bx-pause-circle img'></i><span>Congé</span></a>
                <a href="#"><span>Voir plus</span></a>
            </div>
            <div class="shortcut-links">
                <p>Vos raccourcis</p>
                <a href="#"><img src="{{ asset('assets/imagesPersonnel/pub1.png') }}" alt=""><span>Web Developers</span></a>
                <a href="#"><img src="{{ asset('assets/imagesPersonnel/pub2.png') }}" alt=""><span>Web Design course</span></a>
                <a href="#"><img src="{{ asset('assets/imagesPersonnel/pub3.png') }}" alt=""><span>Full Stack Development</span></a>
                <a href="#"><img src="{{ asset('assets/imagesPersonnel/pub4.png') }}" alt=""><span>Website Experts</span></a>
            </div>
        </div>

        {{-- ========== Content et Right ========== --}}
        <div class="ens-cont-et-right">
            <!-- ============= Main content ============ -->
            <div class="main-content">

                <!-- ----- Welcome à vous ----- -->
                <div class="white-post-container">
                    <div class="welcom">
                        <div class="user-profil prfl-catpure-dossie">
                            @if(isset($employe))
                                <div class="prfl">
                                    @if(isset($imgProfil) && !empty($imgProfil->imgProfil))
                                        <img src="{{ asset($imgProfil->imgProfil) }}" alt="Image de {{ $employe->Nom }}" style="max-width: 200px; max-height: 200px;">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                                    @endif
                                    <div>
                                        <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                        <small>Public <i class="fa-solid fa-caret-down"></i></small>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- ------------- Image Welcom ----------------- --}}
                        <img class="img-setting" src="{{ asset('assets/imagesPersonnel/welcome.png') }}" alt="">
                    </div>
                </div>

                <div class="post-container">
                    <h2>FARITRA ANOSY MIASA HO ANAO</h2>
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

            </div>
        </div>
    </div>

    <!-- ********* Footer ******** -->
    <div class="footer">
        <p>Droit d'auteur 2024 - GitHub : WILSONFREDERIQUE</p>
    </div>

@endsection