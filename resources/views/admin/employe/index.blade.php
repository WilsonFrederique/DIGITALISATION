@extends('base')

@section('title', "PAGE POINTAGES")

@section('container')

    <!-- --------------------- Main --------------------- -->
    <section id="content">
        <main>
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
                    <a href="#" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                    <a href="{{ route('admin.employes.create') }}" class="btn-download">
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
                        <h3 class="txt-box-top">1943</h3>
                        <p class="txt-box-bottom">Total Present(e)s</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-notification-off' ></i>
                    <span class="text">
                        <h3 class="txt-box-top">543</h3>
                        <p class="txt-box-bottom">Total Absent(e)s</p>
                    </span>
                </li>
            </ul>

            <!-- ********************* Table **************************** -->

            <div class="table-date">
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
                                <th>Date d'entrée</th>
                                <th>Poste</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($employes as $employe)
                            <tr>
                                <td>
                                    <img src="{{ asset($employe->images) }}" alt="">
                                    <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                </td>
                                <td>{{ $employe->DatEntre }}</td>
                                <td><span class="status poste">{{ $employe->Poste }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="todo">
                    <div class="head">
                        <h3>Action</h3>
                        <a href="{{ route('admin.employes.create') }}"><i class='bx bx-plus icon-tbl' ></i></a>
                        <a href="{{ route('admin.employes.index') }}"><i class='bx bx-filter icon-tbl'></i></a>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employes as $employe)
                        <li class="not-completed">
                            <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                            <div class="icon-container">
                                <a href="#"><i class='bx bx-printer' style='color:#228e8a'  ></i></a>
                                <a href="{{ route('admin.employes.edit', $employe->numEmp) }}"><i class='bx bx-edit btn-modif' style='color:#0a6202'  ></i></a>
                                <form action="{{ route('admin.employes.destroy', $employe->numEmp) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="border: none; background: none; cursor: pointer;">
                                        <i class='bx bx-trash btn-suppr' style='color:#d01616'></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </main>
    </section>

@endsection
