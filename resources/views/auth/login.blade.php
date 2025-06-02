@extends('layouts.auth-layout')

@section('titulo-tab')
    Iniciar Sesión
@endsection

@section('body-style')
    style="background-image: url('{{ asset('imgs/avaa.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"
@endsection

@section('contenido')
<div class="h-screen flex flex-col items-center justify-center py-10 w-full ">
    <div class="mb-10 bg-white shadow-green-900 shadow-2xl rounded-lg px-8 py-6 w-full sm:w-2/3 lg:w-1/3 xl:1/4 mx-3 mt-0 md:mt-20 -translate-y-10">
        <img src="{{ asset('imgs/avaalogo_color.png') }}" class="w-40 mx-auto mb-4" alt="avaa Logo" />
        <h1 class="text-gray-700 text-2xl font-bold text-center mb-4 ">Inicia Sesión</h1>
        <br>

        <form action="{{ route('login') }}" method="POST" novalidate class="max-w-md mx-auto">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="floating_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('email') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('email') }}" autocomplete="email" />
                <label for="floating_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Correo electrónico
                </label>
                @error('email')
                    <p class="text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password" id="floating_password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('password') border-b-2 border-red-500 @enderror"
                    placeholder=" " required autocomplete="current-password" />
                <label for="floating_password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Contraseña
                </label>
                <button type="button" onclick="togglePassword('floating_password', this)"
                    class="absolute right-2 top-2 bg-transparent px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <span class="icon-show">
                        <!-- Ojo abierto -->
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <span class="icon-hide hidden">
                        <!-- Ojo tachado -->
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </button>
                @error('password')
                    <p class="text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500 focus:outline-none">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Recuérdame</label>
                </div>
                <a href="#"
                    class="text-xs text-gray-600 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">¡Olvidaste tu Contraseña?</a>
            </div>
            <br>
            <div class="flex justify-center items-center mb-2">

                <button type="submit"
                    class="w-2/3 md:w-1/3 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Iniciar Sesión
                </button>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('register') }}"
                    class="text-xs text-green-700 hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Registrarse</a>
            </div>
        </form>
        <br>
    </div>
    <div class="container mx-auto text-center text-white">
        <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
    </div>
</div>


@endsection
