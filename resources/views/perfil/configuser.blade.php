{{-- resources/views/perfil/configuser.blade.php --}}
@extends('layouts.layout')

@section('titulo-tab')
    Perfil
@endsection
{{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

@section('contenido')
<div class="flex flex-col xl:flex-row w-full py-10 px-4">
    <!-- Lado Izquierdo: Formulario Usuario -->
    <div class="w-full xl:w-1/4 px-0 xl:pr-3 mb-8 xl:mb-0 flex flex-col">
        <div class="p-0 flex flex-col h-full">
            <div class="flex w-full">
                <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 px-2 rounded-lg px-4 md:px-8 py-6 w-full min-h-[620px]">
                    <h1 class="text-lg 2xl:text-xl font-bold text-gray-800 dark:text-gray-100">Configuración Usuario</h1>
                    <hr class="w-full border-t-2 border-gray-300 dark:border-slate-700 my-2"><br>
                    <form action="{{ route('configuser.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <!-- Foto de Perfil -->
                        <div class="mb-4 flex flex-col items-center">
                            <div class="relative w-24 h-24 mb-2">
                                <img src="{{ auth()->user()->fotoperfil ? asset('storage/' . auth()->user()->fotoperfil) : asset('imgs/default-profile.jpg') }}"
                                     alt="Foto de perfil"
                                     class="w-24 h-24 rounded-full object-cover border-2 border-gray-300 dark:border-slate-700 bg-gray-100 dark:bg-slate-800">
                                <label for="foto_perfil" class="absolute bottom-0 right-0 bg-slate-800 hover:bg-slate-700 text-white rounded-full p-1 cursor-pointer shadow">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2a2.828 2.828 0 11-4-4l6 6a2.828 2.828 0 11-4-4z" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16 21H4a2 2 0 01-2-2V6a2 2 0 012-2h7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <input type="file" name="foto_perfil" id="foto_perfil" class="hidden" accept="image/*"
                                        onchange="if(this.files.length){this.closest('.relative').querySelector('img').src = URL.createObjectURL(this.files[0]);}">
                                </label>
                            </div>
                            @error('foto_perfil')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                            <span class="text-xs text-gray-500 dark:text-gray-400">Formatos permitidos: JPG, PNG. Máx: 2MB.</span>
                        </div>
                        <!-- Email -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Email</label>
                                @error('email')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="email" name="email" id="email"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('email') border-red-700 @enderror"
                                placeholder="Email" required value="{{ old('email', auth()->user()->email) }}" autocomplete="email" />
                        </div>

                        <!-- Contraseña actual -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Contraseña actual</label>
                                @error('password')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="text-sm shadow-sm rounded-md w-full px-3 py-2 pr-10 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('password') border-red-700 @enderror"
                                    placeholder="Contraseña actual" required autocomplete="current-password" value="{{ old('password') }}" />
                                <button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 right-0 flex items-center px-2 py-1 bg-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none">
                                    <span class="icon-show">
                                        <!-- Ojo abierto -->
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                    <span class="icon-hide hidden">
                                        <!-- Ojo tachado -->
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Nueva contraseña (opcional) -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Nueva contraseña (opcional)</label>
                                @error('new_password')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <input type="password" name="new_password" id="new_password"
                                    class="text-sm shadow-sm rounded-md w-full px-3 py-2 pr-10 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('new_password') border-red-700 @enderror"
                                    placeholder="Nueva contraseña" autocomplete="new-password" value="{{ old('new_password') }}" />
                                <button type="button" onclick="togglePassword('new_password', this)" class="absolute inset-y-0 right-0 flex items-center px-2 py-1 bg-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none">
                                    <span class="icon-show">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                    <span class="icon-hide hidden">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Confirmar nueva contraseña -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Confirmar nueva contraseña</label>
                                @error('confirm_password')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="text-sm shadow-sm rounded-md w-full px-3 py-2 pr-10 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('confirm_password') border-red-700 @enderror"
                                    placeholder="Confirmar nueva contraseña" autocomplete="new-password" value="{{ old('confirm_password') }}" />
                                <button type="button" onclick="togglePassword('confirm_password', this)" class="absolute inset-y-0 right-0 flex items-center px-2 py-1 bg-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none">
                                    <span class="icon-show">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                    <span class="icon-hide hidden">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                       <div class="flex justify-center items-center mt-5 w-full">
                        <button type="submit" class="w-4/3 xl:w-1/2 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Actualizar Datos
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lado Derecho: Información Personal y Universitaria -->
<div class="w-full xl:w-3/4 px-0 flex flex-col">
    <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg px-4 md:px-8 py-6 mb-4 w-full flex flex-col min-h-[620px]">
        <h1 class="text-lg 2xl:text-xl font-bold text-gray-800 dark:text-gray-100">Información Personal</h1>
        <hr class="w-full border-t-2 border-gray-300 dark:border-slate-700 my-2"><br>
        <form action="{{ route('datosuser.update') }}" method="POST" enctype="multipart/form-data" novalidate class="flex flex-col h-full">
            @csrf
            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 overflow-visible">
                    <!-- Nombre -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Nombre</label>
                            @error('nombre')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="nombre" id="nombre"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('nombre') border-red-700 @enderror"
                            placeholder="Nombre" required value="{{ old('nombre', auth()->user()->becario->nombre ?? auth()->user()->personal->nombre ?? '') }}" readonly />
                    </div>
                    <!-- Apellido -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="apellido" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Apellido</label>
                            @error('apellido')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="apellido" id="apellido"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('apellido') border-red-700 @enderror"
                            placeholder="Apellido" required value="{{ old('apellido', auth()->user()->becario->apellido ?? auth()->user()->personal->apellido ?? '') }}" autocomplete="family-name" readonly/>
                    </div>
                    <!-- Cédula -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="cedula" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Cédula</label>
                            @error('cedula')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="cedula" id="cedula"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('cedula') border-red-700 @enderror"
                            placeholder="Cédula" required  value="{{ old('apellido', auth()->user()->becario->cedula ?? auth()->user()->personal->cedula ?? '') }}" autocomplete="off" readonly/>
                    </div>
                    <!-- Teléfono -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Teléfono</label>
                            @error('telefono')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="telefono" id="telefono"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('telefono') border-red-700 @enderror"
                            placeholder="Teléfono" required value="{{ old('telefono', auth()->user()->becario->telefono ?? auth()->user()->personal->telefono ?? '')}}" autocomplete="tel" />

                    </div>
                    <!-- Género (Dropdown) -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="genero" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Género</label>
                            @error('genero')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <div x-data="{ open: false, value: '{{ old('genero', auth()->user()->becario->genero ?? auth()->user()->personal->genero ?? '') }}' }" class="relative">
                            <button type="button"
                                @click="open = !open"
                                @blur="setTimeout(() => open = false, 100)"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 text-left focus:outline-none focus:ring-slate-300 focus:border-slate-300 cursor-pointer">
                                <span x-text="value ? value : 'Seleccione género'" :class="value ? '' : 'text-gray-400 dark:text-gray-500'"></span>
                                <span class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200 inline" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </button>
                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-md shadow-lg z-[9999]">
                                <ul>
                                    <li>
                                        <button type="button" @click="value = 'Masculino'; open = false"
                                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:text-white dark:hover:bg-slate-800 transition-colors"
                                            :class="value === 'Masculino' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                                            Masculino
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" @click="value = 'Femenino'; open = false"
                                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:text-white dark:hover:bg-slate-800 transition-colors"
                                            :class="value === 'Femenino' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                                            Femenino
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <input type="hidden" name="genero" :value="value">
                        </div>
                    </div>
                    <!-- Fecha de nacimiento -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Fecha de nacimiento</label>
                            @error('fecha_nacimiento')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('fecha_nacimiento') border-red-700 @enderror"
                            required value="{{ old('fecha_nacimiento', auth()->user()->becario->fecha_nacimiento ?? auth()->user()->personal->fecha_nacimiento ?? '') }}" />
                    </div>
                    <!-- Dirección -->
                    <div class="mb-2">
                        <div class="flex">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Dirección</label>
                            @error('direccion')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                            @enderror
                        </div>
                        <input type="text" name="direccion" id="direccion"
                            class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('direccion') border-red-700 @enderror"
                            placeholder="Dirección" required value="{{ old('direccion', auth()->user()->becario->direccion ?? auth()->user()->personal->direccion ?? '')}}" />
                    </div>
                    @if(auth()->user()->role === 'user')
                        <!-- Carrera -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="carrera" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Carrera</label>
                                @error('carrera')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="text" name="carrera" id="carrera"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('carrera') border-red-700 @enderror"
                                placeholder="Carrera" required value="{{ old('carrera', auth()->user()->becario->carrera ?? auth()->user()->personal->carrera ?? ' ')}}" />
                        </div>
                        <!-- Meta Voluntariado Interno -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="meta_voluntariado_interno" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Meta Voluntariado Interno</label>
                                @error('meta_voluntariado_interno')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="number" min="0" name="meta_voluntariado_interno" id="meta_voluntariado_interno"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('meta_voluntariado_interno') border-red-700 @enderror"
                                placeholder="Horas internas" value="{{ old('meta_volin', auth()->user()->becario->meta_volin ?? ' ')}}" readonly/>
                        </div>
                        <!-- Meta Voluntariado Externo -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="meta_voluntariado_externo" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Meta Voluntariado Externo</label>
                                @error('meta_voluntariado_externo')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="number" min="0" name="meta_voluntariado_externo" id="meta_voluntariado_externo"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('meta_voluntariado_externo') border-red-700 @enderror"
                                placeholder="Horas externas" value="{{ old('meta_volex', auth()->user()->becario->meta_volex ?? ' ')}}"
                                readonly/>
                        </div>
                        <!-- Meta Chats -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="meta_chats" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Meta Chats</label>
                                @error('meta_chats')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="number" min="0" name="meta_chats" id="meta_chats"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('meta_chats') border-red-700 @enderror"
                                placeholder="Cantidad de chats" value="{{ old('meta_chat', auth()->user()->becario->meta_chat ?? ' ') }}"
                                readonly />
                        </div>
                        <!-- Meta Taller -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="meta_taller" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Meta Taller</label>
                                @error('meta_taller')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="number" min="0" name="meta_taller" id="meta_taller"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('meta_taller') border-red-700 @enderror"
                                placeholder="Cantidad de talleres" value="{{ old('meta_taller', auth()->user()->becario->meta_taller ?? '') }}" readonly />
                        </div>
                    @else
                        <!-- Cargo -->
                        <div class="mb-2">
                            <div class="flex">
                                <label for="cargo" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Cargo</label>
                                @error('cargo')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
                                @enderror
                            </div>
                            <input type="text" name="cargo" id="cargo"
                                class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-slate-300 focus:border-slate-300 @error('cargo') border-red-700 @enderror"
                                placeholder="Cargo" required value="{{ old('cargo', auth()->user()->personal->cargo ?? '') }}" />
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="submit"
                    class="w-2/3 lg:w-1/5 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Actualizar Datos
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const iconShow = btn.querySelector('.icon-show');
    const iconHide = btn.querySelector('.icon-hide');
    if (input.type === "password") {
        input.type = "text";
        iconShow.classList.add('hidden');
        iconHide.classList.remove('hidden');
    } else {
        input.type = "password";
        iconShow.classList.remove('hidden');
        iconHide.classList.add('hidden');
    }
}
</script>
<script>
document.getElementById('foto_perfil').addEventListener('change', function(e) {
    if (this.files.length) {
        this.closest('.relative').querySelector('img').src = URL.createObjectURL(this.files[0]);
    }
});
</script>
@endsection
