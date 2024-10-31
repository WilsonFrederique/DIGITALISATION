@extends('base')

@section('title', "PAGE EMPLOYES")

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

            <div class="head-title">
                <div class="left">
                    <h1>EMPLOYEES</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Employees</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Page Employees</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="{{ route('admin.listes_profils') }}" class="imprimer-tout">
                        <i class='bx bx-id-card'></i>
                    </a>
                    <a href="{{ route('admin.tout_pdf_employe') }}" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                    <a onclick="nouveauEmployes()" href="{{ route('admin.employes.create') }}" class="btn-download">
                        <i class='bx bx-plus-medical'></i>
                        <span class="text">Nouveau Employe</span>
                    </a>
                </div>
            </div>

            <!-- ************************************************ -->

            <ul class="box-info">
                <li>
                    <i class='bx bxs-briefcase-alt-2'></i>
                    <span class="text">
                        <h3 class="txt-box-top">{{ $totalEmployes }}</h3>
                        <p class="txt-box-bottom">Total des Employés</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-notification'></i>
                    <span class="text">
                        <h3 class="txt-box-top">{{ $countPresent }}</h3>
                        <p class="txt-box-bottom">Total Present(e)s</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-notification-off' ></i>
                    <span class="text">
                        <h3 class="txt-box-top">{{ $countAbsent }}</h3>   
                        <p class="txt-box-bottom">Total Absent(e)s</p>
                    </span>
                </li>
            </ul>

            <!-- ********************* Table **************************** -->
            <div class="table-date">
                {{-- ------------- Les employes --------------- --}}
                <div class="orber">
                    <div class="head">
                        <h3>Liste des employees</h3>
                        <form action="{{ route('admin.employes.index') }}" method="GET">
                            <select name="RechercherPoste" class="form-control-employe">
                                <option value="">Tout les postes</option>
                                <option value="SG">SG</option>
                                <option value="REC">REC</option>
                                <option value="Port01">Port01</option>
                                <option value="Port02">Port02</option>
                            </select>
                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                <i class='bx bx-search icon-tbl'></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.employes.index') }}"><i class='bx bx-filter icon-tbl'></i></a>
                    </div>
                    <table>
                        <thead class="thead">
                            <tr>
                                <th>Profil</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($employes as $employe)
                            <tr>
                                <td>
                                    @php
                                        // Trouver l'image associée à l'employé
                                        $image = $latestImages->firstWhere('numEmp', $employe->numEmp);
                                    @endphp
                                    @if($image && $image)
                                        <img class="img-form" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                                    <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                </td>
                                <td>
                                    <div class="icon-container">
                                        <a href=""><i class='bx bx-id-card' style="font-size: 1.1rem; color: #2271ff;"></i></a>
                                        <a href="{{ route('page_pdf', ['id' => $employe->numEmp]) }}"><i class='bx bx-printer' style='color:#228e8a'  ></i></a>
                                        <a href="{{ route('admin.employes.edit', $employe->numEmp) }}"><i class='bx bx-edit btn-modif' style='color:#0a6202'  ></i></a>
                                        <form id="deleteForm-{{ $employe->numEmp }}" action="{{ route('admin.employes.destroy', $employe->numEmp) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <i class='bx bx-trash btn-suppr' style='color:#d01616'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- ------------- Les superviseur ------------- --}}
                <div class="todo">
                    <div class="head">
                        <h3>Superviseur</h3>
                        <a href="{{ route('admin.employes.create') }}"><i class='bx bx-plus icon-tbl' ></i></a>
                        <a href="{{ route('admin.employes.index') }}"><i class='bx bx-filter icon-tbl'></i></a>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employeSuperviseur as $employeSuper)
                            <li class="not-completed">
                                {{-- <p>{{ $employeSuper->Nom }} {{ $employeSuper->Prenom }}</p> --}}
                                @php
                                    $titre = '';
                                    if ($employeSuper->Sexe == 'Féminin' && $employeSuper->Situation == 'Célibataire') {
                                        $titre = 'Mlle';
                                    } elseif ($employeSuper->Sexe == 'Féminin') {
                                        $titre = 'Mme';
                                    } else {
                                        $titre = 'Mr';
                                    }
                                @endphp
                                <p>{{ $titre }} {{ $employeSuper->Prenom }}</p>
                                <div class="" style="grid: flex; align-content: center; gap: 0.6rem;">
                                    <div style="display: flex; align-content: center; gap: 0.6rem;" class="div-btn-top">
                                        <a href=""><i class='bx bx-id-card' style="font-size: 1.1rem; color: #2271ff;"></i></a>
                                        <a href="{{ route('page_pdf', ['id' => $employeSuper->numEmp]) }}"><i class='bx bx-printer' style='color:#228e8a'  ></i></a>
                                        <a href="{{ route('admin.employes.edit', $employeSuper->numEmp) }}"><i class='bx bx-edit btn-modif' style='color:#0a6202'  ></i></a>
                                        <form id="deleteForm-{{ $employeSuper->numEmp }}" action="{{ route('admin.employes.destroy', $employeSuper->numEmp) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <i class='bx bx-trash btn-suppr' style='color:#d01616'></i>
                                            </button>
                                        </form>
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

