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

                {{-- ------------- Affichage Permission --------------- --}}
                <div style="margin-bottom: 0.4rem;" class="white-post-container">
                    <div class="user-profil title-permission">
                        <div class="txt-titre-img">
                            <p style="font-size: 1.5rem; display: flex; align-items: center; gap: 0.9rem">
                                <span style="font-size: 1.5rem;">VOS PERMISSION</span> 
                                <span><a href="#frmPermission"><i class="fa-solid fa-plus" 
                                    style="color: #999999ad; 
                                    font-size: 1rem; border: 1px solid #999999ad; border-radius: 50%; 
                                    padding: 0.3rem; width: 25px; height: 25px; display: flex; align-items: center; "></i></a>
                                </span>
                            </p>
                            <img src="{{ asset('assets/imagesPersonnel/chatPermission.png') }}" alt="">
                        </div>
                        <span style="border-bottom: 1px solid #888; width: 100%; margin-bottom: 1rem;"></span>
                    </div>

                    <div class="place-vos-permission">

                        {{-- -------------- Content Pour vos affichage Permission ------------ --}}
                        <div id="content">
                            <main>
                                <div class="table-date">
                                    <div class="todo">
                                        @foreach ($permissions as $permission)
                                            <ul style="margin-bottom: 2.5rem;" class="todo-list todo-color">
                                                <div class="header-time-date-validation">
                                                    <p style="color: #888">Raison: {{ $permission->Raison }}</p>
                                                    <div style="color: #444" class="validation"><span>Validation</span> <span class="oui-nom">Oui</span></div>
                                                </div>
                                                <li class="permission">
                                                    <div class="todo-item">
                                                        <div class="txt-left">
                                                            <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                                        </div>
                                                    </div>
                                                    <p>{{ $employe->Grade }}</p> 
                                                </li>
                                                <div class="footer-permission">
                                                    <div style="color: #555" class="date-tim">
                                                        <span>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M Y') }}</span> à 
                                                        <span>{{ \Carbon\Carbon::parse($permission->created_at)->format('H:i') }}</span>
                                                    </div>
                                                    <div class="QR-icon">
                                                        <div class="icon-container icon">                                                            
                                                            <form action="{{ route('users.permissions.destroy', $permission->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                                    <a href="#"><i class='bx bx-trash delt-qr' style='color:#d01616; font-size: 1.1rem;' ></i></a>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>

                <!-- ----- Permission FRM ----- -->
                <div class="white-post-container">
                    {{-- ----- Rappel titre Permission ------ --}}
                    <div class="user-profil title-permission">
                        <div class="txt-titre-img">
                            <p style="font-size: 1.5rem;">PERMISSION</p>
                            <img src="{{ asset('assets/imagesPersonnel/chatPermission.png') }}" alt="">
                        </div>
                        <span style="border-bottom: 1px solid #888; width: 100%;"></span>
                    </div>

                    <div id="frmPermission" class="post-input-container">
                        {{-- ================ Formulaire Permission =================== --}}
                        <div class="container-frm">
                    
                            {{-- <form method="POST" action="{{ route('users.ajoutPermission') }}"> --}}
                            <form method="POST" action="{{ route('users.ajoutPermission') }}">

                                @csrf

                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title">EXPÉDITEUR</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>CIN de l'expéditeur</label>
                                                <input name="numEmp" type="text" placeholder="CIN de l'expéditeur">
                                            </div>
                                            <div class="input-field">
                                                <label>Fait le</label>
                                                <input name="FaiLe" type="date" placeholder="Fait le">
                                            </div>
                                            <div class="input-field">
                                                <label>Date de début</label>
                                                <input name="DateDebut" type="date" placeholder="Fait le">
                                            </div>
                                            <div class="input-field">
                                                <label>Date de fin</label>
                                                <input name="DateFin" type="date" placeholder="Fait le">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="details ID">
                                        <span class="title">DESTINATEUR</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>Nom du Destinateur</label>
                                                <input name="NomPrenomDestinateur" type="text" placeholder="Nom du Destinateur">
                                            </div>
                                            <div class="input-field">
                                                <label>Poste du Destinateur</label>
                                                <input name="PosteDestinateur" type="text" placeholder="Poste du Destinateur">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="details ID">
                                        <span class="title">DÉTAILS</span>
                    
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>Raison</label>
                                                <input name="Raison" type="text" placeholder="Ex : Un voyage personnel, etc...">
                                            </div>
                                            <div class="input-field">
                                                <label>Nom de l'Organisation</label>
                                                <input name="NomOrganisation" type="text" placeholder="Nom de l'Organisation">
                                            </div>
                                            <div class="input-field">
                                                <label>Engagement</label>
                                                <textarea name="Engagement" placeholder="Mentionner ce que vous ferez pour compenser votre absence, si applicable" id=""></textarea>
                                            </div>
                    
                                            <div class="input-field">
                                                <label>Dispositions</label>
                                                <textarea name="Dispositions" placeholder="Dispositions, ajouter des détails ( Exemple: J'ai informé mes collègues et préparé le travail en avance. )" id=""></textarea>
                                            </div>
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