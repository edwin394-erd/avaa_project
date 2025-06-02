@extends('layouts.layout')

@section('titulo-tab')
    Usuarios
@endsection

@section('contenido')
<div class="2xl:w-6/6 mx-auto py-5 px-0 md:px-5">

    <div class="flex flex-wrap p-0 min-h-[calc(90vh-4rem)]">
        <!-- Formulario para agregar usuario -->
        <div class="w-full xl:w-1/4 p-0 flex flex-col mb-4 xl:mb-0">
            <div class="flex flex-col bg-white border shadow-xl shadow-gray-100 rounded-l-xl p-4 h-full">
                <h1 id="form-title" class="text-lg 2xl:text-xl font-bold text-gray-700 text-center mb-4">Agregar Becario</h1>

                <form id="form-becario" action="{{ route('users.store') }}" method="POST" class="flex flex-col flex-1" novalidate>
                    @csrf
                    <input type="hidden" name="tipo" value="becario">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_nombre" id="becario_nombre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_nombre') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_nombre') }}">
                                <label for="becario_nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                                @error('becario_nombre')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_apellido" id="becario_apellido"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_apellido') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_apellido') }}">
                                <label for="becario_apellido" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Apellido
                                </label>
                                @error('becario_apellido')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="becario_email" id="becario_email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_email') border-red-500 @enderror"
                            placeholder=" " required value="{{ old('becario_email') }}">
                        <label for="becario_email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Correo
                        </label>
                        @error('becario_email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_telefono" id="becario_telefono"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_telefono') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_telefono') }}">
                                <label for="becario_telefono" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Teléfono
                                </label>
                                @error('becario_telefono')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_cedula" id="becario_cedula"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_cedula') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_cedula') }}">
                                <label for="becario_cedula" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Cédula
                                </label>
                                @error('becario_cedula')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="role" value="user">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="becario_password" id="becario_password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_password') border-red-500 @enderror"
                                    placeholder=" " required>
                                <label for="becario_password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Contraseña
                                </label>
                                @error('becario_password')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="becario_password_confirmation" id="becario_password_confirmation"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required>
                                <label for="becario_password_confirmation" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Confirmar Contraseña
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_carrera" id="becario_carrera"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_carrera') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_carrera') }}">
                                <label for="becario_carrera" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Carrera
                                </label>
                                @error('becario_carrera')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_semestre" id="becario_semestre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_semestre') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_semestre') }}">
                                <label for="becario_semestre" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Semestre / Trimestre
                                </label>
                                @error('becario_semestre')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="becario_direccion" id="becario_direccion"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_direccion') border-red-500 @enderror"
                            placeholder=" " value="{{ old('becario_direccion') }}">
                        <label for="becario_direccion" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Dirección
                        </label>
                        @error('becario_direccion')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_taller" id="becario_meta_taller"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_taller') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_taller', 40) }}">
                                <label for="becario_meta_taller" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Taller
                                </label>
                                @error('becario_meta_taller')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_chat" id="becario_meta_chat"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_chat') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_chat', 15) }}">
                                <label for="becario_meta_chat" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Chat
                                </label>
                                @error('becario_meta_chat')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_volin" id="becario_meta_volin"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_volin') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_volin', 60) }}">
                                <label for="becario_meta_volin" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Volin
                                </label>
                                @error('becario_meta_volin')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="number" step="0.01" name="becario_meta_volex" id="becario_meta_volex"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_meta_volex') border-red-500 @enderror"
                                    placeholder=" " value="{{ old('becario_meta_volex', 40) }}">
                                <label for="becario_meta_volex" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Meta Volex
                                </label>
                                @error('becario_meta_volex')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <select name="becario_nivel_cevaz" id="becario_nivel_cevaz"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_nivel_cevaz') border-red-500 @enderror">
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
                        <label for="becario_nivel_cevaz" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Nivel Cevaz
                        </label>
                        @error('becario_nivel_cevaz')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Agregar
                    </button>
                </form>
                <form id="form-personal" action="" method="POST" class="flex flex-col flex-1 hidden" novalidate>
                    @csrf
                    <input type="hidden" name="tipo" value="personal">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="personal_nombre" id="personal_nombre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_nombre') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('personal_nombre') }}">
                                <label for="personal_nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                                @error('personal_nombre')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="personal_apellido" id="personal_apellido"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_apellido') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('personal_apellido') }}">
                                <label for="personal_apellido" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Apellido
                                </label>
                                @error('personal_apellido')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="personal_email" id="personal_email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_email') border-red-500 @enderror"
                            placeholder=" " required value="{{ old('personal_email') }}">
                        <label for="personal_email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Correo
                        </label>
                        @error('personal_email')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_cedula" id="personal_cedula"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_cedula') border-red-500 @enderror"
                            placeholder=" " required value="{{ old('personal_cedula') }}">
                        <label for="personal_cedula" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Cédula
                        </label>
                        @error('personal_cedula')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="role" value="admin">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="personal_password" id="personal_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_password') border-red-500 @enderror"
                            placeholder=" " required>
                        <label for="personal_password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Contraseña
                        </label>
                        @error('personal_password')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-auto w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Agregar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabla de usuarios -->
        <div class="w-full xl:w-3/4 p-0 flex flex-col">
            <div class="flex flex-col bg-white border shadow-xl shadow-gray-100 xl:rounded-r-xl p-5 h-full">
                <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                    <div>
                         <!-- Pestañas -->

                            <button id="tab-becarios" class="tab-btn px-6 py-2 rounded-t-lg font-semibold text-slate-800 bg-white border-b-2 border-slate-800 focus:outline-none">Becarios</button>
                            <button id="tab-personal" class="tab-btn px-6 py-2 rounded-t-lg font-semibold text-slate-800 bg-gray-100 border-b-2 border-transparent focus:outline-none ml-2">Personal</button>

                        {{-- <button type="button" id="btn-ver-todo"
                            class="inline-flex items-center text-gray-700 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-2 md:px-3 py-1.5">
                            Ver todo
                        </button> --}}
                    </div>
                    <label for="table-search" class="sr-only text-sm">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar usuario...">
                    </div>
                </div>
                <div class="overflow-y-auto h-[calc(80vh-4rem)]">
                    <table class="w-full text-sm text-left rtl:text-right text-black table-auto bg-white" id="myTable">
                        <thead class="text-gray-700 text-md uppercase border-b border-gray-200">
                            <tr>
                                <th class="px-3 py-3 text-center">ID</th>
                                <th class="px-3 py-3 text-center">Nombre</th>
                                <th class="px-3 py-3 text-center">Correo</th>
                                <th class="px-3 py-3 text-center">Rol</th>
                                <th class="px-3 py-3 text-center">Estado</th>
                                <th class="px-3 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="bg-white text-sm border-b border-gray-200 transition duration-300 ease-in-out hover:bg-blue-100
                                    {{ $user->role == 'admin' ? 'row-personal' : 'row-becario' }}
                                    {{ $user->role == 'admin' ? 'hidden' : '' }}">
                                    <td class="px-3 py-4 text-center">{{ $user->id }}</td>
                                    <td class="px-3 py-4 text-center">
                                        {{ $user->becario->nombre ?? $user->personal->nombre ?? '-' }}
                                        {{ $user->becario->apellido ?? $user->personal->apellido ?? '' }}
                                    </td>
                                    <td class="px-3 py-4 text-center">{{ $user->email }}</td>
                                    <td class="px-3 py-4 text-center">{{ ucfirst($user->role) }}</td>
                                    <td class="px-3 py-4 text-center">
                                        @if ($user->activo == '1')
                                            <span class="bg-green-200 p-2 rounded text-green-800">Activo</span>
                                        @else
                                            <span class="bg-red-200 p-2 rounded text-red-800">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 text-center">
                                        <a href="" class="text-blue-600 hover:underline">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-10 text-center uppercase text-gray-500 align-middle">No hay usuarios registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
    this.classList.add('bg-white', 'border-slate-800');
    this.classList.remove('bg-gray-100', 'border-transparent');
    document.getElementById('tab-personal').classList.remove('bg-white', 'border-slate-800');
    document.getElementById('tab-personal').classList.add('bg-gray-100', 'border-transparent');
    document.getElementById('form-becario').classList.remove('hidden');
    document.getElementById('form-personal').classList.add('hidden');
    document.getElementById('form-title').textContent = 'Agregar Becario';
    document.querySelectorAll('.row-becario').forEach(row => row.classList.remove('hidden'));
    document.querySelectorAll('.row-personal').forEach(row => row.classList.add('hidden'));

});

document.getElementById('tab-personal').addEventListener('click', function() {
    this.classList.add('bg-white', 'border-slate-800');
    this.classList.remove('bg-gray-100', 'border-transparent');
    document.getElementById('tab-becarios').classList.remove('bg-white', 'border-slate-800');
    document.getElementById('tab-becarios').classList.add('bg-gray-100', 'border-transparent');
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

    document.getElementById('btn-ver-todo').addEventListener('click', function() {
        document.querySelectorAll('#myTable tbody tr').forEach(row => {
            row.style.display = '';
        });
        document.getElementById('table-search').value = '';
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
@endsection
