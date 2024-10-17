@extends('baseUser')

@section('title', "PERMISSION")

@section('containerUser')

    <div class="container">
        <!-- ============= Left sidbar ============= -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a href="{{ route('users.indexPub') }}"><i class='bx bx-news img'></i><span>Dernières nouvelles</span></a>
                <a href="{{ route('users.indexLesEmployes') }}"><i class='bx bx-group img'></i><span>Employés</span></a>
                <a href="{{ route('users.indexPermissions') }}"><i class='bx bxs-hand img'></i><span>Permission</span></a>
                <a href="#"><i class='bx bxs-briefcase-alt-2 img'></i><span>Mission</span></a>
                <a href="#"><i class='bx bx-pause-circle img'></i><span>Congé</span></a>
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

                <!-- ----- Add publication ----- -->
                <div class="white-post-container">
                    {{-- ----- Rappel titre Permission ------ --}}
                    <div class="user-profil title-permission">
                        <div class="txt-titre-img">
                            <p style="font-size: 1.5rem;">PERMISSION</p>
                            <img src="{{ asset('assets/imagesPersonnel/chatPermission.png') }}" alt="">
                        </div>
                        <span style="border-bottom: 1px solid #888; width: 100%;"></span>
                    </div>

                    <div class="post-input-container">
                        
                        {{-- ================ Formulaire Permission =================== --}}
                        <div class="container-frm">
                            <header>Registration</header>
                    
                            <form action="#">
                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title">Personnel Details</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>Votre Nom</label>
                                                <input type="text" placeholder="Entrer votre Nom">
                                            </div>
                                            <div class="input-field">
                                                <label>Votre Naissance</label>
                                                <input type="date" placeholder="Entrer votre Date de naissance">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="details ID">
                                        <span class="title">Identite Details</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>Votre CIN</label>
                                                <input type="text" placeholder="Entrer votre CIN">
                                            </div>
                                            <div class="input-field">
                                                <label>ID Num</label>
                                                <input type="date" placeholder="Entrer votre ID Num">
                                            </div>
                                            <div class="input-field">
                                                <label>Poste</label>
                                                <input type="text" placeholder="Entrer votre Poste">
                                            </div>
                    
                                            <div class="input-field">
                                                <label>Votre Téléphone</label>
                                                <input type="number" placeholder="Entrer votre Num Téléphone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="details ID">
                                        <span class="title">Identite Details</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>Votre CIN</label>
                                                <input type="text" placeholder="Entrer votre CIN">
                                            </div>
                                            <div class="input-field">
                                                <label>ID Num</label>
                                                <input type="date" placeholder="Entrer votre ID Num">
                                            </div>
                                            <div class="input-field">
                                                <label>Poste</label>
                                                <input type="text" placeholder="Entrer votre Poste">
                                            </div>
                    
                                            <div class="input-field">
                                                <label>Votre Téléphone</label>
                                                <input type="number" placeholder="Entrer votre Num Téléphone">
                                            </div>
                                        </div>
                                    </div>

                                    <button class="nextBtn">
                                        <span class="btnText">Suivant</span>
                                        <i class='bx bx-send'></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- ------- Publication ------- -->
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