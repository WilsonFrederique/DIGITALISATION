@extends('base')

@section('title', "PAGE POINTAGES")

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

            <!-- ******************** Heeder ********************* -->
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

            <!-- ******************** Box Info ********************* -->
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
                                    {{-- <img src="{{ asset($pointage->employe->images) }}" alt=""> --}}
                                    @php
                                        // Récupère l'image de profil de l'employé correspondant au pointage
                                        $image = $employesAvecImages->firstWhere('numEmp', $pointage->employe->numEmp);
                                    @endphp
                                    @if($image)
                                        <img src="{{ asset($image->imgProfil) }}" alt="Image de profil" class="imgTodo">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                                    @endif
                                    <p>{{ $pointage->employe->Nom }} {{ $pointage->employe->Prenom }}</p>
                                </td>
                                {{-- Format de la date --}}
                                {{-- <td>{{ $pointage->created_at->format('d/m/Y H:i') }}</td> --}}
                                @php
                                    setlocale(LC_TIME, 'fr_FR.UTF-8');  // Définit la locale en français
                                    @endphp
                                <td>{{ $pointage->created_at->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ $pointage->created_at->format('H:i') }}</td>
                                <td>{{ $pointage->employe->Grade ?? 'Grade inconnu' }}</td>
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

            <!-- ********************* Table Permissions ou Congés ************************* -->
            <div class="table-date">
                {{-- Liste des employés ayant des permissions  --}}
                <div class="todo">
                    <div class="head">
                        <h3 style="color: #450ae7; font-size: 1rem;">Liste des employés ayant des permissions</h3>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employesQuiApermissions as $valide)
                           @foreach ($valide->conges as $conge)

                            {{-- ------- Date en tête -------- --}}
                            <div class="bottom-oui" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                                <div>
                                    Employes <span style="background: #e0018b; color: #fff; border-radius: 7px; padding: 0.4rem; padding-bottom: 0.2rem;">En permissions</span>
                                </div>
                            </div>
                            {{-- ------- Content Oui ------- --}}
                            <li class="Coge-oui">
                                <div class="todo-item">
                                    <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    <div class="txt-left">
                                        <p>{{ $valide->Nom }} {{ $valide->Prenom }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>

                {{-- Liste des employés ayant des congés --}}
                <div class="todo">
                    <div class="head">
                        <h3 style="color: #386bf7; font-size: 1rem;">Liste des employés ayant des congés</h3>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employesQuiConges as $refuse)
                        @foreach ($refuse->conges as $conge)

                            {{-- ------- Date en tête -------- --}}
                            <div class="bottom-oui" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                                <div>
                                    Employes <span style="background: #386bf7; color: #fff; border-radius: 7px; padding: 0.4rem; padding-bottom: 0.2rem;">En congés</span>
                                </div>
                            </div>
                            {{-- ------- Content Non ------- --}}
                            <li class="conge-non">
                                <div class="todo-item">
                                    <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    <div class="txt-left">
                                        <p>{{ $refuse->Nom }} {{ $refuse->Prenom }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @endforeach
                    </ul>
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
                                    {{-- <img src="{{ asset($employesSansPointage->images) }}" alt="" class="imgTodo"> --}}
                                    @php
                                        // Vérifiez si l'employé a une image de profil
                                        $image = $employesSansPointagesAvecImages->firstWhere('numEmp', $employesSansPointage->numEmp);
                                    @endphp
                                    @if($image)
                                        <img src="{{ asset($image->imgProfil) }}" alt="Image de profil" class="imgTodo">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                                    <div class="txt-left">
                                        <p>{{ $employesSansPointage->Nom }} {{ $employesSansPointage->Prenom }}</p>
                                        <p>{{ $employesSansPointage->Grade  }}</p>
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