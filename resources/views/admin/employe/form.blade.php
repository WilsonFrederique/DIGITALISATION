@extends('base')

{{-- @section('title', $employe->exists ? "MODIFICATION EMPLOYE" : "AJOUT EMPLOYE") --}}
@section('title', $employe->exists ? "MODIFICATION EMPLOYE" : "AJOUT EMPLOYE")

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
                            <a href="#">Employees</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.employes.index') }}">Page Employees</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.employes.create') }}">Ajout Employe</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-date">
                <div class="todo">
                    <ul class="todo-list todo-color">
                        <div class="container-frm-empl">
                            {{-- <header>INSCRIPTION</header> --}}

                            @if ($employe->exists)
                                <header>MODIFICATION</header>
                            @else
                                <header>INSCRIPTION</header>
                            @endif
                    
                            <form method="POST" action="{{ $employe->exists ? route('admin.employes.update', $employe->numEmp) : route('admin.employes.store') }}" class="login__form" enctype="multipart/form-data">
                                
                                @csrf

                                @if ($employe->exists)
                                    @method('PUT')
                                @endif
                                
                                <div class="form first">
                                    <div class="details personal">
                                        <span class="title">Détails de l'identité</span>
                    
                                        <div class="fields">
                                            <div class="input-field-div">
                                                <label>Numéro CIN</label>
                                                <input name="numEmp" value="{{ $employe->numEmp }}" type="text" placeholder="Numéro CIN">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Nom</label>
                                                <input name="Nom" value="{{ $employe->Nom }}" type="text" placeholder="Nom">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Prenom</label>
                                                <input name="Prenom" value="{{ $employe->Prenom }}" type="text" placeholder="Prenom">
                                            </div>
                    
                                            <div class="input-field-div">
                                                <label>Date de naissance</label>
                                                <input name="Naissance" value="{{ $employe->Naissance }}" type="date" placeholder="Date de naissance">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Lieu de naissance</label>
                                                <input name="LieuDeNaissance" value="{{ $employe->LieuDeNaissance }}" type="text" placeholder="Lieu de naissance">
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Sexe</label>
                                                <select name="Sexe" id="Personnel" class="form-control" required>
                                                    <option value="">Sélectionner le sexe</option>
                                                    <option value="Masculin" {{ $employe->Sexe == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                                    <option value="Féminin" {{ $employe->Sexe == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Situation matrimonial</label>
                                                <select name="Situation" id="Personnel" class="form-control">
                                                    <option value="Célibataire" {{ $employe->Situation == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                                    <option value="Marie" {{ $employe->Situation == 'Marie' ? 'selected' : '' }}>Marié</option>
                                                    <option value="Divorce" {{ $employe->Situation == 'Divorce' ? 'selected' : '' }}>Divorce</option>
                                                    <option value="Concubinage" {{ $employe->Situation == 'Concubinage' ? 'selected' : '' }}>Concubinage</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>Adresse e-mail</label>
                                                <input name="Email" value="{{ $employe->Email }}" type="email" placeholder="Adresse e-mail">
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="details ID">                    
                                        <div class="fields">
                                            <div  class="input-field-div">
                                                <label>Numéro de téléphone</label>
                                                <input name="Telephone" value="{{ $employe->Telephone }}" type="text" placeholder="Numéro de téléphone">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Grade</label>
                                                <input name="Grade" value="{{ $employe->Grade }}" type="text" placeholder="Grade">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Fonctions</label>
                                                <input name="Fonctions" value="{{ $employe->Fonctions }}" type="text" placeholder="Fonctions">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Service</label>
                                                <input name="Service" value="{{ $employe->Service }}" type="text" placeholder="Service">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Direction</label>
                                                <input name="Direction" value="{{ $employe->Direction }}" type="text" placeholder="Direction">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Date de délivrance</label>
                                                <input name="DateDeDelivrance" value="{{ $employe->DateDeDelivrance }}" type="date" placeholder="Date de délivrance">
                                            </div>
                                            <div class="input-field-div">
                                                <label>Lieu de délivrance</label>
                                                <input name="LieuDeDelivrance" value="{{ $employe->LieuDeDelivrance }}" type="text" placeholder="Lieu de délivrance">
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Personnel</label>
                                                <select name="Personnel" id="Personnel" class="form-control">
                                                    <option value="Employé" {{ $employe->Personnel == 'Employé' ? 'selected' : '' }}>Employé</option>
                                                    <option value="Superviseur" {{ $employe->Personnel == 'Superviseur' ? 'selected' : '' }}>Superviseur</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Commune</label>
                                                <select name="Commune" id="Personnel" class="form-control">
                                                    <option value="Fort-Dauphin" {{ $employe->Commune == 'Fort-Dauphin' ? 'selected' : '' }}>Fort-Dauphin</option>
                                                    <option value="Mandromondromotra" {{ $employe->Commune == 'Mandromondromotra' ? 'selected' : '' }}>Mandromondromotra</option>
                                                    <option value="Manantenina" {{ $employe->Commune == 'Manantenina' ? 'selected' : '' }}>Manantenina</option>
                                                    <option value="Mahatalaky" {{ $employe->Commune == 'Mahatalaky' ? 'selected' : '' }}>Mahatalaky</option>
                                                    <option value="Soanierana" {{ $employe->Commune == 'Soanierana' ? 'selected' : '' }}>Soanierana</option>
                                                    <option value="Ampasy Nahampoana" {{ $employe->Commune == 'Ampasy Nahampoana' ? 'selected' : '' }}>Ampasy Nahampoana</option>
                                                    <option value="Manambaro" {{ $employe->Commune == 'Manambaro' ? 'selected' : '' }}>Manambaro</option>
                                                    <option value="Ifarantsa" {{ $employe->Commune == 'Ifarantsa' ? 'selected' : '' }}>Ifarantsa</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Quartier</label>
                                                <select name="Quartier" id="Personnel" class="form-control">
                                                    <option value="AMBINANIKELY" {{ $employe->Quartier == 'AMBINANIKELY' ? 'selected' : '' }}>AMBINANIKELY</option>
                                                    <option value="AMBINANIBE" {{ $employe->Quartier == 'AMBINANIBE' ? 'selected' : '' }}>AMBINANIBE</option>
                                                    <option value="AMPASIKABO" {{ $employe->Quartier == 'AMPASIKABO' ? 'selected' : '' }}>AMPASIKABO</option>
                                                    <option value="AMPOTATRA" {{ $employe->Quartier == 'AMPOTATRA' ? 'selected' : '' }}>AMPOTATRA</option>
                                                    <option value="AMPARIHY" {{ $employe->Quartier == 'AMPARIHY' ? 'selected' : '' }}>AMPARIHY</option>
                                                    <option value="AMBOVOMAIKY" {{ $employe->Quartier == 'AMBOVOMAIKY' ? 'selected' : '' }}>AMBOVOMAIKY</option>
                                                    <option value="AMPASAMASAY" {{ $employe->Quartier == 'AMPASAMASAY' ? 'selected' : '' }}>AMPASAMASAY</option>
                                                    <option value="AMPAMAKIAMBATO" {{ $employe->Quartier == 'AMPAMAKIAMBATO' ? 'selected' : '' }}>AMPAMAKIAMBATO</option>
                                                    <option value="ANDRAKARAKA" {{ $employe->Quartier == 'ANDRAKARAKA' ? 'selected' : '' }}>ANDRAKARAKA</option>
                                                    <option value="BAZARIKELY" {{ $employe->Quartier == 'BAZARIKELY' ? 'selected' : '' }}>BAZARIKELY</option>
                                                    <option value="BAZARIBE" {{ $employe->Quartier == 'BAZARIBE' ? 'selected' : '' }}>BAZARIBE</option>
                                                    <option value="BEZAVONA" {{ $employe->Quartier == 'BEZAVONA' ? 'selected' : '' }}>BEZAVONA</option>
                                                    <option value="BESONJO" {{ $employe->Quartier == 'BESONJO' ? 'selected' : '' }}>BESONJO</option>
                                                    <option value="LANIRANO" {{ $employe->Quartier == 'LANIRANO' ? 'selected' : '' }}>LANIRANO</option>
                                                    <option value="LIBANONA" {{ $employe->Quartier == 'LIBANONA' ? 'selected' : '' }}>LIBANONA</option>
                                                    <option value="TANAMBAO" {{ $employe->Quartier == 'TANAMBAO' ? 'selected' : '' }}>TANAMBAO</option>
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label for="Personnel">Secteur</label>
                                                <select name="Secteur" id="Personnel" class="form-control">
                                                    @foreach (range('A', 'Z') as $letter)
                                                        <option value="{{ $letter }}" {{ $employe->Secteur == $letter ? 'selected' : '' }}>{{ $letter }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-field-div">
                                                <label>Lot</label>
                                                <input name="Lot" value="{{ $employe->Lot }}" type="text" placeholder="Lot">
                                            </div>
                                        </div>
                    
                                        <button type="submit" class="nextBtn">
                                            @if ($employe->exists)
                                                <span class="btnText">MODIFIER</span>
                                                <i class='bx bx-edit' ></i>
                                            @else
                                                <span class="btnText">ENREGISTRER</span>
                                                <i class='bx bx-save' ></i>
                                            @endif
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
        background: var(--color-frm-employe-bg);
        border-radius: 10px;
    }

    .frm1{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
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
        border: 1px solid var(--color-border-frm-employe);
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
