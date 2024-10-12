@extends('base')

@section('title', "SCANNER UN CODE QR")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>

            <!-- ********************** Header Main ************************ -->

            <div class="head-title">
                <div class="left">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Code QR</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.genereqrs.index') }}">Page pour générer ou scanner un code QR</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="">Scanner un code QR</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="{{ route('admin.genereqrs.index') }}" class="btn-download genererQR">
                        <i class='bx bx-qr-scan' ></i>
                    </a>
                </div>
            </div>

            <!-- ********************* TBL AFFICHAGE *********************** -->
            <div class="table-date">
                <div class="todo">
                    <div class="place">
                        <div class="camera">
                            <img src="{{ asset('assets/images/ImgCodeQR.png') }}" alt="">
                        </div>
                        <div class="container-scan-qr">
                            <!-- ====================== Nav ====================== -->
                            <div class="div-nav">
                                <button class="nav-scan active">Scanner</button>
                                {{-- <button class="nav-gene">Générer</button> --}}
                            </div>
                                
                            <!-- =================== Generator =================== -->
                            <div class="generetor" style="display: none;">
                                <h1>Générer un code QR</h1>
                                <p>Veuillez choisissez un nom pour générer un code QR.</p>
                    
                                {{-- <div class="generetor-form">
                                    <input type="text" placeholder="Entrer text ou url">
                                    <button>Générer code QR</button>
                                </div> --}}

                                <div class="generetor-form">
                                    {{-- <form method="POST" action="{{ route('admin.genereqrs.store') }}" enctype="multipart/form-data"> --}}
                                        {{-- @csrf --}}
                                
                                        <select class="select" id="qrTextInput" name="numEmp" required>
                                            <option value="" disabled selected>Choisissez un employé</option>
                                            {{-- @foreach($employespasQRs as $employespasQR) --}}
                                                <option value="numEmp">
                                                    Nom et Prenom
                                                </option>
                                            {{-- @endforeach --}}
                                        </select>
                                
                                        <button type="submit">Générer code QR</button>
                                    </form>
                                </div>
                                                                                            
                                                              
                                
                    
                                <div class="generetor-img">
                                    {{-- <img src="assets/images/QR.jfif" alt="Code-QR"> --}}
                                    <img src="{{ asset('assets/images/QR.jfif') }}" alt="QR Code">
                                </div>
                    
                                <div class="generetor-btn">
                                    <button class="btn-link"> Télécharger <i class="fa-solid fa-download"></i></button>
                                </div>
                            </div>
                    
                            <!-- ===================== Scanner =================== -->
                            <div class="scanner">
                                <h1>
                                    Lecteur ou scanneur de code QR
                                    <i class="fa-solid fa-camera"></i>
                                    <i class="fa-sharp fa-solid fa-circle-stop"></i>
                                </h1>
                        
                                <form class="scanner-form">
                                    <input type="file" accept="images/*" hidden>
                    
                                    <img src="assets/images/QR.jfif" alt="QR-Code">
                                    <video></video>
                    
                                    <div class="content-scanner">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <p>Téléversez un code QR à scanner</p>
                                    </div>
                                </form>
                        
                                <div class="scanner-details">
                                    <form>
                                        <textarea name="numEmp" disabled>Lorem ipsum dolor sit amet consectetur adipisicing elit. In ullam harum perspiciatis velit!</textarea>
                                    </form>
                    
                                    <div class="btn">
                                        <button class="close" style="width: 100%;"> Fermer</button>
                                        <button class="copy" style="display: none"> Copier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
    </section>

@endsection

