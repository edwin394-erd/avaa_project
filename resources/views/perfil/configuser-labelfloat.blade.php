{{-- filepath: resources\views\perfil\configuser.blade.php --}}
@extends('layouts.layout')

@section('titulo-tab')
    Perfil
@endsection
<script src="//unpkg.com/alpinejs" defer></script>

@section('contenido')
       <style>
        /* Opciones del select en modo claro */
        select option {
            @apply text-slate-900 bg-white;
        }
        /* Opciones del select en modo oscuro */
        @media (prefers-color-scheme: dark) {
            #optionx, select option {
                color: #f1f5f9 !important;      /* slate-100 */
                background: #0f172a !important; /* slate-900 */
            }
        }
        </style>
<div class="flex flex-col md:flex-row w-full py-10  min-h-screen px-4">
    <!-- Lado Izquierdo: Formulario (1/4 en xl, w-full en sm) -->
    <div class="w-full xl:w-1/4 px-0 xl:pr-3 mb-8 xl:mb-0 flex flex-col">
        <div class="p-0 flex flex-col h-full">
            <div class="flex w-full">
                <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 px-2 rounded-lg px-4 md:px-8 py-6 w-full">
                    <h1 class="text-lg 2xl:text-xl font-bold text-gray-800 dark:text-gray-100">Configuración Usuario</h1>
                    <hr class="w-full border-t-2 border-gray-300 dark:border-slate-700 my-2"><br>
                    <form action="{{ route('configuser.update') }}" method="POST" novalidate>
                        @csrf

                        <!-- Email -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" name="email" id="email"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('email') border-b-2 border-red-500 @enderror"
                                placeholder=" " required value="{{ old('email', auth()->user()->email) }}" autocomplete="email" />
                            <label for="email"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Email
                            </label>
                            @error('email')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contraseña actual -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="password" id="password"
                                class="block py-2.5 px-0 pr-10 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('password') border-b-2 border-red-500 @enderror"
                                placeholder=" " required value="{{ old('password') }}" autocomplete="current-password" />
                            <label for="password"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Contraseña actual
                            </label>
                            <button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 right-0 flex items-center px-2 py-1 bg-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none">
                                <span class="icon-show">
                                    <!-- Ojo abierto -->
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                        <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                    </svg>
                                </span>
                                <span class="icon-hide hidden">
                                    <!-- Ojo tachado -->
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                    </svg>
                                </span>
                            </button>
                            @error('password')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nueva contraseña (opcional) -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="new_password" id="new_password"
                                class="block py-2.5 px-0 pr-10 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('new_password') border-b-2 border-red-500 @enderror"
                                placeholder=" " value="{{ old('new_password') }}" autocomplete="new-password" />
                            <label for="new_password"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Nueva contraseña (opcional)
                            </label>
                            <button type="button" onclick="togglePassword('new_password', this)" class="absolute inset-y-0 right-0 flex items-center px-2 py-1 bg-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none">
                                <span class="icon-show">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                        <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                    </svg>
                                </span>
                                <span class="icon-hide hidden">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                    </svg>
                                </span>
                            </button>
                            @error('new_password')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirmar nueva contraseña -->
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="password" name="confirm_password" id="confirm_password"
                                class="block py-2.5 px-0 pr-10 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('confirm_password') border-b-2 border-red-500 @enderror"
                                placeholder=" " value="{{ old('confirm_password') }}" autocomplete="new-password" />
                            <label for="confirm_password"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Confirmar nueva contraseña
                            </label>
                            <button type="button" onclick="togglePassword('confirm_password', this)" class="absolute inset-y-0 right-0 flex items-center px-2 py-1 bg-transparent text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none">
                                <span class="icon-show">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                        <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                    </svg>
                                </span>
                                <span class="icon-hide hidden">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:stroke-white" />
                                    </svg>
                                </span>
                            </button>
                            @error('confirm_password')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="flex justify-center items-center">
                            <button type="submit"
                                class="mt-auto w-2/3 lg:w-1/5flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Actualizar Datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Lado Derecho: Contenido (3/4 en xl, w-full en sm) -->
    <div class="w-full xl:w-3/4 px-0 flex flex-col">
       <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg px-4 md:px-8 py-6 mb-4 w-full flex flex-col h-full">
        <h1 class="text-lg 2xl:text-xl font-bold text-gray-800 dark:text-gray-100">Información Personal</h1>
        <hr class="w-full border-t-2 border-gray-300 dark:border-slate-700 my-2">
        <br>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Nombre -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="nombre" id="nombre"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('nombre') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('nombre', auth()->user()->nombre) }}" autocomplete="given-name" />
                <label for="nombre"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Nombre
                </label>
                @error('nombre')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Apellido -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="apellido" id="apellido"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('apellido') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('apellido', auth()->user()->apellido) }}" autocomplete="family-name" />
                <label for="apellido"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Apellido
                </label>
                @error('apellido')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cédula -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="cedula" id="cedula"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('cedula') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('cedula', auth()->user()->cedula) }}" autocomplete="off" />
                <label for="cedula"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Cédula
                </label>
                @error('cedula')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Teléfono -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="telefono" id="telefono"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('telefono') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('telefono', auth()->user()->telefono) }}" autocomplete="tel" />
                <label for="telefono"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Teléfono
                </label>
                @error('telefono')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            {{-- genero --}}
            <div x-data="{ open: false, value: '{{ old('genero', auth()->user()->genero) }}', isFocused: false }" class="relative z-0 w-full mb-5 group">
                <button type="button"
                    @click="open = !open"
                    @blur="setTimeout(() => open = false, 100)"
                    @focus="isFocused = true"
                    @click.away="isFocused = false"
                    class="block py-2.5 px-0 w-full text-left text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer cursor-pointer relative">
                    <span
                        x-text="value ? value : 'Seleccione una opción'"
                        :class="value ? 'text-gray-900 dark:text-gray-100' : 'text-white dark:text-slate-900'"
                    ></span>
                    <span class="absolute right-0 top-1/2 -translate-y-1/2 pr-1">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                </button>
                <!-- Dropdown -->
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg shadow-lg z-10">
                    <ul>
                        <li>
                            <button type="button" @click="value = 'Masculino'; open = false"
                                class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                                :class="value === 'Masculino' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                                Masculino
                            </button>
                        </li>
                        <li>
                            <button type="button" @click="value = 'Femenino'; open = false"
                                class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                                :class="value === 'Femenino' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                                Femenino
                            </button>
                        </li>
                    </ul>
                </div>
                <!-- Hidden input for form submission -->
                <input type="hidden" name="genero" :value="value">

                <!-- Flotante label ajustado -->
                <label for="genero"
                    :class="{
                        'absolute text-sm duration-300 transform z-10 origin-[0] peer-focus:text-green-600 dark:text-white': true,
                        'top-2 left-0 transform scale-100 text-gray-500': !value && !isFocused,
                        'top-0 scale-75 -translate-y-3 text-lg text-gray-900 dark:text-white': value || isFocused
                    }">
                    Género
                </label>

                @error('genero')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>


            <!-- Fecha de nacimiento -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('fecha_nacimiento') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('fecha_nacimiento', auth()->user()->fecha_nacimiento) }}" />
                <label for="fecha_nacimiento"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Fecha de nacimiento
                </label>
                @error('fecha_nacimiento')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

             <!-- Direccion -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="direccion" id="direccion"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('direccion') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('direccion', auth()->user()->direccion) }}" />
                <label for="direccion"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Dirección
                </label>
                @error('direccion')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex lg:text-center lg:items-center mt-4">
            <button type="submit"
                class="mt-auto w-2/3 lg:w-1/5 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Actualizar Datos
            </button>
        </div>
    </div>
   <div class="bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-lg px-4 md:px-8 py-6 mb-4 w-full flex flex-col h-full">
        <h1 class="text-lg 2xl:text-xl font-bold text-gray-800 dark:text-gray-100">Información Universitaria</h1>
        <hr class="w-full border-t-2 border-gray-300 dark:border-slate-700 my-2"><br>
<form action="{{ route('configuser.update') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 overflow-visible">
      <!-- Tipo de Universidad (Dropdown animado con Alpine.js) -->
    <div x-data="{ open: false, value: '{{ old('tipo_universidad', auth()->user()->tipo_universidad) }}', zIndex: 30, isFocused: false }" class="relative w-full mb-5 group">
        <button type="button"
            @click="open = !open; zIndex = open ? 50 : 30"
            @blur="setTimeout(() => { open = false; zIndex = 30 }, 100)"
            @focus="isFocused = true"
            @click.away="isFocused = false"
            class="block py-2.5 px-0 w-full text-left text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer cursor-pointer relative"
            :style="{ zIndex: zIndex }">
            <span
                x-text="value ? value : 'Seleccione una opción'"
                :class="value ? 'text-gray-900 dark:text-gray-100' : 'text-white dark:text-slate-900 '"
            ></span>
            <span class="absolute right-0 top-1/2 -translate-y-1/2 pr-1">
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
            class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded shadow-lg"
            :style="{ zIndex: zIndex }">
            <ul>
                <li>
                    <button type="button" @click="value = 'Privada'; open = false"
                        class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                        :class="value === 'Privada' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                        Privada
                    </button>
                </li>
                <li>
                    <button type="button" @click="value = 'Publica'; open = false"
                        class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                        :class="value === 'Publica' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                        Pública
                    </button>
                </li>
            </ul>
        </div>

        <input type="hidden" name="tipo_universidad" :value="value">

        <label for="tipo_universidad"
            :class="{
                'absolute text-sm duration-300 transform z-10 origin-[0] peer-focus:text-green-600 dark:text-white': true,
                'top-2 left-0 transform scale-100 text-gray-500': !value && !isFocused,
                'top-0 scale-75 -translate-y-3 text-lg text-gray-900 dark:text-white': value || isFocused
            }"
            :style="{ zIndex: zIndex + 1 }">
            Tipo de Universidad
        </label>

        @error('tipo_universidad')
            <span class="text-xs text-red-600">{{ $message }}</span>
        @enderror
    </div>


       <!-- Área de Estudio (Dropdown animado con Alpine.js) -->
        <div x-data="{ open: false, value: '{{ old('area_estudio', auth()->user()->area_estudio) }}', zIndex: 30, isFocused: false }" class="relative w-full mb-5 group">
            <button type="button"
                @click="open = !open; zIndex = open ? 50 : 30"
                @blur="setTimeout(() => { open = false; zIndex = 30 }, 100)"
                @focus="isFocused = true"
                @click.away="isFocused = false"
                class="block py-2.5 px-0 w-full text-left text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer cursor-pointer relative"
                :style="{ zIndex: zIndex }">
                <span
                    x-text="value ? value : 'Seleccione una opción'"
                    :class="value ? 'text-gray-900 dark:text-gray-100' : 'text-white dark:text-slate-900 '"
                ></span>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 pr-1">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded shadow-lg"
                :style="{ zIndex: zIndex }">
                <ul>
                    <li>
                        <button type="button" @click="value = 'Arquitectura y Urbanismo'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'Arquitectura y Urbanismo' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            Arquitectura y Urbanismo
                        </button>
                    </li>
                    <li>
                        <button type="button" @click="value = 'Ciencias de la Salud'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'Ciencias de la Salud' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            Ciencias de la Salud
                        </button>
                    </li>
                    <li>
                        <button type="button" @click="value = 'Juridico-Políticas'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'Juridico-Políticas' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            Jurídico-Políticas
                        </button>
                    </li>
                    <li>
                        <button type="button" @click="value = 'Ciencias Sociales'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'Ciencias Sociales' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            Ciencias Sociales
                        </button>
                    </li>
                    <li>
                        <button type="button" @click="value = 'Humanidades y Educación'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'Humanidades y Educación' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            Humanidades y Educación
                        </button>
                    </li>
                    <li>
                        <button type="button" @click="value = 'STEM'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'STEM' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            STEM (Ciencias, Tecnología, Ingenierías, Matemáticas)
                        </button>
                    </li>
                    <li>
                        <button type="button" @click="value = 'Otros'; open = false"
                            class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors"
                            :class="value === 'Otros' ? 'font-bold text-green-700 dark:text-green-400' : ''">
                            Otros
                        </button>
                    </li>
                </ul>
            </div>

            <input type="hidden" name="area_estudio" :value="value">

            <label for="area_estudio"
                :class="{
                    'absolute text-sm duration-300 transform z-10 origin-[0] peer-focus:text-green-600 dark:text-white': true,
                    'top-2 left-0 transform scale-100 text-gray-500': !value && !isFocused,
                    'top-0 scale-75 -translate-y-3 text-lg text-gray-900 dark:text-white': value || isFocused
                }"
                :style="{ zIndex: zIndex + 1 }">
                Área de Estudio
            </label>

            @error('area_estudio')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>


        <!-- Escala de Evaluación (Dropdown animado con Alpine.js) -->
        <div x-data="{ open: false, value: '{{ old('escala_evaluacion', auth()->user()->escala_evaluacion) }}', zIndex: 30 }" class="relative z-30 w-full mb-5 group">
            <button type="button"
                @click="open = !open; zIndex = open ? 50 : 30"
                @blur="setTimeout(() => { open = false; zIndex = 30 }, 100)"
                class="block py-2.5 px-0 w-full text-left text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer cursor-pointer relative z-20">
                <span x-text="value ? value : 'Seleccione escala'" :class="value ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-500'"></span>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 pr-1">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded shadow-lg z-30">
                <ul>
                    <li><button type="button" @click="value = '0-20'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === '0-20' ? 'font-bold text-green-700 dark:text-green-400' : ''">0-20</button></li>
                    <li><button type="button" @click="value = '0-10'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === '0-10' ? 'font-bold text-green-700 dark:text-green-400' : ''">0-10</button></li>
                    <li><button type="button" @click="value = 'A-F'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'A-F' ? 'font-bold text-green-700 dark:text-green-400' : ''">A-F</button></li>
                    <li><button type="button" @click="value = 'Otro'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'Otro' ? 'font-bold text-green-700 dark:text-green-400' : ''">Otro</button></li>
                </ul>
            </div>
            <input type="hidden" name="escala_evaluacion" :value="value">
            <label for="escala_evaluacion"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Escala de Evaluación
            </label>
            @error('escala_evaluacion')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Régimen de Estudio (Dropdown animado con Alpine.js) -->
        <div x-data="{ open: false, value: '{{ old('regimen_estudio', auth()->user()->regimen_estudio) }}', zIndex: 30 }" class="relative z-30 w-full mb-5 group">
            <button type="button"
                @click="open = !open; zIndex = open ? 50 : 30"
                @blur="setTimeout(() => { open = false; zIndex = 30 }, 100)"
                class="block py-2.5 px-0 w-full text-left text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer cursor-pointer relative z-20">
                <span x-text="value ? value : 'Seleccione régimen'" :class="value ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-500'"></span>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 pr-1">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded shadow-lg z-30">
                <ul>
                    <li><button type="button" @click="value = 'Semestral'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'Semestral' ? 'font-bold text-green-700 dark:text-green-400' : ''">Semestral</button></li>
                    <li><button type="button" @click="value = 'Anual'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'Anual' ? 'font-bold text-green-700 dark:text-green-400' : ''">Anual</button></li>
                    <li><button type="button" @click="value = 'Trimestral'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'Trimestral' ? 'font-bold text-green-700 dark:text-green-400' : ''">Trimestral</button></li>
                    <li><button type="button" @click="value = 'Otro'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'Otro' ? 'font-bold text-green-700 dark:text-green-400' : ''">Otro</button></li>
                </ul>
            </div>
            <input type="hidden" name="regimen_estudio" :value="value">
            <label for="regimen_estudio"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Régimen de Estudio
            </label>
            @error('regimen_estudio')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Posee Beca? (Dropdown animado con Alpine.js) -->
        <div x-data="{ open: false, value: '{{ old('posee_beca', auth()->user()->posee_beca) }}', zIndex: 30 }" class="relative z-30 w-full mb-5 group">
            <button type="button"
                @click="open = !open; zIndex = open ? 50 : 30"
                @blur="setTimeout(() => { open = false; zIndex = 30 }, 100)"
                class="block py-2.5 px-0 w-full text-left text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer cursor-pointer relative z-20">
                <span x-text="value ? value : '¿Posee beca?'" :class="value ? 'text-gray-900 dark:text-gray-100' : 'text-gray-400 dark:text-gray-500'"></span>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 pr-1">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-300 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                class="absolute left-0 right-0 mt-1 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded shadow-lg z-30">
                <ul>
                    <li><button type="button" @click="value = 'Si'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'Si' ? 'font-bold text-green-700 dark:text-green-400' : ''">Sí</button></li>
                    <li><button type="button" @click="value = 'No'; open = false" class="w-full text-left px-4 py-2 hover:bg-green-100 dark:hover:bg-slate-800 dark:text-white transition-colors" :class="value === 'No' ? 'font-bold text-green-700 dark:text-green-400' : ''">No</button></li>
                </ul>
            </div>
            <input type="hidden" name="posee_beca" :value="value">
            <label for="posee_beca"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                ¿Posee Beca?
            </label>
            @error('posee_beca')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Comprobante de Inscripción (File) -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="file" name="comprobante_inscripcion" id="comprobante_inscripcion"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('comprobante_inscripcion') border-b-2 border-red-500 @enderror"
                accept=".pdf,.jpg,.jpeg,.png" />
            <label for="comprobante_inscripcion"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Comprobante de Inscripción
            </label>
            @error('comprobante_inscripcion')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Horario de Clases (File) -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="file" name="horario_clases" id="horario_clases"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-700 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('horario_clases') border-b-2 border-red-500 @enderror"
                accept=".pdf,.jpg,.jpeg,.png" />
            <label for="horario_clases"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Horario de Clases
            </label>
            @error('horario_clases')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="flex mt-4">
        <button type="submit"
            class="mt-auto w-2/3 lg:w-1/5 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
@endsection
