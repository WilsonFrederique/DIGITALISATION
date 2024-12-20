{{-- ====================== JS Swiper ======================== --}}
<script src="{{ asset('assets/lib/swiper/swiper-bundle.min.js') }}"></script>

{{-- ================== Inoicon ===================== --}}
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

{{-- ============ Scrip Pour Affiche btn Nouveau Employes ============= --}}
<script>
    var nouveauEmpl = document.querySelector(".place-plus-info");

    function voirPlusCont(){
        console.log("Ok");
        nouveauEmpl.classList.toggle("place-plus-info-height");
    }
</script>

{{-- =============== Scrip pour générer im QR des frm ================ --}}
<script>

    let imgBoxAffiche = document.getElementById("imgBoxAffiche");
    let qrImageSurLien = document.getElementById("qrImageSurLien");
    let qrTextInput = document.getElementById("qrTextInput");

    function gnrQR(){
        if(qrTextInput.value.length > 0){
            qrImageSurLien.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + qrTextInput.value;
            imgBoxAffiche.classList.add("show-img");
        }else{
            qrTextInput.classList.add('error');
            setTimeout(()=>{
                qrTextInput.classList.remove('error');
            },1000);
        }
    }

</script>

{{-- =========================== Script Alert scan ===================== --}}
<script>
    // Assurez-vous d'avoir inclus et configuré la bibliothèque html5-qrcode dans votre projet

    // Initialisation du scanner QR avec la bibliothèque html5-qrcode
    const html5QrCode = new Html5Qrcode("reader"); // "reader" est l'ID de l'élément HTML où vous affichez le scanner

    function onScanSuccess(decodedText, decodedResult) {
        // Alerte lorsque le scan réussit
        alert("Bravo ! Vous avez scanné le code QR : " + decodedText);
        
        // Arrêter le scanner après un scan réussi
        html5QrCode.stop().then(() => {
            console.log("Scanner arrêté après un scan réussi.");
        }).catch(err => {
            console.error("Erreur lors de l'arrêt du scanner : ", err);
        });
    }

    // Démarrage du scanner
    function startQrCodeScanner() {
        html5QrCode.start(
            { facingMode: "environment" }, // Utilisation de la caméra arrière du téléphone
            {
                fps: 10,    // Images par seconde (fréquence d'actualisation)
                qrbox: 250  // Taille de la zone de scan
            },
            onScanSuccess,
            (errorMessage) => {
                // Gestion des erreurs de scan si nécessaire
                console.warn("Erreur lors du scan : ", errorMessage);
            }
        ).catch(err => {
            console.error("Erreur lors du démarrage du scanner : ", err);
        });
    }

    // Appeler cette fonction pour lancer le scanner
    startQrCodeScanner();

</script>

{{-- =============== Scrip pour validation des formlr ================ --}}
<script>

    function genererQR() {
        let vid1 = document.getElementById("vid1");
        let vid2 = document.getElementById("vid2");
        let vid3 = document.getElementById("vid3");
        let vid4 = document.getElementById("vid4");
        let vid5 = document.getElementById("vid5");
        let vid6 = document.getElementById("vid6");
        let vid7 = document.getElementById("vid7");
        let vid8 = document.getElementById("vid8");
        let vid9 = document.getElementById("vid9");
        let vid10 = document.getElementById("vid10");
        let vid11 = document.getElementById("vid11");
        let vid12 = document.getElementById("vid12");
        let vid13 = document.getElementById("vid13");
        let vid14 = document.getElementById("vid14");

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

        if (vid5.value.trim() === "") {
            vid5.classList.add('error');
            setTimeout(() => {
                vid5.classList.remove('error');
            }, 1000);
        } else {
            vid5.classList.remove('error');
        }

        if (vid6.value.trim() === "") {
            vid6.classList.add('error');
            setTimeout(() => {
                vid6.classList.remove('error');
            }, 1000);
        } else {
            vid6.classList.remove('error');
        }

        if (vid7.value.trim() === "") {
            vid7.classList.add('error');
            setTimeout(() => {
                vid7.classList.remove('error');
            }, 1000);
        } else {
            vid7.classList.remove('error');
        }

        if (vid8.value.trim() === "") {
            vid8.classList.add('error');
            setTimeout(() => {
                vid8.classList.remove('error');
            }, 1000);
        } else {
            vid8.classList.remove('error');
        }

        if (vid9.value.trim() === "") {
            vid9.classList.add('error');
            setTimeout(() => {
                vid9.classList.remove('error');
            }, 1000);
        } else {
            vid9.classList.remove('error');
        }

        if (vid10.value.trim() === "") {
            vid10.classList.add('error');
            setTimeout(() => {
                vid10.classList.remove('error');
            }, 1000);
        } else {
            vid10.classList.remove('error');
        }

        if (vid11.value.trim() === "") {
            vid11.classList.add('error');
            setTimeout(() => {
                vid11.classList.remove('error');
            }, 1000);
        } else {
            vid11.classList.remove('error');
        }

        if (vid12.value.trim() === "") {
            vid12.classList.add('error');
            setTimeout(() => {
                vid12.classList.remove('error');
            }, 1000);
        } else {
            vid12.classList.remove('error');
        }

        if (vid13.value.trim() === "") {
            vid13.classList.add('error');
            setTimeout(() => {
                vid13.classList.remove('error');
            }, 1000);
        } else {
            vid13.classList.remove('error');
        }

        if (vid14.value.trim() === "") {
            vid14.classList.add('error');
            setTimeout(() => {
                vid14.classList.remove('error');
            }, 1000);
        } else {
            vid14.classList.remove('error');
        }
    }

</script>

{{-- ============== Scrip pour sideBar et aussi Thoble =============== --}}
<script>
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

    allSideMenu.forEach(item=> {
        const li = item.parentElement;

        item.addEventListener('click', function () {
            allSideMenu.forEach(i=> {
                i.parentElement.classList.remove('active');
            })
            li.classList.add('active');
        })
    });

    document.getElementById('content').style.overflow = 'scroll';

    // const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li');

    // allSideMenu.forEach(item => {
    //     item.addEventListener('click', () => {
    //         document.querySelector('#sidebar .side-menu.top li.active').classList.remove('active');
    //         item.classList.add('active');
    //     });
    // });
    // document.getElementById('content').style.overflow = 'scroll';



    // ======= TOBLE SIDE BARE =======

    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');

    menuBar.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    })


    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');

    searchButton.addEventListener('click', function (e) {
        if(window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if(searchForm.classList.contains('show')){
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            }else{
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    })


    if(window.innerWidth < 768) {
        sidebar.classList.add('hide');
    }else if(window.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }


    window.addEventListener('resize', function () {
        if(this.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    })

</script>


{{-- ========================== CHANGE THEME ========================= --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const themeToggler = document.querySelector(".theme-toggler");
        const body = document.body;

        // Load theme from localStorage
        if (localStorage.getItem('theme') === 'dark') {
            body.classList.add('dark-theme-variables');
        } else {
            body.classList.remove('dark-theme-variables');
        }

        // Toggle theme on button click
        themeToggler.addEventListener('click', () => {
            body.classList.toggle('dark-theme-variables');

            // Save theme preference to localStorage
            if (body.classList.contains('dark-theme-variables')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>




{{-- *******************lien utile pour ce script jquery ci dessous**************************** --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- script notification pour permission***************************************************************** --}}
{{-- <script>
    $(document).ready(function() {
        // Fonction pour récupérer le nombre de nouvelles permissions et les afficher dans la notification
        function fetchNotificationCount() {
            $.ajax({
                url: '/notifications/count',  // Route pour obtenir le nombre
                method: 'GET',
                success: function(response) {
                    // Mettre à jour le compteur avec le nombre de nouvelles permissions
                    $('.notification1 .num1').text(response.count);
                },
                error: function() {
                    console.log('Erreur lors de la récupération des permissions');
                }
            });
        }

        // Appel de la fonction lors du chargement de la page
        fetchNotificationCount();

        // Lorsque l'utilisateur clique sur la notification, on réinitialise le compteur
        $('#notificationBtn1').on('click', function() {
            $.ajax({
                url: '/notifications/reset',  // Route pour réinitialiser le compteur
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    // Réinitialiser le compteur à 0 après consultation
                    $('.notification1 .num1').text(0);
                    console.log('Compteur réinitialisé');
                    window.location.href = "{{ route('admin.permissions.index') }}";
                },
                error: function() {
                    console.log('Erreur lors de la réinitialisation du compteur');
                }
            });
        });
    });
</script> --}}


{{-- script notification pour conge************************************************************************ --}}
{{-- <script>
    $(document).ready(function() {
        // Fonction pour récupérer le nombre de nouvelles permissions et les afficher dans la notification
        function fetchNotificationCountConge() {
            $.ajax({
                url: '/notifications/congeCount',  // Route pour obtenir le nombre
                method: 'GET',
                success: function(response) {
                    // Mettre à jour le compteur avec le nombre de nouvelles permissions
                    $('.notification2 .num2').text(response.count);
                },
                error: function() {
                    console.log('Erreur lors de la récupération des permissions');
                }
            });
        }

        // Appel de la fonction lors du chargement de la page
        fetchNotificationCountConge();

        // Lorsque l'utilisateur clique sur la notification, on réinitialise le compteur
        $('#notificationBtn2').on('click', function() {
            $.ajax({
                url: '/notifications/congeReset',  // Route pour réinitialiser le compteur
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    // Réinitialiser le compteur à 0 après consultation
                    $('.notification2 .num2').text(0);
                    console.log('Compteur réinitialisé');
                    window.location.href = "{{ route('admin.conges.index') }}";
                },
                error: function() {
                    console.log('Erreur lors de la réinitialisation du compteur');
                }
            });
        });
    });
</script> --}}

{{-- **********************notification fonctionne avec suppression --}}
{{-- <script>
    $.ajax({
    url: '/admin.conges.destroy' + id,  // Suppression par AJAX
    type: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}'
    },
    success: function(response) {
        if (response.success) {
            // Mettre à jour le compteur des notifications de congés
            fetchNotificationCountConge();
            alert('Employé supprimé avec succès');
        } else {
            alert('Erreur lors de la suppression');
        }
    },
        error: function() {
            alert('Erreur lors de la suppression');
        }
    });

</script>

<script>
    $.ajax({
    url: '/admin.permissions.destroy' + id,  // Suppression par AJAX
    type: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}'
    },
    success: function(response) {
        if (response.success) {
            // Mettre à jour le compteur des notifications de congés
            fetchNotificationCount();
            alert('Employé supprimé avec succès');
        } else {
            alert('Erreur lors de la suppression');
        }
    },
        error: function() {
            alert('Erreur lors de la suppression');
        }
    });

</script> --}}