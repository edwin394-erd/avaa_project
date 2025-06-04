@extends('layouts.layout')

@section('titulo-tab')
    Usuarios
@endsection

@section('contenido')
<div class="2xl:w-6/6 mx-auto py-5 px-0 md:px-5 dark:bg-slate-900">

<div id="contenedor-principal" class="flex flex-wrap p-0 min-h-[calc(90vh-4rem)] transition-all duration-500">
        <!-- Formulario para agregar usuario -->
    <div id="formulario-izquierda" class="w-full xl:w-1/4 p-0 flex flex-col mb-4 xl:mb-0 order-2 xl:order-1 transition-all duration-500">
        <div class="relative flex flex-col bg-white dark:bg-slate-900 border dark:border-gray-700 shadow-xl shadow-gray-100 dark:shadow-gray-900 rounded-l-xl p-4 h-full">
            <button id="toggle-form-btn"
                class="absolute top-2 right-2 z-20 px-2 py-1 bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 dark:bg-slate-700 dark:text-gray-100 dark:border-slate-700 dark:hover:bg-slate-800 rounded transition-all duration-300 hidden xl:block"
                style="min-width:32px;min-height:32px;">
                <span id="toggle-form-icon">⮜</span>
            </button>
                <h1 id="form-title" class="text-lg 2xl:text-xl font-bold text-gray-700 dark:text-gray-100 text-center mb-4">Agregar Becario</h1>
                <br>
                <form id="form-becario" action="{{ route('users.store') }}" method="POST" class="flex flex-col flex-1" novalidate>
                    @csrf
                    <input type="hidden" name="tipo" value="becario">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_nombre" id="becario_nombre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_nombre') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_nombre') }}"
                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
                                <label for="becario_nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                                @error('becario_nombre')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_apellido" id="becario_apellido"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_apellido') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_apellido') }}"
                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
                                <label for="becario_apellido" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Apellido
                                </label>
                                @error('becario_apellido')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="becario_email" id="becario_email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_email') border-red-500 @enderror"
                            placeholder=" " required value="{{ old('becario_email') }}">
                        <label for="becario_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Correo
                        </label>
                        @error('becario_email')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_telefono" id="becario_telefono"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_telefono') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_telefono') }}">
                                <label for="becario_telefono" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Teléfono
                                </label>
                                @error('becario_telefono')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_cedula" id="becario_cedula" maxlength="8" minlength="7"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_cedula') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_cedula') }}"
                                    oninput="this.value = this.value.replace(/[^0-9\-]/g, '')">
                                <label for="becario_cedula" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Cédula
                                </label>
                                @error('becario_cedula')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="becario_role" value="user">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_carrera" id="becario_carrera"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_carrera') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_carrera') }}">
                                <label for="becario_carrera" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Carrera
                                </label>
                                @error('becario_carrera')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_semestre" id="becario_semestre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_semestre') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_semestre') }}">
                                <label for="becario_semestre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Semestre / Trimestre
                                </label>
                                @error('becario_semestre')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="becario_direccion" id="becario_direccion"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_direccion') border-red-500 @enderror"
                            placeholder=" " value="{{ old('becario_direccion') }}">
                        <label for="becario_direccion" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Dirección
                        </label>
                        @error('becario_direccion')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                       <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="becario_fecha_nacimiento" id="becario_fecha_nacimiento"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_fecha_nacimiento') border-red-500 @enderror"
                            placeholder=" " value="{{ old('becario_fecha_nacimiento') }}">
                        <label for="becario_fecha_nacimiento" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Fecha de Nacimiento
                        </label>
                        @error('personal_fecha_nacimiento')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_taller" id="becario_meta_taller"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_taller') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_taller', 40) }}">
                                <label for="becario_meta_taller" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Taller
                                </label>
                                @error('becario_meta_taller')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_chat" id="becario_meta_chat"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_chat') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_chat', 15) }}">
                                <label for="becario_meta_chat" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Chat
                                </label>
                                @error('becario_meta_chat')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_volin" id="becario_meta_volin"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_volin') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_volin', 60) }}">
                                <label for="becario_meta_volin" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Volin
                                </label>
                                @error('becario_meta_volin')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_volex" id="becario_meta_volex"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_volex') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_volex', 40) }}">
                                <label for="becario_meta_volex" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Volex
                                </label>
                                @error('becario_meta_volex')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <select name="becario_nivel_cevaz" id="becario_nivel_cevaz"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_nivel_cevaz') border-red-500 @enderror">
                            @php
                                $niveles = [
                                    'LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9',
                                    'LEVEL 10', 'LEVEL 11', 'LEVEL 12', 'LEVEL 13', 'LEVEL 14', 'LEVEL 15', 'LEVEL 16', 'LEVEL 17', 'LEVEL 18', 'LEVEl 19'
                                ];
                            @endphp
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel }}" {{ old('becario_nivel_cevaz', 'LEVEL 1') == $nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                            @endforeach
                        </select>
                        <label for="becario_nivel_cevaz" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Nivel Cevaz
                        </label>
                        @error('becario_nivel_cevaz')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Agregar
                    </button>
                </form>

                <form id="form-personal" action="{{ route('users.store') }}" method="POST" class="flex flex-col flex-1 hidden" novalidate>
                    @csrf
                    <input type="hidden" name="tipo" value="personal">
                    <input type="hidden" name="user_id" value="{{ old('user_id') }}">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="personal_nombre" id="personal_nombre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_nombre') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('personal_nombre') }}">
                                <label for="personal_nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                                @error('personal_nombre')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="personal_apellido" id="personal_apellido"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_apellido') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('personal_apellido') }}">
                                <label for="personal_apellido" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Apellido
                                </label>
                                @error('personal_apellido')
                                    <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="personal_email" id="personal_email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_email') border-red-500 @enderror"
                            placeholder=" " required value="{{ old('personal_email') }}">
                        <label for="personal_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Correo
                        </label>
                        @error('personal_email')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_cedula" id="personal_cedula"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_cedula') border-red-500 @enderror"
                            placeholder=" " required value="{{ old('personal_cedula') }}">
                        <label for="personal_cedula" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Cédula
                        </label>
                        @error('personal_cedula')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_cargo" id="personal_cargo"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_cargo') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_cargo') }}">
                        <label for="personal_cargo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Cargo
                        </label>
                        @error('personal_cargo')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_telefono" id="personal_telefono"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_telefono') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_telefono') }}">
                        <label for="personal_telefono" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Teléfono
                        </label>
                        @error('personal_telefono')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_direccion" id="personal_direccion"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_direccion') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_direccion') }}">
                        <label for="personal_direccion" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Dirección
                        </label>
                        @error('personal_direccion')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="personal_fecha_nacimiento" id="personal_fecha_nacimiento"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_fecha_nacimiento') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_fecha_nacimiento') }}">
                        <label for="personal_fecha_nacimiento" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Fecha de Nacimiento
                        </label>
                        @error('personal_fecha_nacimiento')
                            <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="personal_role" value="admin">

                    <button type="submit"
                        class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Agregar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabla de usuarios -->
       <div id="tabla-derecha" class="w-full xl:w-3/4 p-0 flex flex-col order-1 xl:order-2 transition-all duration-500">
        <div class="flex flex-col bg-white dark:bg-slate-900 border dark:border-gray-700 shadow-xl shadow-gray-100 dark:shadow-gray-900 xl:rounded-r-xl p-5 h-full">
                <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                    <div>
                         <!-- Pestañas -->

                            <button id="tab-becarios" class="tab-btn px-6 py-2 rounded-t-lg font-semibold text-slate-800 dark:text-gray-100 bg-white dark:bg-slate-900 border-b-2 border-slate-800 dark:border-blue-400 focus:outline-none">Becarios</button>
                            <button id="tab-personal" class="tab-btn px-6 py-2 rounded-t-lg font-semibold text-slate-800 dark:text-gray-100 bg-gray-100 dark:bg-slate-700 border-b-2 border-transparent focus:outline-none ml-2">Personal</button>

                            <button type="button" id="btn-reporte-becarios"
                                class="tab-reporte-becarios inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 md:ml-2">
                                Generar reporte becarios
                            </button>
                            <button type="button" id="btn-reporte-personal"
                                class="tab-reporte-personal inline-flex items-center text-gray-700 dark:text-gray-100 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 focus:outline-none hover:bg-gray-100 dark:hover:bg-slate-700 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5 md:ml-2 hidden">
                                Generar reporte personal
                            </button>

                    </div>

                    <label for="table-search" class="sr-only text-sm">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 ps-10 text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-lg w-80 bg-gray-50 dark:bg-slate-700 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar usuario...">
                    </div>
                </div>
                <div class="overflow-y-auto h-[calc(80vh-4rem)]">
                    <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-100 table-auto bg-white dark:bg-slate-900" id="myTable">
                        <thead class="text-gray-700 dark:text-gray-200 text-md uppercase border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="px-3 py-3 text-center">ID</th>
                                <th class="px-3 py-3 text-center">Nombre</th>
                                <th class="px-3 py-3 text-center">Correo</th>
                                <th class="px-3 py-3 text-center">Cédula</th>
                                <th class="px-3 py-3 text-center">Teléfono</th>
                                <th class="px-3 py-3 text-center">Estado</th>
                                <th class="px-3 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-white dark:bg-slate-900 text-sm border-b border-gray-200 dark:border-gray-700 transition duration-300 ease-in-out hover:bg-blue-100 dark:hover:bg-blue-900/40
                                    {{ $user->role == 'admin' ? 'row-personal' : 'row-becario' }}
                                    {{ $user->role == 'admin' ? 'hidden' : '' }}">
                                    <td class="px-3 py-4 text-center">{{ $user->id }}</td>
                                    <td class="px-3 py-4 text-center">
                                        {{ $user->becario->nombre ?? $user->personal->nombre ?? '-' }}
                                        {{ $user->becario->apellido ?? $user->personal->apellido ?? '' }}
                                    </td>
                                    <td class="px-3 py-4 text-center">{{ $user->email }}</td>
                                    <td class="px-3 py-4 text-center">
                                        {{ $user->becario->cedula ?? $user->personal->cedula ?? '-' }}
                                    </td>
                                    <td class="px-3 py-4 text-center">{{ $user->becario->telefono ?? $user->personal->telefono ?? '-'}}</td>
                                    <td class="px-3 py-4 text-center">
                                        @if ($user->activo == '1')
                                            <span class="bg-green-200 dark:bg-green-700 p-2 rounded text-green-800 dark:text-green-200">Activo</span>
                                        @else
                                            <span class="bg-red-200 dark:bg-red-700 p-2 rounded text-red-800 dark:text-red-200">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 text-center">
                                   <button
                                        class="text-blue-600 dark:text-blue-400 hover:underline text-center mx-auto"
                                        onclick="abrirModal('modal-detalle-{{ $user->id }}')">
                                        Ver Detalle
                                    </button>
                                    @if($user->role == 'user')
                                        <button class="text-yellow-600 dark:text-yellow-400 hover:underline mx-1"
                                            onclick="abrirModalEditar('becario', {{ $user->id }})">Editar</button>
                                    @elseif($user->role == 'admin')
                                        <button class="text-yellow-600 dark:text-yellow-400 hover:underline mx-1"
                                            onclick="abrirModalEditar('personal', {{ $user->id }})">Editar</button>
                                    @endif
                                <div id="modal-detalle-{{ $user->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden text-left transition-opacity duration-200">
                                     <div class="bg-white dark:bg-slate-900 rounded-lg shadow-lg w-full max-w-lg p-6 relative transition-transform transition-opacity duration-200">
                                        <button onclick="cerrarModal('modal-detalle-{{ $user->id }}')" class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 text-xl">&times;</button>
                                        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100 text-center">Detalle de Usuario</h2>
                                        <hr class="border-gray-200 dark:border-gray-700">
                                        <div class="space-y-2 px-4">
                                            <div><span class="font-semibold">Nombre:</span> {{ $user->becario->nombre ?? $user->personal->nombre ?? '-' }} {{ $user->becario->apellido ?? $user->personal->apellido ?? '' }}</div>
                                            <div><span class="font-semibold">Correo:</span> {{ $user->email }}</div>
                                            <div><span class="font-semibold">Cédula:</span> {{ $user->becario->cedula ?? $user->personal->cedula ?? '-' }}</div>
                                            <div><span class="font-semibold">Rol:</span> {{ ucfirst($user->role) }}</div>
                                            <div><span class="font-semibold">Estado:</span> {{ $user->activo == '1' ? 'Activo' : 'Inactivo' }}</div>
                                            @if($user->role == 'user')
                                                <div><span class="font-semibold">Teléfono:</span> {{ $user->becario->telefono ?? '-' }}</div>
                                                <div><span class="font-semibold">Dirección:</span> {{ $user->becario->direccion ?? '-' }}</div>
                                                <div><span class="font-semibold">Fecha de Nacimiento:</span> {{ $user->becario->fecha_nacimiento ?? '-' }}</div>
                                                <div><span class="font-semibold">Carrera:</span> {{ $user->becario->carrera ?? '-' }}</div>
                                                <div><span class="font-semibold">Semestre/Trimestre:</span> {{ $user->becario->semestre ?? '-' }}</div>
                                                <div><span class="font-semibold">Nivel Cevaz:</span> {{ $user->becario->nivel_cevaz ?? '-' }}</div>
                                                <div><span class="font-semibold">Meta Taller:</span> {{ $user->becario->meta_taller ?? '-' }}</div>
                                                <div><span class="font-semibold">Meta Chat:</span> {{ $user->becario->meta_chat ?? '-' }}</div>
                                                <div><span class="font-semibold">Meta Volin:</span> {{ $user->becario->meta_volin ?? '-' }}</div>
                                                <div><span class="font-semibold">Meta Volex:</span> {{ $user->becario->meta_volex ?? '-' }}</div>
                                            @elseif($user->role == 'admin')
                                                <div><span class="font-semibold">Cargo:</span> {{ $user->personal->cargo ?? '-' }}</div>
                                                <div><span class="font-semibold">Teléfono:</span> {{ $user->personal->telefono ?? '-' }}</div>
                                                <div><span class="font-semibold">Dirección:</span> {{ $user->personal->direccion ?? '-' }}</div>
                                                <div><span class="font-semibold">Fecha de Nacimiento:</span> {{ $user->personal->fecha_nacimiento ?? '-' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-10 text-center uppercase text-gray-500 dark:text-gray-400 align-middle">No hay usuarios registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Modal Detalle Usuario -->
                    <div id="modal-detalle" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                            <button id="cerrar-modal" class="absolute top-2 right-2 text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 text-xl">&times;</button>
                            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Detalle de Usuario</h2>
                            <hr class="border-gray-200 dark:border-gray-700">
                            <div class="space-y-2">
                                <div><span class="font-semibold">Nombre:</span> <span id="detalle-nombre"></span> <span id="detalle-apellido"></span></div>
                                <div><span class="font-semibold">Correo:</span> <span id="detalle-email"></span></div>
                                <div><span class="font-semibold">Cédula:</span> <span id="detalle-cedula"></span></div>
                                <div><span class="font-semibold">Rol:</span> <span id="detalle-role"></span></div>
                                <div><span class="font-semibold">Estado:</span> <span id="detalle-activo"></span></div>
                                {{-- Mostrar campos solo si es becario --}}
                                @if(request()->input('modal_tipo') == 'becario')
                                    <div><span class="font-semibold">Teléfono:</span> <span id="detalle-telefono"></span></div>
                                    <div><span class="font-semibold">Dirección:</span> <span id="detalle-direccion"></span></div>
                                    <div><span class="font-semibold">Fecha de Nacimiento:</span> <span id="detalle-fecha_nacimiento"></span></div>
                                    <div><span class="font-semibold">Carrera:</span> <span id="detalle-carrera"></span></div>
                                    <div><span class="font-semibold">Semestre/Trimestre:</span> <span id="detalle-semestre"></span></div>
                                    <div><span class="font-semibold">Nivel Cevaz:</span> <span id="detalle-nivel_cevaz"></span></div>
                                    <div><span class="font-semibold">Meta Taller:</span> <span id="detalle-meta_taller"></span></div>
                                    <div><span class="font-semibold">Meta Chat:</span> <span id="detalle-meta_chat"></span></div>
                                    <div><span class="font-semibold">Meta Volin:</span> <span id="detalle-meta_volin"></span></div>
                                    <div><span class="font-semibold">Meta Volex:</span> <span id="detalle-meta_volex"></span></div>
                                @elseif(request()->input('modal_tipo') == 'personal')
                                    <div><span class="font-semibold">Cargo:</span> <span id="detalle-cargo"></span></div>
                                    <div><span class="font-semibold">Teléfono:</span> <span id="detalle-telefono"></span></div>
                                    <div><span class="font-semibold">Dirección:</span> <span id="detalle-direccion"></span></div>
                                    <div><span class="font-semibold">Fecha de Nacimiento:</span> <span id="detalle-fecha_nacimiento"></span></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $users->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Cambiar pestañas y contenido
document.getElementById('tab-becarios').addEventListener('click', function() {
    this.classList.add('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    this.classList.remove('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('tab-personal').classList.remove('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    document.getElementById('tab-personal').classList.add('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('form-becario').classList.remove('hidden');
    document.getElementById('form-personal').classList.add('hidden');
    document.getElementById('form-title').textContent = 'Agregar Becario';
    document.querySelectorAll('.row-becario').forEach(row => row.classList.remove('hidden'));
    document.querySelectorAll('.row-personal').forEach(row => row.classList.add('hidden'));
});

document.getElementById('tab-personal').addEventListener('click', function() {
    this.classList.add('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    this.classList.remove('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('tab-becarios').classList.remove('bg-white', 'dark:bg-slate-900', 'border-slate-800', 'dark:border-blue-400');
    document.getElementById('tab-becarios').classList.add('bg-gray-100', 'dark:bg-slate-700', 'border-transparent');
    document.getElementById('form-becario').classList.add('hidden');
    document.getElementById('form-personal').classList.remove('hidden');
    document.getElementById('form-title').textContent = 'Agregar Personal';
    document.querySelectorAll('.row-becario').forEach(row => row.classList.add('hidden'));
    document.querySelectorAll('.row-personal').forEach(row => row.classList.remove('hidden'));
});
// Filtro de tabla
document.getElementById('table-search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const rows = document.querySelectorAll('#myTable tbody tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let found = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(search)) {
                found = true;
            }
        });
        row.style.display = found ? '' : 'none';
    });
});

// Inicializar en becarios
document.getElementById('tab-becarios').click();
</script>

<script>
    @if(session('tab') === 'personal')
        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById('tab-personal').click();
        });
    @else
        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById('tab-becarios').click();
        });
    @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.7.0/jspdf.plugin.autotable.min.js"></script>

<script>
document.querySelectorAll('.btn-detalle').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('detalle-nombre').textContent = this.dataset.nombre || '-';
        document.getElementById('detalle-apellido').textContent = this.dataset.apellido || '';
        document.getElementById('detalle-email').textContent = this.dataset.email || '-';
        document.getElementById('detalle-cedula').textContent = this.dataset.cedula || '-';
        document.getElementById('detalle-telefono').textContent = this.dataset.telefono || '-';
        document.getElementById('detalle-direccion').textContent = this.dataset.direccion || '-';
        document.getElementById('detalle-fecha_nacimiento').textContent = this.dataset.fecha_nacimiento || '-';
        document.getElementById('detalle-carrera').textContent = this.dataset.carrera || '-';
        document.getElementById('detalle-semestre').textContent = this.dataset.semestre || '-';
        document.getElementById('detalle-nivel_cevaz').textContent = this.dataset.nivel_cevaz || '-';
        document.getElementById('detalle-meta_taller').textContent = this.dataset.meta_taller || '-';
        document.getElementById('detalle-meta_chat').textContent = this.dataset.meta_chat || '-';
        document.getElementById('detalle-meta_volin').textContent = this.dataset.meta_volin || '-';
        document.getElementById('detalle-meta_volex').textContent = this.dataset.meta_volex || '-';
        document.getElementById('detalle-cargo').textContent = this.dataset.cargo || '-';
        document.getElementById('detalle-role').textContent = this.dataset.role || '-';
        document.getElementById('detalle-activo').textContent = this.dataset.activo || '-';
        abrirModal('modal-detalle');
    });
});
document.getElementById('cerrar-modal').addEventListener('click', function() {
    cerrarModal('modal-detalle');
});
window.addEventListener('click', function(e) {
    const modal = document.getElementById('modal-detalle');
    if (e.target === modal) {
        cerrarModal('modal-detalle');
    }
});

function abrirModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    modal.style.opacity = 0;
    const content = modal.querySelector('div.bg-white, div.dark\\:bg-gray-800');
    if (content) {
        content.style.transform = 'scale(0.95)';
        content.style.opacity = 0;
        content.style.transition = 'transform 0.2s ease, opacity 0.2s ease';
    }
    setTimeout(() => {
        modal.style.opacity = 1;
        if (content) {
            content.style.transform = 'scale(1)';
            content.style.opacity = 1;
        }
    }, 10);
}

function cerrarModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div.bg-white, div.dark\\:bg-gray-800');
    if (content) {
        content.style.transform = 'scale(0.95)';
        content.style.opacity = 0;
    }
    modal.style.opacity = 0;
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        if (content) {
            content.style.transform = '';
            content.style.opacity = '';
        }
    }, 200);
}

// Máscara para teléfono venezolano: 0412-1234567
function maskVenezuelaPhone(input) {
    input.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // Solo números
        if (value.length > 11) value = value.slice(0, 11);
        if (value.length > 4) {
            value = value.slice(0, 4) + '-' + value.slice(4, 11);
        }
        this.value = value;
    });
}

maskVenezuelaPhone(document.getElementById('becario_telefono'));
maskVenezuelaPhone(document.getElementById('personal_telefono'));

window.usuariosParaReporte = @json($users->items() ?? $users);

function generarReporteUsuarios(tipo) {
    const usuarios = window.usuariosParaReporte.filter(u => u.role === tipo);
    const rows = usuarios.map(user => {
        const becario = user.becario || {};
        const personal = user.personal || {};
        if (tipo === 'user') {
            return [
                user.id,
                (becario.nombre || '-') + ' ' + (becario.apellido || ''),
                user.email || '-',
                becario.cedula || '-',
                becario.telefono || '-',
                becario.direccion || '-',
                becario.fecha_nacimiento || '-',
                becario.carrera || '-',
                becario.semestre || '-',
                becario.nivel_cevaz || '-',
                becario.meta_taller || '-',
                becario.meta_chat || '-',
                becario.meta_volin || '-',
                becario.meta_volex || '-',
                user.activo == 1 ? 'Activo' : 'Inactivo'
            ];
        } else {
            return [
                user.id,
                (personal.nombre || '-') + ' ' + (personal.apellido || ''),
                user.email || '-',
                personal.cedula || '-',
                personal.telefono || '-',
                personal.cargo || '-',
                personal.direccion || '-',
                personal.fecha_nacimiento || '-',
                user.activo == 1 ? 'Activo' : 'Inactivo'
            ];
        }
    });

    let headers, filename, titulo;
    if (tipo === 'user') {
        headers = [[
            'ID', 'Nombre', 'Correo', 'Cédula', 'Teléfono', 'Dirección', 'Fecha Nac.', 'Carrera', 'Semestre',
            'Nivel Cevaz', 'Meta Taller', 'Meta Chat', 'Meta Volin', 'Meta Volex', 'Estado'
        ]];
        filename = 'Reporte_Becarios_';
        titulo = 'Reporte de Becarios';
    } else {
        headers = [[
            'ID', 'Nombre', 'Correo', 'Cédula', 'Teléfono', 'Cargo', 'Dirección', 'Fecha Nac.', 'Estado'
        ]];
        filename = 'Reporte_Personal_';
        titulo = 'Reporte de Personal';
    }

    const logoUrl = "{{ asset('imgs/avaalogo_color_p.png') }}";
    const nombreUsuario = "{{ auth()->user()->becario->nombre ?? auth()->user()->personal->nombre ?? 'Usuario' }}";

    toDataURL(logoUrl, function(logoBase64) {
        const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });

        doc.addImage(logoBase64, 'PNG', 10, 10, 40, 18);

        doc.setFontSize(16);
        doc.setFont('helvetica', 'bold');
        doc.text(titulo, doc.internal.pageSize.getWidth() / 2, 44, { align: 'center' });

        doc.setFontSize(10);
        doc.setFont('helvetica', 'normal');
        doc.text('Generado por: ' + nombreUsuario, 10, 32);
        doc.text('Fecha: ' + new Date().toLocaleString(), 10, 38);

        doc.setDrawColor(200, 200, 200);
        doc.line(10, 47, doc.internal.pageSize.getWidth() - 10, 47);

        doc.autoTable({
            head: headers,
            body: rows,
            startY: 52,
            styles: { fontSize: 8 },
            headStyles: { fillColor: [30, 41, 59] },
            alternateRowStyles: { fillColor: [243, 244, 246] }
        });

        doc.save(filename + new Date().toLocaleString() + '.pdf');
    });

    function toDataURL(url, callback) {
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
            const reader = new FileReader();
            reader.onloadend = function() {
                callback(reader.result);
            }
            reader.readAsDataURL(xhr.response);
        };
        xhr.onerror = function() {
            alert('No se pudo cargar el logo para el reporte. El PDF se generará sin logo.');
            callback('');
        };
        xhr.open('GET', url);
        xhr.responseType = 'blob';
        xhr.send();
    }
}
document.getElementById('btn-reporte-becarios').addEventListener('click', function() {
    generarReporteUsuarios('user');
});
document.getElementById('btn-reporte-personal').addEventListener('click', function() {
    generarReporteUsuarios('admin');
});
</script>

<script>
    function toggleReporteButtons(tab) {
        if (tab === 'becarios') {
            document.querySelector('.tab-reporte-becarios').classList.remove('hidden');
            document.querySelector('.tab-reporte-personal').classList.add('hidden');
        } else {
            document.querySelector('.tab-reporte-becarios').classList.add('hidden');
            document.querySelector('.tab-reporte-personal').classList.remove('hidden');
        }
    }
    document.getElementById('tab-becarios').addEventListener('click', function() {
        toggleReporteButtons('becarios');
    });
    document.getElementById('tab-personal').addEventListener('click', function() {
        toggleReporteButtons('personal');
    });
    window.addEventListener('DOMContentLoaded', function() {
        if(document.getElementById('form-becario').classList.contains('hidden')) {
            toggleReporteButtons('personal');
        } else {
            toggleReporteButtons('becarios');
        }
    });
</script>
<script>
const btn = document.getElementById('toggle-form-btn');
const btnIcon = document.getElementById('toggle-form-icon');
const formDiv = document.getElementById('formulario-izquierda');
const innerDiv = btn.parentElement;
const tablaDiv = document.getElementById('tabla-derecha');

// Detecta si es escritorio (xl) o móvil/tablet (sm/md/lg)
function isDesktop() {
    return window.matchMedia('(min-width: 1280px)').matches; // xl: breakpoint
}

let visible = !isDesktop(); // sm/md/lg: abierto, xl+: cerrado

function setFormState(open) {
    if (open) {
        formDiv.classList.remove('xl:w-[56px]', 'w-[56px]', 'overflow-hidden');
        formDiv.classList.add('xl:w-1/4', 'w-full');
        formDiv.style.minWidth = '';
        formDiv.style.maxWidth = '';
        formDiv.style.opacity = '';
        Array.from(innerDiv.children).forEach(child => {
            child.style.display = '';
        });
        tablaDiv.classList.remove('xl:w-[calc(100%-56px)]');
        tablaDiv.classList.add('xl:w-3/4');
        btnIcon.textContent = '⮜';
    } else {
        formDiv.classList.remove('xl:w-1/4', 'w-full');
        formDiv.classList.add('xl:w-[56px]', 'w-[56px]', 'overflow-hidden');
        formDiv.style.minWidth = '56px';
        formDiv.style.maxWidth = '56px';
        formDiv.style.opacity = '1';
        Array.from(innerDiv.children).forEach((child) => {
            if (child !== btn) child.style.display = 'none';
            else child.style.display = '';
        });
        tablaDiv.classList.remove('xl:w-3/4');
        tablaDiv.classList.add('xl:w-[calc(100%-56px)]');
        btnIcon.textContent = '+';
    }
}

// Estado inicial según pantalla
setFormState(visible);

// Al cambiar tamaño de pantalla, ajusta el estado y el valor de visible
window.addEventListener('resize', function() {
    if (!isDesktop()) {
        // Siempre abierto en sm/md/lg
        visible = true;
        setFormState(true);
    } else {
        // Por defecto cerrado en xl+
        visible = false;
        setFormState(false);
    }
});

btn.addEventListener('click', function() {
    if (!isDesktop()) return; // No permitir cerrar en sm/md/lg
    if (!visible) {
        visible = true;
        setFormState(true);
    } else if (formDiv.classList.contains('xl:w-1/4') && formDiv.classList.contains('w-full')) {
        visible = false;
        setFormState(false);
    }
});
</script>
@endsection
