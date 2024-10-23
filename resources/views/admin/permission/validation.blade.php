@extends('base')

@section('title', "VALIDATION")

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
                            <a class="active" href="">Validation</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ********************* Formulaire ************************* -->
            <div class="table-date">
                <div class="todo">

                    <form method="POST" action="{{ $permission->exists ? route('admin.updateValidation', $permission->id) : route('admin.permissions.store') }}" class="login__form" enctype="multipart/form-data">
                        @csrf
                        @if ($permission->exists)
                            @method('PUT')
                        @endif
                        
                        <div class="form first">
                            <div class="details personal">
                                <span class="title">Détails de l'identité</span>
                    
                                <div class="fields">
                                    <div class="input-field-div">
                                        <label for="Personnel">Sexe</label>
                                        <select name="Validation" id="Personnel" class="form-control">
                                            <option value="En attente..." {{ $permission->Validation == 'En attente...' ? 'selected' : '' }}>En attente...</option>
                                            <option value="Acceptée" {{ $permission->Validation == 'Acceptée' ? 'selected' : '' }}>Acceptée</option>
                                            <option value="Refusée" {{ $permission->Validation == 'Refusée' ? 'selected' : '' }}>Refusée</option>
                                        </select>
                                    </div>
                                    <div class="input-field-div">
                                        <label>CIN de l'expéditeur</label>
                                        <input name="numEmp" value="{{ $permission->numEmp }}" type="text" placeholder="CIN de l'expéditeur">
                                    </div>
                                </div>
                    
                                <button type="submit" class="nextBtn">
                                    @if ($permission->exists)
                                        <span class="btnText">MODIFIER</span>
                                        <i class='bx bx-edit'></i>
                                    @else
                                        <span class="btnText">ENVOYER</span>
                                        <i class='bx bx-send'></i>
                                    @endif
                                </button>
                    
                            </div>
                        </div>
                    </form>
                    

                </div>
            </div>

        </main>
    </section>

@endsection
