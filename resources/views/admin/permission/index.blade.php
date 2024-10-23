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
                    <h1>PERMISSION</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Permission</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="{{ route('admin.permissions.index') }}">Page Permission</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-imprimer-ajout">
                    <a href="#" class="imprimer-tout">
                        <i class='bx bx-printer'></i>
                    </a>
                    <a href="{{ route('admin.permissions.create') }}" class="btn-download">
                        <i class='bx bx-plus-medical'></i>
                        <span class="text">Nouveau Permission</span>
                    </a>
                </div>
            </div>

            <!-- ********************* Table En Attente ************************* -->
            <div class="table-date">
                <div class="todo">
                    <div class="head">
                        <h3>EMPLOYÉS QUI ONT PRIS DES PERMISSIONS</h3>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($employes as $employe)
                            <li class="permission">
                                <div class="todo-item">
                                    @php
                                        $image = $latestImages->firstWhere('numEmp', $employe->numEmp);
                                    @endphp
                                    @if($image)
                                        <img class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;"></i>
                                    @endif
                                    <div class="txt-left">
                                        <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>

                                        @foreach ($employe->permissions as $permission)
                                            <p class="date-permission">{{ \Carbon\Carbon::parse($permission->FaiLe)->translatedFormat('d F Y') }}</p>
                                        @endforeach

                                        <p style="color: #1a4596">En attente...</p>
                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr">
                                        <a href=""><i class='bx bx-detail' style='color:#1f2dad'></i></a>
                                        <a href="{{ route('admin.valid.edit', $permission->id) }}"><i class='bx bx-send' style='color:#01011b'></i></a>
                                        <a href="{{ route('admin.perm.edit', $permission->id) }}"><i class='bx bx-edit' style='color:#0a6202'></i></a>
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <a href="#"><i class='bx bx-trash delt-qr' style='color:#d01616'></i></a>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- ********************* Table Valid ou Invalid ************************* -->
            <div class="table-date">
                {{-- Validation Oui --}}
                <div class="todo">
                    <div class="head">
                        <h3 style="color: #450ae7; font-size: 1rem;">Liste des permissions générée avec succès</h3>
                        <i class='bx bx-plus icon-tbl icon-btn-plus' ></i>
                        <i class='bx bx-filter icon-tbl'></i>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($permissionAccepters as $employe)
                            {{-- ------- Date en tête -------- --}}
                            <div class="bottom-oui" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                                <div class="vald">
                                    <p>Validation <span style="background: #2271ff; padding: 0 0.5rem; color: #fff; border-radius: 10px;">Oui</span></p>
                                </div>
                            </div>
                            {{-- ------- Content Oui ------- --}}
                            <li class="permission">
                                <div class="todo-item">
                                    @php
                                        $image = $latestImages->firstWhere('numEmp', $employe->numEmp);
                                    @endphp
                                    @if($image && $image)
                                        <img class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                                    <div class="txt-left">
                                        <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr">
                                        <a href=""><i class='bx bx-detail' style='color:#1f2dad'  ></i></a>
                                        @foreach ($employe->permissions as $permission)
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <a href="#"><i class='bx bx-trash delt-qr' style='color:#d01616'  ></i></a>
                                            </button>
                                        </form>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                
                {{-- Validation Non --}}
                <div class="todo">
                    <div class="head">
                        <h3 style="color: #f04040; font-size: 1rem;">Liste des permissions refusés</h3>
                        <i class='bx bx-plus icon-tbl icon-btn-plus' ></i>
                        <i class='bx bx-filter icon-tbl'></i>
                    </div>
                    <ul class="todo-list todo-color">
                        @foreach ($permissionRefusee as $employe)
                            {{-- ------- Date en tête -------- --}}
                            <div class="bottom-oui" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.3rem;">
                                <div class="vald">
                                    <p>Validation <span style="background: #fd6a57; padding: 0 0.5rem; color: #fff; border-radius: 10px;">Non</span></p>
                                </div>
                            </div>
                            {{-- ------- Content Oui ------- --}}
                            <li class="permission-non">
                                <div class="todo-item">
                                    @php
                                        $image = $latestImages->firstWhere('numEmp', $employe->numEmp);
                                    @endphp
                                    @if($image && $image)
                                        <img class="imgTodo" src="{{ asset($image->imgProfil) }}" alt="Image actuelle">
                                    @else
                                        <i class='bx bx-user' style="font-size: 2.4rem;" ></i>
                                    @endif
                                    <div class="txt-left">
                                        <p>{{ $employe->Nom }} {{ $employe->Prenom }}</p>
                                    </div>
                                </div>
                                <div class="QR-icon">
                                    <div class="icon-container icon-del-mod-qr">
                                        <a href=""><i class='bx bx-detail' style='color:#1f2dad'  ></i></a>
                                        @foreach ($employe->permissions as $permission)
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                <a href="#"><i class='bx bx-trash delt-qr' style='color:#d01616'  ></i></a>
                                            </button>
                                        </form>
                                        @endforeach
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