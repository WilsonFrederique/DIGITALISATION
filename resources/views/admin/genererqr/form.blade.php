@extends('base')

@section('title', "AJOUT CODE QR")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>
            <div class="table-date">
                <div class="todo">
                    <body>
                        <div class="main">
                            <div class="container">
                                <h1>Générateur de Code QR avec Scanner</h1>
                                {{-- <p>This tool is used for generating QR codes based on your inputs, and can also read the QR code via camera or upload.</p> --}}
                                                    
                                <div class="options">
                                    <button class="btn-generer-qr" onclick="showGenerator()">Générer un Code QR</button>
                                    <button class="btn-generer-qr" onclick="showScanner()">Scanner le Code QR</button>
                                </div>
                    
                                <div class="generator-container" style="display: none;">
                                    {{-- <form method="POST" action="{{ route('admin.genereqrs.store') }}" enctype="multipart/form-data"> --}}
                                        <input name="numEmp" type="text" id="qr-input" placeholder="Entrez le texte pour générer un code QR" required />
                                        
                                        <button type="button" class="gen-scan-apres gen" onclick="generateQRCode()">Générer un Code QR</button>
                                        <canvas id="qrcode"></canvas>
                                        
                                        <div class="btn-enr-ret">
                                            <a class="a-generer" onclick="back()"><i class='bx bx-left-arrow-alt'></i> Retour</a>
                                            <button type="submit" class="a-generer">Enregistrer</button>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                    
                                <div class="scanner-container" style="display: none;">
                                    <button class="gen-scan-apres" onclick="startScanner()">Démarrer le Scanner de Code QR</button>
                                    <div id="scanner-container" style="display: none;">
                                        <video id="video"></video>
                                    </div>
                                    <canvas id="captured-image" class="captured-image" style="display: none;"></canvas>
                                    <p id="qr-result"></p>
                                    <a class="a-generer" onclick="back()"><i class='bx bx-left-arrow-alt'></i> Retour</a>
                                </div>

                                <div class="img-top-gen-scn">
                                    <img src="{{ asset('assets/images/q1.png') }}" alt="">
                                </div>

                            </div>
                        </div>
                    
                        <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
                        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                    
                        <!-- Script JS -->
                        <script src="./script.js"></script>
                    </body>
                    
                </div>
            </div>

        </main>
    </section>

@endsection

<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');

    .img-top-gen-scn {
        width: 100%;
        max-height: 17rem;
        margin: 1rem;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .btn-enr-ret{
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .img-top-gen-scn img {
        max-width: 100%;
        max-height: 50%;
        width: auto;
        height: auto;
    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
        background-color: #eee;
        border-radius: 15px;
        box-shadow: rgba(0, 0, 0, 0.3) 0 5px 15px;
        width: 100%;
    }

    .container > h1 {
        font-size: 35px;
    }

    .options {
        display: flex;
        justify-content: space-around;
        width: 100%;
        margin-top: 10px;
    }

    .gen{
        margin-top: 1.5rem;
    }

    .gen-scan-apres{
        border: 1px solid #2271ff;
        padding: 0.5rem;
        border-radius: 4px;
    }

    .btn-generer-qr {
        font-size: 20px;
        padding: 10px;
        width: 250px;
        border: none;
        box-shadow: rgba(0, 0, 0, 0.3) 0 2px 5px;
        border-radius: 4px;
        background-color: #667eea;
        color: #eee;
        margin-top: 10px;
        cursor: pointer;
    }

    .btn-generer-qr:hover, .gen-scan-apres:hover {
        background-color: #536ee7;
        color: #fff;
    }

    .generator-container, 
    .scanner-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    /* .generator-container > form input {
        font-size: 20px;
        text-align: center;
        width: 100%;
        border: none;
        border-bottom: 1px solid;
        padding: 5px;
        width: 300px;
        background-color: transparent;
        outline: none;
    } */

    .generator-container > input {
        font-size: 20px;
        text-align: center;
        width: 100%;
        border: none;
        border-bottom: 1px solid;
        padding: 5px;
        width: 300px;
        background-color: transparent;
        outline: none;
    }

    #qrcode {
        margin-top: 20px;
    }

    .a-generer {
        margin-top: 10px;
        font-size: 17px;
        cursor: pointer;
        background: #2271ff;
        padding: 0.5rem;
        border-radius: 4px;
        color: #fff;
        display: flex;
        align-items: center;
    }
    
    .a-generer:hover {
        color: #fff;
        background: #2f71eb;
    }

    #scanner-container {
        width: 100%;
        height: 300px;
        border: 1px solid #ccc;
        border-radius: 4px;
        overflow: hidden;
        position: relative;
        margin-top: 20px;
    }

    #video {
        width: 100%;
        height: 100%;
    }

    .captured-image {
        margin-top: 20px;
    }

    #qr-result {
        font-size: 20px;
        margin-top: 10px;
    }
</style>


<script>
    function showGenerator() {
        document.querySelector('.options').style.display = 'none';
        document.querySelector('.generator-container').style.display = 'flex';
    }

    function showScanner() {
        document.querySelector('.options').style.display = 'none';
        document.querySelector('.scanner-container').style.display = 'flex';
    }

    function generateQRCode() {
        const input = document.getElementById('qr-input').value;
        if (!input) {
            alert("Please enter text to generate QR code.");
            return;
        }
        const canvas = document.getElementById('qrcode');
        QRCode.toCanvas(canvas, input, function (error) {
            if (error) console.error(error);
        });
    }

    function back() {
        document.querySelector('.options').style.display = 'flex';
        document.querySelector('.generator-container').style.display = 'none';
        document.querySelector('.scanner-container').style.display = 'none';
        document.getElementById('qr-result').textContent = '';
        document.getElementById('captured-image').style.display = 'none';
        if (scanner) {
            scanner.stop();
        }
    }

    let scanner;

    function startScanner() {
        document.querySelector('.scanner-container button').textContent = 'Scan Again';
        document.getElementById('captured-image').style.display = 'none';
        document.querySelector('#scanner-container').style.display = '';
        document.getElementById('qr-result').textContent = '';
        const qrResult = document.getElementById('qr-result');
        const video = document.getElementById('video');
        const canvas = document.getElementById('captured-image');
        const context = canvas.getContext('2d');

        scanner = new Instascan.Scanner({ video: video });
        scanner.addListener('scan', function (content) {
            qrResult.textContent = 'QR Code detected: ' + content;
            
            // Capture the current video frame
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.style.display = 'block';
            document.querySelector('#scanner-container').style.display = 'none';
            document.querySelector('.scanner-container button').textContent = 'Scan Again';
            
            scanner.stop();
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
            alert(e);
        });
    }
</script>