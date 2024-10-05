<!-- ========================================= SIDE BAR ======================================== -->
<section id="sidebar">
    <a href="#" class="brand">
        {{-- <i class='bx bxs-smile'></i> --}}
        <img class="imgLogo" src="{{ asset('assets/images/logo1.png') }}" alt="">
        
        {{-- @foreach ($entreprises as $entreprise)
            <span class="text txt-logo">{{ $entreprise->NomEntreprise }}</span>
        @endforeach --}}

        <span class="text txt-logo">REGION ANOSY</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="">
                <i class='bx bx-book-bookmark'></i>
                <span class="text txt-page">Page</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.employes.index') }}" class="employe">
                <i class='bx bxs-group' ></i>
                <span class="text">Employees</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.genereqrs.index') }}">
                <i class='bx bx-qr-scan' ></i>
                <span class="text">Générer QR</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.calendrier.index') }}">
                <i class='bx bx-calendar'></i>
                <span class="text">Calendrier</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-street-view'></i>
                <span class="text">Pointages</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.permissions.index') }}">
                <i class='bx bx-universal-access'></i>
                <span class="text">Permission</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-briefcase-alt-2' ></i>
                <span class="text">Mission</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-copyright'></i>
                <span class="text">Conges</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="{{ route('admin.parametres.index') }}">
                <i class='bx bxs-cog' ></i>
                <span class="text">Paramètres</span>
            </a>
        </li>
        <li>
            <a href="#" class="logout">
                <i class='bx bx-log-out-circle'></i>
                <span class="text">Déconnexion</span>
            </a>
        </li>
    </ul>
</section>

<!-- ========================================= CONTENT ======================================== -->
<section id="content">
    <!-- ----------------------  Navbar ------------------ -->
    <nav>
        <i class='bx bx-menu menu' ></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
            <div class="form-input">
                <input name="Rechercher" type="search" placeholder="Recherche...">
                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
            </div>
        </form>

        <div class="theme-toggler">
            <a href="#">
                <i class='bx bxs-brightness-half them' ></i>
            </a>
        </div>

        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>

        <!-- /////////////////////// PROFILE ////////////////////////// -->
        <div class="right">
            <div class="top">
                <div class="profile">
                    <div class="info">
                        <p class="admin-nom"><b>Frederique</b></p>
                        <small class="text-muted admin-grad">Admin</small>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="profile">
            <img src="{{ asset('assets/images/admin.jpg') }}">
        </a>

    </nav>

</section>

















































































































{{-- ======================== MENU =======================
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <img style="" id="logo" src="{{ asset('assets/images/logo1.png') }}" alt="Logo">
                    </span>
                    <span id="txtLogo" class="title">REGION ANOSY</span>
                </a>
            </li>

            <li>
                <a href="{{ route('app_accueil') }}">
                    <span class="icon">
                        <i class='bx bx-home-alt'></i>
                    </span>
                    <span class="title">Home</span>
                </a>
            </li>

            <li>
                <a href="{{ route('app_employe') }}">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Employes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('app_genererqr') }}">
                    <span class="icon">
                        <i class='bx bx-qr-scan' ></i>
                    </span>
                    <span class="title">Générer QR</span>
                </a>
            </li>

            <li>
                <a href="{{ route('app_pointage') }}">
                    <span class="icon">
                        <i class='bx bx-street-view'></i>
                    </span>
                    <span class="title">Pointage</span>
                </a>
            </li>

            <li>
                <a href="{{ route('app_conge') }}">
                    <span class="icon">
                        <ion-icon name="wallet-outline"></ion-icon>
                    </span>
                    <span class="title">Conge</span>
                </a>
            </li>

            <li>
                <a href="">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Messages</span>
                    <span class="message-count">26</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Password</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>

        </ul>
    </div>

</div> --}}
