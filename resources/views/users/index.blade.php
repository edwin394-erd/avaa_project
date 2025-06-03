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
                <br>
                <form id="form-becario" action="{{ route('users.store') }}" method="POST" class="flex flex-col flex-1" novalidate>
                    @csrf
                    <input type="hidden" name="tipo" value="becario">
                    <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="becario_nombre" id="becario_nombre"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_nombre') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_nombre') }}"
                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
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
                                    placeholder=" " required value="{{ old('becario_apellido') }}"
                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
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
                                <input type="text" name="becario_cedula" id="becario_cedula" maxlength="8" minlength="7"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('becario_cedula') border-red-500 @enderror"
                                    placeholder=" " required value="{{ old('becario_cedula') }}"
                                    oninput="this.value = this.value.replace(/[^0-9\-]/g, '')">
                                <label for="becario_cedula" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Cédula
                                </label>
                                @error('becario_cedula')
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="becario_role" value="user">
                    {{-- <div class="flex flex-col md:flex-row md:space-x-2">
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
                    </div> --}}
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
                       <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="becario_fecha_nacimiento" id="becario_fecha_nacimiento"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_fecha_nacimiento') border-red-500 @enderror"
                            placeholder=" " value="{{ old('becario_fecha_nacimiento') }}">
                        <label for="becario_fecha_nacimiento" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Fecha de Nacimiento
                        </label>
                        @error('personal_fecha_nacimiento')
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

                <form id="form-personal" action="{{ route('users.store') }}" method="POST" class="flex flex-col flex-1 hidden" novalidate>
                    @csrf
                    <input type="hidden" name="tipo" value="personal">
                    <input type="hidden" name="user_id" value="{{ old('user_id') }}">
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
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_cargo" id="personal_cargo"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_cargo') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_cargo') }}">
                        <label for="personal_cargo" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Cargo
                        </label>
                        @error('personal_cargo')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_telefono" id="personal_telefono"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_telefono') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_telefono') }}">
                        <label for="personal_telefono" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Teléfono
                        </label>
                        @error('personal_telefono')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="personal_direccion" id="personal_direccion"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_direccion') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_direccion') }}">
                        <label for="personal_direccion" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Dirección
                        </label>
                        @error('personal_direccion')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="relative z-0 w-full mb-5 group">
                        <input type="date" name="personal_fecha_nacimiento" id="personal_fecha_nacimiento"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('personal_fecha_nacimiento') border-red-500 @enderror"
                            placeholder=" " value="{{ old('personal_fecha_nacimiento') }}">
                        <label for="personal_fecha_nacimiento" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Fecha de Nacimiento
                        </label>
                        @error('personal_fecha_nacimiento')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="personal_role" value="admin">
                    {{-- <div class="flex flex-col md:flex-row md:space-x-2">
                        <div class="w-full md:w-1/2">
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
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="personal_password_confirmation" id="personal_password_confirmation"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required>
                                <label for="personal_password_confirmation" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Confirmar Contraseña
                                </label>
                            </div>
                        </div>
                    </div> --}}
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

                            <button type="button" id="btn-reporte-becarios"
                                class="inline-flex items-center text-gray-700 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 mb-2">
                                Generar reporte becarios
                            </button>
                            <button type="button" id="btn-reporte-personal"
                                class="inline-flex items-center text-gray-700 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 mb-2 ml-2">
                                Generar reporte personal
                            </button>

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
                                <th class="px-3 py-3 text-center">Cédula</th>
                                <th class="px-3 py-3 text-center">Teléfono</th>
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
                                    <td class="px-3 py-4 text-center">
                                        {{ $user->becario->cedula ?? $user->personal->cedula ?? '-' }}
                                    </td>
                                    <td class="px-3 py-4 text-center">{{ $user->becario->telefono ?? $user->personal->telefono ?? '-'}}</td>
                                    <td class="px-3 py-4 text-center">
                                        @if ($user->activo == '1')
                                            <span class="bg-green-200 p-2 rounded text-green-800">Activo</span>
                                        @else
                                            <span class="bg-red-200 p-2 rounded text-red-800">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 text-center">
                                    <!-- Botón que abre el modal único de este usuario -->
                                   <button
                                        class="text-blue-600 hover:underline text-center mx-auto"
                                        onclick="abrirModal('modal-detalle-{{ $user->id }}')">
                                        Ver Detalle
                                    </button>
                                 <!-- Modal único para este usuario -->
                                <div id="modal-detalle-{{ $user->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden text-left transition-opacity duration-200">
                                     <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative transition-transform transition-opacity duration-200">
                                        <button onclick="cerrarModal('modal-detalle-{{ $user->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                                        <h2 class="text-xl font-bold mb-4 text-gray-800 text-center">Detalle de Usuario</h2>
                                        <hr>
                                        <div class="space-y-2 px-4">
                                            <!-- Los datos quedan alineados a la izquierda por defecto -->
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
                                    <td colspan="7" class="p-10 text-center uppercase text-gray-500 align-middle">No hay usuarios registrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Modal Detalle Usuario -->
                    <div id="modal-detalle" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                            <button id="cerrar-modal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                            <h2 class="text-xl font-bold mb-4 text-gray-800">Detalle de Usuario</h2>
                            <hr>
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
<!-- jsPDF AutoTable -->
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
    const content = modal.querySelector('div.bg-white');
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
    const content = modal.querySelector('div.bg-white');
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

// Requiere jsPDF y autoTable incluidos en tu proyecto
<!-- jsPDF -->


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

    let headers, filename;
    if (tipo === 'user') {
        headers = [[
            'ID', 'Nombre', 'Correo', 'Cédula', 'Teléfono', 'Dirección', 'Fecha Nac.', 'Carrera', 'Semestre',
            'Nivel Cevaz', 'Meta Taller', 'Meta Chat', 'Meta Volin', 'Meta Volex', 'Estado'
        ]];
        filename = 'Reporte_Becarios_';
    } else {
        headers = [[
            'ID', 'Nombre', 'Correo', 'Cédula', 'Teléfono', 'Cargo', 'Dirección', 'Fecha Nac.', 'Estado'
        ]];
        filename = 'Reporte_Personal_';
    }

    const doc = new window.jspdf.jsPDF({ orientation: 'landscape' });
    doc.autoTable({
        head: headers,
        body: rows,
        startY: 20,
        styles: { fontSize: 8 },
        headStyles: { fillColor: [30, 41, 59] },
        alternateRowStyles: { fillColor: [243, 244, 246] }
    });
    doc.save(filename + new Date().toLocaleString() + '.pdf');
}

document.getElementById('btn-reporte-becarios').addEventListener('click', function() {
    generarReporteUsuarios('user');
});
document.getElementById('btn-reporte-personal').addEventListener('click', function() {
    generarReporteUsuarios('admin');
});

</script>
@endsection
