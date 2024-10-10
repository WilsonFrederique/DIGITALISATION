<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIN</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<style>
    .container{
        background-image: url("assets/images/bg.png");
    }

    .container-badje .profil-personne{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    .container-badje .profil-personne .img-profil .img-badje{
        width: 9rem;
        height: 9rem;
        position: absolute;
        left: 1rem;
        top: 1rem;
        border-radius: 15%;
    }

    .place{
        width: 100%;
        background: transparent;
        box-shadow: 0 0 4px #fff;
        border-radius: 10px;
        margin-top: 2.5rem;
        padding: 0.1rem;
        padding-left: 0.5rem;

    }

    .place .tel{
        font-size: 1.5rem;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .sectBadje{
        position: absolute;
        min-height: 70vh;
        width: 100%;
        left: 1rem;
        top: 0;
        margin-top: 5rem;
        display: grid;
        gap: 1rem;
        align-items: center;
        color: #fff;
        perspective: 1000px;
    }

    body{
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e3f2fd;
    }

    .container-badje{
        background-size: cover;
        position: relative;
        padding: 25px;
        border-radius: 28px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    header, .logo-badje{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo-badje .img-badje{
        width: 48px;
        margin-right: 10px;
    }

    h5{
        font-size: 16px;
        font-weight: 400;
        color: #fff;
    }

    header .chip{
        width: 65px;
        height: 4rem;
        border-radius: 50%;
        box-shadow: 0 0 4px #FFF;
    }

    h6{
        color: #fff;
        font-size: 11px;
        font-weight: 400;
    }

    h5.number{
        margin-top: 4px;
        font-size: 18px;
        letter-spacing: 1px;
    }

    h5.name{
    margin-top: 20px;
    }

    .container-badje .card-details{
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }
</style>

<body>
    <section class="sectBadje">
        <div class="container container-badje">
            <header>
                <span class="logo logo-badje">
                    <img class="img-badje" src="assets/images/logo2.png" alt="">
                    <h5 class="h5">REGION ANOSY</h5>
                </span>
                <img src="assets/images/chip.png" alt="" class="chip">
            </header>
    
            <div class="card-details">
                <div class="name-number">
                    <h6>Numéro CIN</h6>
                    <h5 class="number">4141 2520 2584 8565</h5>
                    <H5 class="name">WILSON Frederique</H5>
                </div>
                <div class="valid-date">
                    <h6>Validation date</h6>
                    <h5>07/24</h5>
                </div>
            </div>
        </div>

        <div class="container container-badje">
            <header class="profil-personne">
                <span class="img-profil">
                    <img class="img-badje" src="assets/images/téléchargement.jfif" alt="">
                </span>
                <span class="info-profil">
                    <h5>Numéro CIN</h5>
                    <h5>Nom</h5>
                    <h5>Prenom</h5>
                    <h5>Poste</h5>
                </span>
            </header>
    
            <div class="card-details">
                <div class="place">
                    <div class="tel">Tel : 033 00 000 00</div>
                    <!-- <div class="txt">Faritra anôsy miasa ho anao</div> -->
                </div>
            </div>
        </div>
    </section>
</body>

</html>