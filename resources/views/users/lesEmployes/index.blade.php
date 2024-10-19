@extends('baseUser')

@section('title', "LES EMPLOYES")

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

        {{-- ========== Content et Right =========== --}}
        <div class="ens-cont-et-right">
            <!-- ============= Main content ============ -->
            <div class="main-content">

                <!-- ------- Les employes  ------- -->
                <div class="post-container">

                    <section id="specialists">
                        <div class="en-tete-services">
                            <h2>LES EMPLOYEES</h2>
                        </div>
                        <div class="container">
                
                            @foreach ($ToutEmployes as $ToutEmploye)
                                <article>
                                    <div class="specialist__image">
                                        {{-- Vérifier si l'employé a une image de profil --}}
                                        @if ($ToutEmploye->imgProfil)
                                            <img src="{{ asset($ToutEmploye->imgProfil) }}" alt="Image de profil">
                                        @else
                                            {{-- <i class='bx bx-user' style="font-size: 2.4rem;"></i> --}}
                                            <img style="height: 20rem; width: 100%;" src="{{ asset('assets/images/UserParDef.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="specialist__socials">
                                        <a href="https://linkedin.com" target="_blank"><i class='bx bxl-linkedin' ></i></a>
                                        <a href="https://twitter.com" target="_blank"><i class='bx bxl-twitter' ></i></a>
                                        <a href="https://facebook.com" target="_blank"><i class='bx bxl-facebook' ></i></a>
                                        <a href="https://instagram.com" target="_blank"><i class='bx bxl-instagram' ></i></a>
                                    </div>
                                    <div class="specialist__details">
                                        <h4>{{ $ToutEmploye->Nom }} {{ $ToutEmploye->Prenom }}</h4>
                                        <small>{{ $ToutEmploye->Grade }}</small>
                                    </div>
                                    <a href="https://api.whatsapp.com/send?phone=261344596117" class="specialist__whatsapp" target="_blank"><i class='bx bxl-whatsapp'></i></a>
                                </article>
                            @endforeach
                            
                        </div>
                    </section>

                </div>

                <!-- ----- Add publication ----- -->
                <div class="wpost-container">
                    <img class="consulting" src="{{ asset('assets/imagesPersonnel/consulting.png') }}" alt="">
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