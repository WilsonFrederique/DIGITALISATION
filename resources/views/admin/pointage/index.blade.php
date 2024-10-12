@extends('base')

@section('title', "PAGE POINTAGES")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>POINTAGES</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Pointage</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Page Pointage</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="#" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                    <a href="#" class="btn-download">
                        <i class='bx bx-plus-medical'></i>
                        <span class="text">Nouveau Pointage</span>
                    </a>
                </div>
            </div>

            <!-- ************************************************ -->

            <ul class="box-info">
                <li>
                    <i class='bx bxs-notification'></i>
                    <span class="text">
                        <h3 class="txt-box-top">{{ $totalPointageAujourdhui }}</h3>
                        <p class="txt-box-bottom">Total Présent(e)s</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-notification-off' ></i>
                    <span class="text">
                        <h3 class="txt-box-top">{{ $countEmployesSansPointagesAujourdhuit }}</h3>
                        <p class="txt-box-bottom">Total Absent(e)s</p>
                    </span>
                </li>
            </ul>

            <!-- *********************************************** -->

            {{-- ---------- Liste des Present(e)s ----------- --}}
            <div class="table-date">
                <div class="orber">
                    <div class="head">
                        <h3>Liste des présents</h3>
                        <form class="tbl-tete-droit" action="#">
                            <div class="inputDate">
                                <input class="input-rech-date-point" type="date">
                            </div>
                        </form>
                    </div>
                    <table>
                        <thead class="thead">
                            <tr>
                                <th>Profil</th>
                                <th>Date</th>
                                <th>Heur</th>
                                <th>Poste</th>
                                <th>Pointage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($pointages as $pointage)
                            <tr>
                                <td>
                                    {{-- Vérifier si l'employé existe avant d'afficher les informations --}}
                                    @if($pointage->employe)
                                        <img src="{{ asset($pointage->employe->images) }}" alt="">
                                        <p>{{ $pointage->employe->Nom }} {{ $pointage->employe->Prenom }}</p>
                                    @else
                                        <p>Employé non trouvé</p>
                                    @endif
                                </td>
                                {{-- Format de la date --}}
                                {{-- <td>{{ $pointage->created_at->format('d/m/Y H:i') }}</td> --}}
                                @php
                                    setlocale(LC_TIME, 'fr_FR.UTF-8');  // Définit la locale en français
                                    @endphp
                                <td>{{ $pointage->created_at->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ $pointage->created_at->format('H:i') }}</td>
                                <td>{{ $pointage->employe->Poste ?? 'Poste inconnu' }}</td>
                                <td><span class="status process">Oui</span></td>
                                <td>
                                    <div class="icon-container">
                                        <a href="#"><i class='bx bx-id-card icon-mod-del-pointag' style='color:#3025d1'></i></a>
                                        <form action="{{ route('admin.pointages.destroy', $pointage->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <i class='bx bx-trash delt-qr' style='color:#d01616'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>                                               
                    </table>
                </div>
            </div>

            {{-- ---------- Liste des absent(e)s ----------- --}}
            <div class="table-date">
                <div class="todo">
                    <div class="head">
                        <h3>Liste des absents</h3>
                        <div class="inputDate">
                            {{-- <select class="form-control">
                                <option>absent(e)s</option>
                            </select> --}}
                            <input class="input-rech-date-point" type="date">
                        </div>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employesSansPointages as $employesSansPointage)
                            <li class="absent">
                                <div class="todo-item">
                                    <img src="{{ asset($employesSansPointage->images) }}" alt="" class="imgTodo">
                                    <div class="txt-left">
                                        <p>{{ $employesSansPointage->Nom }} {{ $employesSansPointage->Prenom }}</p>
                                        <p>{{ $employesSansPointage->Poste  }}</p>
                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr ens">
                                        <p>Pointage : <span>Non</span></p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </main>
    </section>

@endsection


<style>
    .QR-icon .ens{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
    }

    .QR-icon .ens p{
        font-weight: 500;
        font-size: 1rem;
    }
    
    .QR-icon .ens p span{
        background: rgb(255, 59, 59);
        color: #fff;
        padding: 0.2rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-radius: 20%;
        font-size: 1.1rem;
    }
</style>