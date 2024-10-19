<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de Badge</title>

    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        .container {
            background-image: url("assets/images/bg.png");
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .sectBadje {
            position: absolute;
            min-height: 70vh;
            width: 100%;
            left: 1rem;
            top: 0;
            margin-top: 5rem;
            display: grid;
            align-items: center;
            color: #fff;
            perspective: 1000px;
            gap: 14rem;
         
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e3f2fd;
        }

        .container-badje {
            background-size: cover;
            position: relative;
            border-radius: 23px;
            max-width: 400px;
            width: 20rem;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            height: 12rem; /* Hauteur légèrement réduite */
           
        }

        header, .logo-badje {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-badje .img-badje {
            width: 120px; /* Taille ajustée de la puce */
            height: 120px; /* Taille ajustée de la puce */
            object-fit: cover; /* Assure que l'image garde les proportions sans être déformée */
            margin-top: 0.5rem;
            margin-left: -0.5rem;
        }


        .container-badje .profil-personne .img-profil
        {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

     
        .container-badje .profil-personne .img-profil .img-badje {
            width: 95px; /* Taille légèrement réduite */
            height: 100px;
            object-fit: cover; /* Maintient les proportions des images */
            margin-top: 1.3rem;
            margin-left: 1.3rem;
            /* border: solid 1px whitesmoke; */
        }

        .container-badje .profil-personne  .info-profil .profil
        {
            margin-left: 8rem;
            margin-top: -6.3rem;
        }

        .profil h5
        {
            font-weight: 900;
            font-size: 90%;
            color: whitesmoke;
        }

        .profil
        {
            height: 5rem;
            width: 10rem;
        }

        .container .container-badje .card-details .place
        {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .place
        {
            width: 17rem;
            height: 1.5rem;
            border: solid 1px whitesmoke;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.2rem;
        }

        .tel
        {
            font-size: 20px;
            font-weight: 400;
            color: whitesmoke;
        }
    
        .container-badje .card-details .place
        {
            margin-top: 1.3rem;
            margin-left: 1.3rem;
        }

        .container-badje .header-badge .logo-badje .h5
        {
            margin-top: -5rem;
            margin-left: 5.5rem;
        }

        /******************************************************************************/
        

        /* Détails à l'intérieur du badge */
        .container-badje .card-details1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; /* Adapte à la taille du badge */
            padding: 1rem;
            box-sizing: border-box;
        }

        /* Positionnement du numéro et du nom en bas à gauche */
        .container-badje .card-details1 .name-number {
            position: absolute;
            bottom: 3rem; /* Ajusté pour être près du bas */
            left: 1rem; /* Ajusté pour être près de la gauche */
            color: white;
            font-size: 0.9rem; /* Ajustez selon vos besoins */
            /* border: 1px solid orangered; */
            padding: 0.2rem;
        }

        /* Positionnement de la validation en bas à droite */
        .container-badje .card-details1 .validation {
            position: absolute;
            bottom: 3rem; /* Même alignement en bas */
            right: 3.2rem; /* Aligné à droite */
            color: white;
            font-size: 0.9rem; /* Ajustez selon vos besoins */
            /* border: 1px solid green;  */
            padding: 0.2rem;
            text-align: right;
        }



        /****************************************************************/
        .container-badje .header-badge
        {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .container-badje .header-badge .img1 .img11
        {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            width: 80px; /* Taille légèrement réduite */
            height: 80px;
            object-fit: cover; /* Maintient les proportions des images */
            margin-bottom: 28.9rem;
            margin-left: 13.8rem;
            border-radius: 50%;
        }

      
    </style>


</head>
<body>
    <section class="sectBadje">
        <!-- Première carte -->
        <div class="container container-badje">
            <header class="header-badge">
                <span class="logo logo-badje">
                    <img class="img-badje" src="assets/images/logo1.png" alt="">
                    {{-- <h5 class="h5">REGION ANOSY</h5> --}}
                </span>
                <span class="img1">
                    @php
                        $image = $latestImages->firstWhere('numEmp', $badge->numEmp);
                    @endphp

                    @if($image)
                        <img class="" class="" src="{{ $image->imgProfil }}" alt="Image de profil" 
                        style="width: 90px; height: 90px; border-radius: 50%; position: absolute; 
                        right: 1.5rem; top: 1rem; object-fit: cover; box-shadow: 0 0 5px #fff; 
                        border: 1px solid #fff;">
                    @else
                        <div class="place-img-vide" style="width: 90px; height: 90px; border-radius: 50%; position: absolute; 
                        right: 1.5rem; top: 1rem; object-fit: cover; box-shadow: 0 0 5px #fff; 
                        border: 1px solid #fff; background: #8888889f;">

                        </div>
                    @endif
                </span>
            </header>

            <div class="card-details1">
                    <div class="name-number">
                        <strong class="name">{{ $badge->employes->Prenom }}</strong><br>
                        <strong class="number">CIN: {{ $badge->numEmp }}</strong>
                    </div>

                    <div class="validation">
                        <strong>Validation date</strong><br>
                        <strong>{{ $badge->employes->DatEntre }}</strong>
                    </div>
            </div>
        </div>
    

        <!-- Deuxième carte -->
        <div class="container container-badje">
            <header class="profil-personne">
                <span class="img-profil">
                    {{-- <img src="{{ asset('images/' . $badge->imageqr) }}" alt="" class="img-badje"> --}}
                    @if ($badge->employes && $badge->imageqr) 
                    <img class="img-badje" src="{{ public_path('images/' . $badge->imageqr) }}" alt="">
                    @else
                        <img class="img-badje" src="assets/images/logo1.png" alt="">
                    @endif
                </span>
                <span class="info-profil">
                <div class="profil">
                    <strong>{{ $badge->numEmp }}</strong> <br>
                    <strong>{{ $badge->employes->Nom }}</strong><br>
                    <strong>{{ $badge->employes->Prenom }}</strong><br>
                    <strong>{{ $badge->employes->Grade }}</strong>
                </div>
                </span>
            </header>

            <div class="card-details">
                <div class="place">
                    <div class="tel">Téléphone :{{ $badge->employes->Telephone }}</div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
