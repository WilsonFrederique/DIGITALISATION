<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <!-- ========= REMIX ICON (remixicon.com) ============ -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* ========= GOOGLE FOND (fonts.google.com) ========== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        /* =========== VARIABLE CSS ============ */
        :root {
            /* ************ COLORS *********** */
            /* ------- Colors mode HSL (hue, saturation, lightness) --------- */
            --white-color: hsl(0, 0%, 100%);
            --black-color: hsl(0, 0%, 0%);

            /* ********** FONT AND TYPOGRAPHE ********* */
            /* .5rem = 8px | 1rem = 16px */
            --body-font: "Poppins", sans-serif;
            --h1-font-size: 2rem;
            --normal-font-size: 1rem;
            --small-font-size: .813rem;

            /* *********** FONT WEIGGHT ************* */
            --font-medium: 500;
        }

        /* =================== BASE ==================== */
        *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body,
        input,
        button {
            font-size: var(--normal-font-size);
            font-family: var(--body-font);
        }

        body{
            color: var(--white-color);
            object-position: center;
            background-image: url({{ asset('assets/images/bg1.jpg') }});
        }

        a{
            text-decoration: none;
        }

        img{
            display: block;
            max-width: 100%;
            height: auto;
        }

        .login{
            position: relative;
            height: 100vh;
            display: grid;
            align-items: center;
        }

        .login__bg{
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .login__form{
            position: relative;
            background-color: hsla(0, 0%, 10%, .1);
            border: 2px solid var(--white-color);
            margin-inline: 1.5rem;
            padding: 2.5rem 1.5rem;
            border-radius: 1rem;
            backdrop-filter: blur(10px);
        }

        .login__title{
            text-align: center;
            font-size: var(--h1-font-size);
            margin-bottom: 1.5rem;
        }

        .login__inputs,
        .login__box{
            display: grid;
        }

        .login__inputs{
            row-gap: 1.25rem;
            margin-bottom: 1rem;
        }

        .login__box{
            grid-template-columns: 1fr max-content;
            align-items: center;
            column-gap: .75rem;
            border: 2px solid hsla(0, 0%, 100%, .7);
            padding-inline: 1.25rem;
            border-radius: 4rem;
        }

        .login__input,
        .login__button{
            border: none;
            outline: none;
        }

        .login__input{
            width: 100%;
            padding-block: .6rem;
            background: none;
            color: var(--white-color);
            position: relative;
            z-index: 1;
        }

        .login__input::placeholder{
            color: var(--white-color);
        }

        .login__box i{
            font-size: 1.25rem;
            color: var(--white-color);
        }

        .login__check,
        .login__check-box{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .login__check{
            margin-bottom: 1rem;
            font-size: var(--small-font-size);
        }

        .login__check-box{
            column-gap: .5rem;
            color: var(--white-color);
        }

        .login__check-input{
            width: 1rem;
            height: 1rem;
            accent-color: var(--white-color);
        }

        .login__forgot{
            color: var(--white-color);
        }

        .login__forgot:hover{
            text-decoration: underline;
        }

        .login__button{
            width: 100%;
            padding: 1rem;
            border-radius: 4rem;
            color: var(--black-color);
            background-color: var(--white-color);
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .login__register{
            text-align: center;
            font-size: var(--small-font-size);
        }

        .login__register a{
            color: var(--white-color);
            font-weight: 500;
        }

        .login__register a:hover{
            text-decoration: underline;
        }

        /* ============= BREAKPOINTS ================ */
        @media screen and (min-width: 576px){
            .login{
                justify-content: center;
            }
            .login__form{
                width: 432px;
                padding: 4rem 3rem 3.5rem;
                border-radius: 1.5rem;
            }
            .login__title{
                font-size: 2rem;
            }
        }
    </style>

</head>
<body>

    <div class="login">
        <!-- <img src="assets/images/bg1.jpg" alt="image" class="logon__bg"> -->

        <form action="" class="login__form">
            <h1 class="login__title">Register</h1>

            <div class="login__inputs">
                <div class="login__box">
                    <input type="text" required class="login__input" placeholder="Entrer votre numéro CIN">
                    <i class="ri-mail-fill"></i>
                </div>
                <div class="login__box">
                    <input type="text" required class="login__input" id="login-pass" placeholder="Entrer votre mail">
                    <i class="ri-lock-2-fill login__eye" id="login-eye"></i>
                </div>
                <div class="login__box">
                    <input type="text" required class="login__input" id="login-pass" placeholder="Nouveau Mot de passe">
                    <i class="ri-lock-2-fill login__eye" id="login-eye"></i>
                </div>
            </div>

            <div class="login__check">
                <input type="file" required class="login__input" id="login-pass" placeholder="Nouveau Mot de passe">
                <i class="ri-lock-2-fill login__eye" id="login-eye"></i>
            </div>

            <button type="submit" class="login__button">Login</button>

            <p class="login__register">
                Do you have an account? <a href="{{ route('auth.page_users') }}">Login</a>
            </p>
        </form>
    </div>

    <script src="assets/js/main.js"></script>

    <script>
        const showHiddenPass = (loginPass, loginEye) => {
            const input = document.getElementById(loginPass),
                iconEye = document.getElementById(loginEye)

                iconEye.addEventListener('click', () => {
                    // Chage password to text
                    if(input.type === 'password'){
                        // Swiich to text
                        input.type = 'text';

                        // Icone change
                        iconEye.classList.add('ri-eye-line')
                        iconEye.classList.remove('ri-eye-off-line')
                    }
                    else{
                        // Swiich to password
                        input.type = 'password';

                        // Icone change
                        iconEye.classList.add('ri-eye-off-line')
                        iconEye.classList.remove('ri-eye-line')
                    }
                })
        }

        showHiddenPass('login-pass', 'login-eye')
    </script>

</body>
</html>
