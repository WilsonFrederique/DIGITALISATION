@extends('base')

@section('title', " Lettre de permission")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>

            {{-- --------- Plus d'info ------------ --}}
            <div class="place-plus-info">
                <div class="plc">
                    {{-- icon --}}
                    <a href="#">
                        <div class="i-icon">
                            <i class='bx bx-pin'></i>
                        </div>
                    </a>
                    {{-- btns --}}
                    <div class="a-txt">
                        {{-- Permission --}}
                         <a href="{{ route('admin.permissions.index') }}" class="notification1" id="notificationBtn1">
                            <div>
                                <p>Permission en attente</p>
                                <div>
                                    <span  class="num1">{{ $countInfo1 }}</span> 
                                </div>
                            </div>
                        </a>
                        {{-- Congé --}}
                        <a href="{{ route('admin.conges.index') }}"  class="notification2" id="notificationBtn2">
                            <div>
                                <p>Congé en attente</p>
                                <div>
                                    <span class="num2">{{ $countInfo2 }}</span>
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
                    <h1>PERMISSION</h1>
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
                            <a class="active" href=""> Lettre de permission</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="#" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                </div>
            </div>

            <!-- ********************* Table En Attente ************************* -->
            <div class="table-date">
                <div class="todo">
                    
                    <body>
                        <div class="container-permission">
                            <div class="box-permission">
                                <div class="lettre">
                    
                                    <div class="en-tete">
                                        <div class="votre">
                                            <p>{{ $employe->employeNom }} {{ $employe->employePrenom }}</p>
                                            <p>{{ $employe->employeQuartier }} {{ $employe->employeLot }}</p>
                                            <p>614, {{ $employe->employeCommune }}</p>
                                            <p>{{ $employe->employeEmail }}</p>
                                            <p>{{ $employe->employeTelephone }}</p>
                                        </div>
                                        <div class="destination">
                                            <p>À l'attention de</p>
                                            <p>{{ $employe->superviseurNom }} {{ $employe->superviseurPrenom }}</p>
                                            <p>{{ $employe->superviseurGrade }}</p>
                                            <p>REGION ANOSY</p>
                                            <p>IMMEUBLE REGION ANOSY</p>
                                            <p>614, Fort-Dauphin</p>
                                        </div>
                                    </div>
                                    
                                    <div class="date">
                                        <p>Date</p>
                                    </div>
                    
                                    <div class="date-objectif">
                                        <div class="objet-lettre">
                                            <p>Objet : Demande de permission pour {{ $employe->Raison }}</p>
                                        </div>
                                        <div></div>
                                        <div class="Mm-Mr">
                                            <p>Madame, Monsieur,</p>
                                        </div>
                                    </div>
                                    
                                    <div class="prgph">
                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> me permets de vous adresser cette lettre pour solliciter une 
                                            permission exceptionnelle pour {{ $employe->Raison }}</p>
                                        </div>
                    
                                        <span></span>
                    
                                        @php
                                            use Carbon\Carbon;
                                        @endphp

                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> souhaiterais obtenir cette permission pour la période allant du {{ Carbon::parse($employe->DateDebut)->format('d F Y') }}
                                            au {{ Carbon::parse($employe->DateFin)->format('d F Y') }}. Pendant cette période, je m'engage à {{ $employe->Engagement }}.</p>
                                        </div>
                    
                                        <span></span>
                    
                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> vous assure que j'ai pris toutes les dispositions nécessaires pour que mes 
                                            responsabilités soient couvertes durant mon absence. {{ $employe->Dispositions }}</p>
                                        </div>
                    
                                        <span></span>
                    
                                        <div class="pr1">
                                            <p class="pr"><span>Je</span> reste à votre disposition pour toute information complémentaire
                                                 ou tout document nécessaire pour appuyer ma demande. Vous pouvez me contacter {{ $employe->employeTelephone }} ou 
                                                 {{ $employe->employeEmail }}.</p>
                                        </div>
                    
                                        <span></span>
                    
                                        <div class="pr1">
                                            <p class="pr"><span>En</span> vous remerciant de votre compréhension et de votre soutien, je 
                                                vous prie d’agréer, Madame, Monsieur, l’expression de mes salutations distinguées.</p>
                                        </div>
                                    </div>
                    
                    
                                    <div class="signature">
                                        <div></div>
                                        <div id="signature">
                                            <div class="line-h"></div>
                                            [Signature] <br>
                                            {{ $employe->employePrenom }}
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </body>

                </div>
            </div>

        </main>
    </section>

@endsection

<style>
    body{
        background: #e7e6e6;
    }
    .container-permission{
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 100;
    }

    .box-permission{
        width: 90%;
        height: auto;
        padding: 30px 35px 50px 40px;
        margin: 10px;
        background: #fff;
    }

    .en-tete{
        display: flex;
        justify-content: space-between;
        line-height: 1.5;
    }

    .date{
        display: flex;
        align-items: center;
    }

    .date-objectif{
        font-size: 20px;
        line-height: 2;
        margin-left: 10%;
    }

    span{
        margin-left: 10%;
    }

    .entre-obje-Mm-Mr{
        line-height: 0;
    }

    .pr{
        line-height: 1.4;
    }

    .prgph{
        font-size: 20px;
        line-height: 1;
    }

    .signature{
        line-height: 7;
        position: relative;
        margin: 10px;
        display: flex;
        justify-content: space-between;
    }

    #signature{
        line-height: 1.5;
    }

    p{
        font-size: 19px;
    }

    .line-h{
        margin-top: 20%;
    }
</style>