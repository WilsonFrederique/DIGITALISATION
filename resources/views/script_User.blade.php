{{-- ================== Inoicon ===================== --}}
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

{{-- -------- Mon Script --------- --}}
<script>
    
    var settingmenu = document.querySelector(".settings-menu");
    var infoEvents = document.querySelector(".info-event");
    var supprPublication = document.querySelector(".place-suppr");
    var modifPassword = document.querySelector(".place-modif-Password");
    var darkBtn = document.getElementById("dark-btn");

    function settingsMenuToggle(){
        console.log("Ok");
        settingmenu.classList.toggle("settings-menu-height");
    }

    function formulaireMotDePass(){
        console.log("Ok");
        modifPassword.classList.toggle("place-modif-Password-height");
    }

    function supprimerLaPublication(){
        console.log("Ok");
        supprPublication.classList.toggle("place-suppr-height");
    }

    function infoEvenements(element) {
        const eventDiv = element.closest(".event");
        const date = eventDiv.getAttribute("data-date");
        const title = eventDiv.getAttribute("data-title");
        const location = eventDiv.getAttribute("data-location");

        // Mettez à jour le contenu de la div info-event
        infoEvents.querySelector(".left-event h3").textContent = date.split(" ")[0];
        infoEvents.querySelector(".left-event span").textContent = date.split(" ")[1];
        infoEvents.querySelector(".right-event h4").textContent = title;
        infoEvents.querySelector(".right-event .p").innerHTML = `<i class="fa-solid fa-location-dot"></i> ${location}`;

        // Affiche l'info-event
        infoEvents.classList.toggle("info-event-height");
    }

    function closeInfoEvent() {
        var infoEvents = document.querySelector(".info-event");
        infoEvents.classList.remove("info-event-height"); // Enlève la classe pour masquer l'élément
    }


    darkBtn.onclick = function(){
        darkBtn.classList.toggle("dark-btn-on");
        document.body.classList.toggle("dark-theme");

        if(localStorage.getItem("theme") == "light"){
            localStorage.setItem("theme", "dark");
        }else{
            localStorage.setItem("theme", "light");
        }
    }


    if(localStorage.getItem("theme") == "light"){
        darkBtn.classList.remove("dark-btn-on");
        document.body.classList.remove("dark-theme");
    }
    else if(localStorage.getItem("theme") == "dark"){
        darkBtn.classList.add("dark-btn-on");
        document.body.classList.add("dark-theme");
    }
    else{
        localStorage.setItem("theme", "light");
    }






    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Récupère le premier fichier sélectionné
        const placeImgPub = document.querySelector('.place-img-pub'); // Cible le conteneur pour afficher l'image

        // Vérifie si un fichier a été sélectionné
        if (file) {
            const reader = new FileReader(); // Crée un nouvel objet FileReader

            reader.onload = function(e) {
                // Crée une nouvelle image
                const img = document.createElement('img');
                img.src = e.target.result; // Définit la source de l'image à la donnée lue par le FileReader
                placeImgPub.innerHTML = ''; // Vide le conteneur avant d'afficher une nouvelle image
                placeImgPub.appendChild(img); // Ajoute l'image au conteneur
            };

            reader.readAsDataURL(file); // Lit le fichier comme une URL de données
        }
    });

</script>

{{-- ============ Script Pour Affiche image que je choisi da mon folder ============== --}}
<script>
    document.getElementById('file-upload').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Récupère le fichier sélectionné
        const previewImage = document.getElementById('preview-image');
        
        // Vérifier si un fichier a été sélectionné et si c'est une image
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.style.backgroundImage = `url(${e.target.result})`; // Définit l'image comme arrière-plan
            };

            reader.readAsDataURL(file); // Convertit le fichier en une URL utilisable pour l'arrière-plan
        } else {
            alert('Veuillez sélectionner un fichier image valide.');
        }
    });
</script>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById('preview-image');
            img.src = reader.result;
            img.style.display = 'block'; // Assurez-vous que l'image est affichée
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


{{-- ============= Scrip Capture Photo =============== --}}
<script>
    const videoElement = document.getElementById('videoElement');
    const canvasElement = document.getElementById('canvasElement');
    const photoElement = document.getElementById('photoElement');
    const startButton = document.getElementById('startButton');
    const captureButton = document.getElementById('captureButton');
    const fileInput = document.getElementById('file-upload'); // Le champ de fichier imgProfil
    const formElement = document.querySelector('form'); // Le formulaire

    let stream;

    // Fonction pour démarrer la webcam
    async function startWebcam() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            videoElement.srcObject = stream;
            startButton.disabled = true;
            captureButton.disabled = false;
        } catch (error) {
            console.error('Error accessing webcam:', error);
        }
    }

    startButton.addEventListener('click', startWebcam);

    // Fonction pour capturer une photo
    function capturePhoto() {
        canvasElement.width = videoElement.videoWidth;
        canvasElement.height = videoElement.videoHeight;
        canvasElement.getContext('2d').drawImage(videoElement, 0, 0);
        const photoDataUrl = canvasElement.toDataURL('image/jpeg');
        photoElement.src = photoDataUrl;
        photoElement.style.display = 'block';

        // Créer un fichier Blob à partir de l'image capturée
        canvasElement.toBlob(function(blob) {
            // Créer un fichier basé sur le Blob
            const file = new File([blob], 'photo_capture.jpg', { type: 'image/jpeg' });

            // Créer un objet DataTransfer pour manipuler les fichiers du champ input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Assigner le fichier au champ input du formulaire
            fileInput.files = dataTransfer.files;
        }, 'image/jpeg');
    }

    captureButton.addEventListener('click', capturePhoto);
</script>


{{-- ============= Script Pour Champ Vide ============ --}}
<script>
    function enregistrer() {
        let vid1 = document.getElementById("vid1");
        let vid2 = document.getElementById("vid2");
        let vid3 = document.getElementById("vid3");
        let vid4 = document.getElementById("vid4");
        let vid5 = document.getElementById("vid5");

        if (vid1.value.trim() === "") {
            vid1.classList.add('error');
            setTimeout(() => {
                vid1.classList.remove('error');
            }, 1000);
        } else {
            vid1.classList.remove('error');
        }

        if (vid2.value.trim() === "") {
            vid2.classList.add('error');
            setTimeout(() => {
                vid2.classList.remove('error');
            }, 1000);
        } else {
            vid2.classList.remove('error');
        }

        if (vid3.value.trim() === "") {
            vid3.classList.add('error');
            setTimeout(() => {
                vid3.classList.remove('error');
            }, 1000);
        } else {
            vid3.classList.remove('error');
        }

        if (vid4.value.trim() === "") {
            vid4.classList.add('error');
            setTimeout(() => {
                vid4.classList.remove('error');
            }, 1000);
        } else {
            vid4.classList.remove('error');
        }
    }
</script>

{{-- ---------- Modification Password ----------- --}}
{{-- 
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        let newPassword = document.getElementById('vid2').value;
        let confirmPassword = document.getElementById('vid3').value;

        // Vérification de la correspondance entre le nouveau mot de passe et la confirmation
        if (newPassword !== confirmPassword) {
            alert('Veuillez vérifier que les deux mots de passe correspondent.');
            event.preventDefault(); // Empêche l'envoi du formulaire si les mots de passe ne correspondent pas
            return false;
        }

        // Si tout est bon, laisser le formulaire être soumis
        alert("Modification réussie");
        return true;
    });
</script> --}}