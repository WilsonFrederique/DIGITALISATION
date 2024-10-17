<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>CONNEXION</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- ============= Mon Css ============= -->
     <link rel="stylesheet" href="assets/css/style.css">

     <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body, input{
            font-family: 'Poppins', sans-serif;    
        }

        .container{
            position: relative;
            width: 100%;
            min-height: 100vh;
            background-color: #fff;
            overflow: hidden;
        }

        .container:before{
            content: '';
            position: absolute;
            width: 2000px;
            height: 2000px;
            border-radius: 50%;
            background: linear-gradient(-45deg, #4481eb, #04befe);
            top: -10%;
            right: 48%;
            transform: translateY(-50%);
            z-index: 6;
            transition: 1.8s ease-in-out;
        }

        .forms-container{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .signin-signup{
            position: absolute;
            top: 50%;
            left: 75%;
            transform: translate(-50%, -50%);
            width: 50%;
            display: grid;
            grid-template-columns: 1fr;
            z-index: 5;
            transition: 1s 0.7s ease-in-out;
        }

        form{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 5rem;
            overflow: hidden;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            transition: 0.2s 0.7s ease-in-out;
        }

        form.sign-in-form{
            z-index: 2;
        }

        form.sign-up-form{
            z-index: 1;
            opacity: 0;
        }

        .title{
            font-size: 2.2rem;
            color: #444;
            margin-bottom: 10px;
        }

        .input-field{
            max-width: 380px;
            width: 100%;
            height: 55px;
            background-color: #f0f0f0;
            margin: 10px 0;
            border-radius: 55px;
            display: grid;
            grid-template-columns: 15% 85%;
            padding: 0 .4rem;
        }

        .input-field i{
            text-align: center;
            line-height: 55px;
            color: #acacac;
            font-size: 1.1rem;
        }

        .input-field input{
            background: none;
            outline: none;
            border: none;
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }

        .input-field input::placeholder{
            color: #aaa;
            font-weight: 500;
        }

        .btn{
            width: 150px;
            height: 49px;
            border: none;
            outline: none;
            border-radius: 49px;
            cursor: pointer;
            background-color: #5995fd;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
            margin: 10px 0;
            transition: .5s;
        }

        .btn:hover{
            background: #4d84ed;
        }

        .social-text{
            padding: .7rem 0;
            font-size: 1rem;
        }

        .social-media{
            display: flex;
            justify-content: center;
        }

        .social-icon{
            height: 46px;
            width: 46px;
            border: 1px solid #333;
            margin: 0 0.45rem;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #333;
            font-size: 1.1rem;
            border-radius: 50%;
            transition: 0.3s;
        }

        .social-icon:hover{
            color: #4481eb;
            border-color: #4481eb;
        }

        .panels-container{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            /* background-color: green; */
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .panel{
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-around;
            text-align: center;
            z-index: 7;
        }

        .left-panel{
            pointer-events: all;
            /* padding: 3rem 15% 2rem 12%; */
            padding: 3rem 5% 2rem 12%;
        }

        .right-panel{
            pointer-events: none;
            /* padding: 3rem 12% 2rem 17%; */
            padding: 3rem 12% 2rem 10%;
        }

        .panel .content{
            color: #fff;
            transition: .9s .6s ease-in-out;
        }

        .panel h3{
            font-weight: 600;
            line-height: 1;
            font-size: 1.5rem;
        }

        .panel p{
            font-size: 0.95rem;
            padding: 0.7rem 0;
        }

        .btn.transparent{
            margin: 0;
            background: none;
            border: 2px solid #fff;
            width: 130px;
            height: 41px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .image{
            width: 100%;
            transition: 1.1s .4s ease-in-out;
        }

        .right-panel .content, .right-panel .image{
            transform: translateX(800px);
        }


        /* =========== ANIMATION ========== */

        .container.sign-up-mode:before{
            transform: translate(100%, -50%);
            right: 52%;
        }

        .container.sign-up-mode .left-panel .image, 
        .container.sign-up-mode .left-panel .content{
            transform: translateX(-800px);
        }

        .container.sign-up-mode .right-panel .content, 
        .container.sign-up-mode .right-panel .image{
            transform: translateX(0px);
        }

        .container.sign-up-mode .left-panel{
            pointer-events: none;
        }

        .container.sign-up-mode .right-panel{
            pointer-events: all;
        }

        .container.sign-up-mode .signin-signup{
            left: 25%;
        }

        .container.sign-up-mode form.sign-in-form{
            z-index: 1;
            opacity: 0;
        }

        .container.sign-up-mode form.sign-up-form{
            z-index: 2;
            opacity: 1;
        }


        /* ========= Responsive ======== */

        @media (max-width: 870px){
            .container{
                min-height: 800px;
                height: 100vh;
            }

            .container:before{
                /* display: none; */
                width: 1500px;
                height: 1500px;
                left: 30%;
                bottom: 68%;
                transform: translateX(-50%);
                right: initial;
                top: initial;
                transition: 2s ease-in-out;
            }

            .signin-signup{
                width: 100%;
                left: 50%;
                top: 95%;
                transform: translate(-50%, -100%);
                transition: 1s 0.8s ease-in-out;
            }

            .panels-container{
                /* background-color: green;
                z-index: 10; */
                grid-template-columns: 1fr;
                grid-template-rows: 1fr 2fr 1fr;
            }

            .panel{
                flex-direction: row;
                justify-content: space-around;
                align-items: center; 
                padding: 2.5rem 8%;
            }

            .panel .content{
                padding-right: 15%;
                transition: 0.7s 0.8s ease-in-out;
            }

            .panel h3{
                font-size: 1.2rem;
            }

            .panel p{
                font-size: 0.7rem;
                padding: 0.5rem 0;
                margin-bottom: 1rem;
            }

            .btn.transparent{
                width: 110px;
                height: 35px;
                font-size: 0.7rem;
            }

            .image{
                width: 200px;
                position: absolute;
                right: 2.7rem;
                top: 7.4rem;
                transition: 0.7s 0.6s ease-in-out;
            }

            .left-panel{
                grid-row: 1 / 2;
            }

            .right-panel{
                grid-row: 3 / 4;
            }

            .right-panel .content, .right-panel .image{
                transform: translateY(300px);
            }

            .container.sign-up-mode:before{
                transform: translate(-50%, 100%);
                bottom: 32%;
                right: initial;
            }

            .container.sign-up-mode .left-panel .image, 
            .container.sign-up-mode .left-panel .content{
                transform: translateY(-300px);
            }

            .container.sign-up-mode .signin-signup{
                top: 5%;
                transform: translate(-50%, 0);
                left: 50%;
            }
        }

        @media (max-width: 570px){
            form{
                padding: 0 1.5rem;
            } 

            .image{
                display: none;
            }

            .panel .content{
                padding: 0.5rem 1rem;
            }

            .container:before{
                bottom: 72%;
                left: 50%;
            }

            .container.sigsign-up-mode:before{
                bottom: 28%;
                left: 50%;
            }
        }
     </style>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- =========================== Login ======================== -->
                <form method="POST" action="{{ route('auth.verification') }}" class="sign-in-form">
                    @csrf
                    <h2 class="title">Se connecter</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="E-mail">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>

                    <button type="submit" class="btn solid">CONNEXION</button>
                    {{-- <input type="submit" value="CONNEXION" class="btn solid"> --}}

                    <p class="social-text">Ou connectez-vous avec des plateformes sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>

                <!-- ========================== Register ====================== -->
                <form action="" class="sign-up-form">
                    <h2 class="title">S'inscrire</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Numéro CIN">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="E-mail">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mot de passe">
                    </div>
                    <input type="submit" value="S'inscrire" class="btn solid">

                    <p class="social-text">Ou inscrivez-vous avec des plateformes sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h1>Nouveau ici ?</h1>
                    <p>Rejoignez-nous dès aujourd'hui pour bénéficier de toutes nos fonctionnalités exclusives et faire partie de notre communauté grandissante !</p>
                    <button class="btn transparent" id="sign-up-btn">S'inscrire</button>

                    <img src="{{ asset('assets/images/loging.svg') }}" class="image" alt="">
                </div>
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h1>L'un d'entre nous ?</h1>
                    <p>Déjà membre ? Connectez-vous pour accéder à votre compte et profiter de tous nos services !</p>
                    <button class="btn transparent" id="sign-in-btn">Se connecter</button>

                    <img src="{{ asset('assets/images/register1.svg') }}" class="image" alt="">
                </div>
            </div>
        </div>
    </div>
    
    <!-- =========== Mon Js =========== -->
     <script src="assets/script/script.js"></script>

     <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        sign_up_btn.addEventListener('click', () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener('click', () => {
            container.classList.remove("sign-up-mode");
        });
     </script>
</body>
</html>