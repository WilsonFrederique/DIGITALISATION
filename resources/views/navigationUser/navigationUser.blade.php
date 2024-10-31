<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MON COMPTE</title>    
</head>
<body>

    <nav>

        <!-- ---------------------- Navigation Left Logo Icon ------------------------- -->
        <div class="nav-left">
            <a href="{{ route('users.personnel.index') }}"><img src="{{ asset('assets/imagesPersonnel/logo1.png') }}" alt="" class="logo"></a>
            <ul class="ul">
                <a href="{{ route('users.indexLesEmployes') }}">
                    <li><img src="{{ asset('assets/imagesPersonnel/notification.png') }}" alt=""></li>
                </a>
                <a href="{{ route('users.indexPub') }}">
                    <li><img src="{{ asset('assets/imagesPersonnel/inbox.png') }}" alt=""></li>
                </a>
                <a href="{{ route('users.indexPub') }}">
                    <li><img src="{{ asset('assets/imagesPersonnel/video.png') }}" alt=""></li>
                </a>
            </ul>
        </div>

        <!-- ---------------------- Navigation Right Rech Img ------------------------- -->
        <div class="nav-right">
            <div class="search-box">
                <img src="{{ asset('assets/imagesPersonnel/search1.png') }}" alt="">
                <input type="text" placeholder="Recherche ...">
            </div>
            @if(isset($employe))
                <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                    @if(isset($imgProfil) && !empty($imgProfil->imgProfil))
                        <img src="{{ asset($imgProfil->imgProfil) }}" alt="Image de {{ $employe->Nom }}" style="max-width: 200px; max-height: 200px;">
                    @else
                        <i class='bx bx-user' style="font-size: 2.4rem; cursor: pointer;"></i>
                    @endif             
                </div>
            @endif
        </div>

        <!-- -------------------------------- Setting --------------------------------- -->
        <div class="settings-menu">
            <!-- ----- Btn dark ----- -->
            <div id="dark-btn">
                <span></span>
            </div>

            <!-- ---- Settings ------ -->
            <div class="settings-menu-inner">
                <div class="user-profil">
                    @if(isset($employe))
                        {{-- ----------- Image User dans setting ------------ --}}
                        @if(isset($imgProfil) && !empty($imgProfil->imgProfil))
                            <img src="{{ asset($imgProfil->imgProfil) }}" alt="Image de {{ $employe->Nom }}" style="max-width: 200px; max-height: 200px;">
                        @else
                            <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                        @endif 
                        
                        <div>
                            <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                            <a href="#">Voir votre profil</a>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="user-profil">
                    <i class='bx bxs-help-circle'></i>
                    <div>
                        <p>Donner un avis</p>
                        <a href="#">Aidez-nous à améliorer le nouveau design</a>
                    </div>
                </div>
                <hr>
                <div class="settings-links">
                    <i class='bx bx-cog settings-icon' ></i>
                    <a href="{{ route('users.indexParm') }}">Paramètres et confidentialité <i class='bx bx-chevron-right' style="font-size: 20px;"></i></a>
                </div>
                <div class="settings-links">
                    <i class='bx bx-help-circle settings-icon' ></i>
                    <a href="#">Aide et support <i class='bx bx-chevron-right' style="font-size: 20px;"></i></a>
                </div>
                <div class="settings-links">
                    <i class='bx bx-desktop settings-icon' ></i>
                    <a href="#">Affichage et accessibilité <i class='bx bx-chevron-right' style="font-size: 20px;"></i></a>
                </div>
                <div class="settings-links">
                    <i class='bx bx-log-out-circle settings-icon' ></i>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" style="border: none; background: transparent; cursor: pointer; font-size: 1.1rem; color: #333; display: flex; align-items: center; justify-content: space-between;">
                            Déconnexion 
                        </button>
                    </form>
                    {{-- <a href="#">Déconnexion <i class='bx bx-chevron-right' style="font-size: 20px;"></i></a> --}}
                </div>
            </div>

        </div>

        <!-- -------------------------------- Plus d'info ----------------------------- -->
        <div class="info-event">
            <div class="tout-event">
                <div class="sidebar-title">
                    <h4>Evenements</h4>
                    <div onclick="closeInfoEvent()">
                        <a href="#">Fermer</a>
                    </div>
                </div>
    
                <div class="event">
                    <div class="left-event">
                        <h3>18</h3>
                        <span>Septembre</span>
                    </div>
                    <div class="right-event">
                        <h4>Social Media</h4>
                        <p class="p"><i class="fa-solid fa-location-dot"></i> Wilson Frederique</p>
                    </div>
                </div>
    
                <p class="p">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio voluptatum labore provident maiores animi 
                    nostrum in, consequuntur, molestiae dolorem hic ipsam explicabo eaque reprehenderit repellat asperiores 
                    exercitationem soluta. Cumque, hic.</p>
            </div>
        </div>

        <!-- -- Modification Password -- -->
        <div class="place-modif-Password">
            <div class="btn-suppr">
                <div class="form-conge">
                    <form>
                        <div class="input1">
                            <p style="display: none">Numéro CIN</p>
                            @if(isset($employe))
                                <input type="hidden" value="" type="text" placeholder="Numéro CIN">
                            @endif
                        </div>
                        <div class="input1">
                            <p>Mot de passe actuel</p>
                            <input type="password" placeholder="Mot de passe actuel" id="vid1">
                        </div>
                        <div class="frm1">
                            <div class="input1">
                                <p>Nouveau mot de passe</p>
                                <input name="numEmp" type="password" placeholder="Nouveau mot de passe" id="vid2">
                            </div>
                            <div class="input1">
                                <p>Confimer le mot de passe</p>
                                <input type="password" placeholder="Confimer le mot de passe" id="vid3">
                            </div>
                        </div>
                        
                        <button type="submit" onclick="enregistrer()">Enregistrer</button>
                    </form> 

                    {{-- <form method="POST" action="{{ route('users.parametres.update', $employe->numEmp) }}">
                        @csrf
                        @method('PUT')
                    
                        <div class="input1">
                            <p>Mot de passe actuel</p>
                            <input type="password" name="current_password" placeholder="Mot de passe actuel" id="current_password" required>
                        </div>
                    
                        <div class="frm1">
                            <div class="input1">
                                <p>Nouveau mot de passe</p>
                                <input type="password" name="new_password" placeholder="Nouveau mot de passe" id="vid2" required>
                            </div>
                    
                            <div class="input1">
                                <p>Confirmer le mot de passe</p>
                                <input type="password" name="new_password_confirmation" placeholder="Confirmer le mot de passe" id="vid3" required>
                            </div>
                        </div>
                        
                        <button type="submit">Enregistrer</button>
                    </form>                     --}}

                </div>
            </div>
        </div>

        <!-- -- Suppr Publict° -- -->
        <!-- <div class="place-suppr">
            <div class="btn-suppr">
                <button style="border: none; outline: none; width: 100%; height: fit-content; background: transparent;">
                    <div class="esnb-txt-icon-suppr" style="display: flex; align-items: center; justify-content: space-between;">
                        <p style="color: #f5f4f4; font-size: 0.8rem; cursor: pointer;">Voulez-vous supprimer cette publication ? :</p>
                        <span><i class="fa-solid fa-trash" style="color: #fff; cursor: pointer;"></i></span>
                    </div>
                </button>
            </div>
        </div> -->

    </nav>

</body>
</html>