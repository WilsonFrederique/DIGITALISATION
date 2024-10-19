@extends('base')

@section('title', "PAGE PERMISSION")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>

            {{-- --------- Plus d'info ------------ --}}
            <div class="place-plus-info">
                <div class="plc">
                    {{-- icon --}}
                    <a href="">
                        <div class="i-icon">
                            <i class='bx bx-pin'></i>
                        </div>
                    </a>
                    {{-- btns --}}
                    <div class="a-txt">
                        {{-- Permission --}}
                        <a href="#">
                            <div>
                                <p>Permission</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                        {{-- Congé --}}
                        <a href="#">
                            <div>
                                <p>Congé</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                        {{-- Mission --}}
                        <a href="#">
                            <div>
                                <p>Mission</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                        {{-- Messages --}}
                        <a href="#">
                            <div>
                                <p>Messages</p>
                                <div>
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="head-title">
                <div class="left">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.permissions.index') }}">Page Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="">Modification</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ********************* Formulaire ************************* -->
            <div class="table-date">
                <div class="todo">
                    <ul class="todo-list todo-color">
                        <div class="container-frm-empl">
                            <header>INSCRIPTION</header>
                    
                            <form>
                                
                                @csrf
                                
                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title">Détails de l'identité</span>
                    
                                        <div class="fields">
                                            <div class="input-field-div">
                                                <label>CIN de l'expéditeur</label>
                                                <input name="" value="" type="text" placeholder="CIN de l'expéditeur">
                                            </div>
                                            <div class="input-field-div">
                                                <label>CIN du Destinateur</label>
                                                <input name="" value="" type="text" placeholder="CIN du Destinateur">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Année</label>
                                                <input name="" value="" type="text" placeholder="Année">
                                            </div>
                    
                                            <div class="input-field-div">
                                                <label>Mois</label>
                                                <input name="" value="" type="date" placeholder="Mois">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Cumul annuel</label>
                                                <input name="" value="" type="text" placeholder="Cumul annuel">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de début</label>
                                                <input name="" value="" type="date" placeholder="Date de début">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de fin</label>
                                                <input name="" value="" type="date" placeholder="Date de fin">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Regroupement requestes</label>
                                                <input name="" value="" type="text" placeholder="Regroupement requestes (Perm/Conge)">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="details ID">                    
                                        <div class="fields">
                                            <div class="input-field-div">
                                                <label>Date de départ</label>
                                                <input name="" value="" type="date" placeholder="Date de départ">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de retour</label>
                                                <input name="" value="" type="date" placeholder="Date de retour">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Fonctions</label>
                                                <input name="" value="" type="text" placeholder="Fonctions">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Service</label>
                                                <input name="" value="" type="text" placeholder="Service">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Direction</label>
                                                <input name="" value="" type="text" placeholder="Direction">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de délivrance</label>
                                                <input name="" value="" type="date" placeholder="Date de délivrance">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Lieu de délivrance</label>
                                                <input name="" value="" type="text" placeholder="Lieu de délivrance">
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Personnel</label>
                                                <select name="" id="Personnel" class="form-control">
                                                    <option value="">Sélectionner le sexe</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Commune</label>
                                                <select name="" id="Personnel" class="form-control">
                                                    <option value="">Sélectionner le sexe</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Quartier</label>
                                                <select name="" id="Personnel" class="form-control">
                                                    <option value="">Sélectionner le sexe</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>Lot</label>
                                                <input name="" value="" type="text" placeholder="Lot">
                                            </div>
                                        </div>
                    
                                        <button type="submit" class="nextBtn">
                                            <span class="btnText">ENREGISTRER</span>
                                            <i class='bx bx-save' ></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </ul>
                </div>
            </div>

        </main>
    </section>

@endsection

{{-- -------------------------- Css pour la formulaire ------------------------------ --}}
<style>
    *{
        padding: 0;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    .container-QR{
        width: 100%;
        padding: 10px 35px;
        position: relative;
        top: 100%;
        left: 50%;
        transform: translate(-50%, 0%);
        background: var(--color-frm-permission-bg);
        border-radius: 10px;
    }

    .tex-long{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .date-lettre{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .da2{
        width: 280px;
        gap: 10px;
    }

    .dd2{
        width: 430px;
        gap: 10px;
    }

    .frmBottom{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .div-gauche-input{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container-QR p{
        font-weight: 600;
        font-size: 15px;
    }

    .div-img-frm{
        display: none;
    }

    .container-QR input{
        width: 100%;
        height: 45px;
        border: 1px solid var(--color-border-frm-permission);
        background: var(--color-bg-input-frm-employe);
        outline: 0;
        padding: 10px;
        margin: 5px 0 15px;
        border-radius: 5px;
    }

    .container-QR .input{
        width: 90%;
        height: 45px;
        border: 1px solid #494eea;
        outline: 0;
        padding: 10px;
        margin: 10px 0 20px;
        border-radius: 5px;
    }

    .container-QR textarea{
        width: 100%;
        height: 70px;
        border: 1px solid #494eea;
        outline: 0;
        padding: 10px;
        margin: 10px 0 20px;
        border-radius: 5px;
    }

    .container-QR .inputImg{
        height: 45px;
        border: 0px solid #494eea;
        outline: 0;
        padding: 10px;
        margin: 10px 0 20px;
        border-radius: 5px;
    }

    .container-QR button{
        width: 100%;
        height: 50px;
        background: #494eea;
        color: #fff;
        border: 0;
        outline: 0;
        border-radius: 5px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        margin: 20px 0;
        font-weight: 500;
    }

    #imgBox{
        width: 200px;
        border-radius: 5px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 1s;
    }

    #imgBox img{
        width: 100%;
        height: 200px;
    }

    #imgBox.show-img{
        max-height: 300px;
        margin: 10px auto;
        border: 1px solid #d1d1d1;
    }

    .error{
        animation: shake 0.1s linear 10;
    }

    @keyframes shake{
        0%{
            transform: translateX(0);
        }
        25%{
            transform: translateX(-2px);
        }
        50%{
            transform: translateX(0);
        }
        75%{
            transform: translateX(2px);
        }
        100%{
            transform: translateX(0);
        }
    }
</style>
