{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        let canvas = document.getElementById('canvas');
        if (canvas) {
            let ctx = canvas.getContext('2d', { willReadFrequently: true });
            // Utilisation du contexte canvas pour scanner ou afficher un QR code
        } else {
            console.error("Canvas introuvable");
        }
    });
</script> --}}
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

{{-- ============== Script nav ============== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const generatorTab = document.querySelector(".nav-gene");
        const scannerTab = document.querySelector(".nav-scan");

        generatorTab.addEventListener("click", () => {
            generatorTab.classList.add("active");
            scannerTab.classList.remove("active");

            document.querySelector(".scanner").style.display = "none";
            document.querySelector(".generetor").style.display = "block";
        })

        scannerTab.addEventListener("click", () => {
            scannerTab.classList.add("active");
            generatorTab.classList.remove("active");

            document.querySelector(".scanner").style.display = "block";
            document.querySelector(".generetor").style.display = "none";
        })
    });
</script>

{{-- ======== Script generer Code QR ======== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const generetorDiv = document.querySelector(".generetor");
        const generetorBtn = generetorDiv.querySelector(".generetor-form button");
        const qrInput = generetorDiv.querySelector(".generetor-form input");
        const qrImg = generetorDiv.querySelector(".generetor-img img");
        const downloadBtn = generetorDiv.querySelector(".generetor-btn .btn-link");

        let imgURL = '';

        generetorBtn.addEventListener("click", () => {
            let qrValue = qrInput.value;
            //  Si la valeur est vide -> arrêter ici.
            if(!qrValue.trim()) return;

            generetorBtn.innerText = "Generating QR code...";

            // Si la valeur est valide -> utiliser l'API qrserver pour générer un code QR.
            imgURL = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
            qrImg.src = imgURL;

            qrImg.addEventListener("load", () => {
                generetorDiv.classList.add("active");
                generetorBtn.innerText = "Générer code QR";
            })
        })

        //  Télécharger le code QR.
        downloadBtn.addEventListener("click", () => {
            if(!imgURL) return;
            fetchImage(imgURL)
        })

        function fetchImage(url){
            fetch(url).then(res => res.blob()).then(file => {
                let tempFile = URL.createObjectURL(file);
                let file_name = url.split("/").pop().split(".")[0];
                let extension = file.type.split("/")[1];

                download(tempFile, file_name, extension);
            })
            .catch(() => imgURL = '');
        }

        function download(tempFile, file_name, extension){
            let a = document.createElement('a');
            a.href = tempFile;
            a.download = `${file_name}.${extension}`;
            document.body.appendChild(a);
            a.click();
            a.remove();
        }

        // If value is empty -> remove active close
        qrInput.addEventListener("input", () => {
            if(!qrInput.value.trim())
                return generetorDiv.classList.remove("active");
        })
    });
</script>

{{-- ======== Script Scanner Code QR ======== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scannerDiv = document.querySelector(".scanner");
        const camera = scannerDiv.querySelector("h1 .fa-camera");
        const stopCam = scannerDiv.querySelector("h1 .fa-circle-stop");

        const form = scannerDiv.querySelector(".scanner-form");
        const fileInput = form.querySelector("input");
        const p = form.querySelector("p");
        const img = form.querySelector("img");
        const video = form.querySelector("video");
        const content = form.querySelector(".content-scanner");

        const textarea = scannerDiv.querySelector(".scanner-details textarea");
        const copyBtn = scannerDiv.querySelector(".scanner-details .copy");
        const closeBtn = scannerDiv.querySelector(".scanner-details .close");


        // Fichier d'entrée
        form.addEventListener("click", () => fileInput.click());

        // Scanner l'image du code QR
        fileInput.addEventListener("change", e => {
            let file = e.target.files[0];
            if(!file) return;
            fetchRequest(file);
        })

        function fetchRequest(file) {
            let formData = new FormData();
            formData.append("file", file);

            p.innerText = "Scanning QR Code...";

            fetch(`http://api.qrserver.com/v1/read-qr-code/`, {
                method: "POST", 
                body: formData
            }).then(res => res.json()).then(result => {
                let text = result[0].symbol[0].data;

                if (!text) {
                    p.innerText = "Impossible de scanner le code QR";
                    return;
                }

                // Mise à jour de l'interface
                scannerDiv.classList.add("active");
                form.classList.add("active-img");
                img.src = URL.createObjectURL(file);
                textarea.innerText = text; // Remplit le champ textarea avec les données scannées

                // Envoi des données scannées au serveur via AJAX
                sendDataToServer(text); // Envoie les données scannées
            }).catch(err => {
                console.error("Erreur lors du scan :", err);
                p.innerText = "Erreur lors du scan du code QR";
            });
        }

        function sendDataToServer(data) {
            fetch("{{ route('store_pointage') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    numEmp: data // ici 'data' contient la valeur du QR Code scanné
                })
            })
            .then(res => res.text()) // Obtenez la réponse sous forme de texte
            .then(text => {
                console.log(text); // Affichez la réponse
                // Ensuite, vous pouvez essayer de l'analyser en JSON si nécessaire
                try {
                    const jsonResponse = JSON.parse(text);
                    console.log(jsonResponse.message);
                } catch (e) {
                    console.error("Erreur lors de l'analyse JSON :", e);
                }
            })
            .catch(err => {
                console.error("Erreur lors de l'ajout des données :", err);
            });
        }

        // Scanner Code QR par Camera
        let scanner;

        camera.addEventListener("click", () => {
            camera.style.display = "none";
            form.classList.add("pointerEvent");
            p.innerText = "Scanning QR Code...";

            scanner = new Instascan.Scanner({ video: video });

            Instascan.Camera.getCameras()
                .then(cameras => {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]).then(() => {
                            form.classList.add("active-video");
                            stopCam.style.display = "inline-block";
                        });
                    } else {
                        console.log("Aucune caméra trouvée");
                    }
                }).catch(err => console.error(err));

            // scanner.addListener("scan", content => {
            //     scannerDiv.classList.add("active");

            //     // Affiche la message avec le contenu scanné
            //     textarea.innerText = content;

            //     // Afficher une alerte avec le contenu scanné
            //     // alert(`Scan employe réussi : ${content}`);
            //     alert(`Scan employe réussi`);

            //     // Envoi des données scannées au serveur
            //     sendDataToServer(content);
            // });
            scanner.addListener("scan", content => {
                scannerDiv.classList.add("active");

                // Affiche le message avec le contenu scanné
                textarea.innerText = content;

                // Vérifier si le numEmp existe dans la base de données
                fetch("{{ route('check_numEmp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        numEmp: content // ici 'content' contient la valeur du QR Code scanné
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Si le numEmp existe, afficher l'alerte de succès
                        // textarea.innerText = content;
                        // alert(`Scan employe réussi : ${content}`);
                        alert(`Scan employe réussi`);
                        sendDataToServer(content);  // Envoi des données scannées au serveur
                    } else {
                        // Si le numEmp n'existe pas, afficher une alerte d'échec
                        alert("Pas employé ici");
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la vérification de numEmp :", error);
                    alert("Erreur lors de la vérification de l'employé");
                });
            });
        });

        // Scanner
        copyBtn.addEventListener("click", () => {
            let text = textarea.textContent;
            navigator.clipboard.writeText(text)
                .then(() => {
                    console.log("Texte copié avec succès !");
                })
                .catch(err => {
                    console.error("Échec de la copie du texte : ", err);
                });
        });

        // Fermer
        closeBtn.addEventListener("click", () => stopScan());
        stopCam.addEventListener("click", () => stopScan());

        // Stop scanner
        function stopScan(){
            p.innerText = "Téléversez un code QR à scanner";

            camera.style.display = "inline-block";
            stopCam.style.display = "none";
            
            form.classList.remove("active-video", "active-img", "pointerEvent");
            scannerDiv.classList.remove("active");

            if(scanner) scanner.stop();
        }
    });
</script>