{{-- filepath: resources\views\auth\forgotpassword.blade.php --}}
@extends('layouts.auth-layout')

@section('titulo-tab')
    Recuperar Contraseña
@endsection

@section('body-style')
    style="background-image: url('{{ asset('imgs/avaa.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"
@endsection

@section('contenido')
<div class="h-screen flex flex-col items-center justify-center py-10 w-full ">
    <div class="mb-10 bg-white dark:bg-slate-900 shadow-green-900 shadow-2xl rounded-lg px-8 py-6 w-full sm:w-2/3 lg:w-1/3 xl:1/4 mx-3 mt-0 md:mt-20 -translate-y-10">
        <img src="{{ asset('imgs/avaalogo_color.png') }}" class="w-40 mx-auto mb-4" alt="avaa Logo" />
        <h1 class="text-gray-700 dark:text-gray-100 text-2xl font-bold text-center mb-4 ">Recuperar Contraseña</h1>
        <br>

        <form action="{{ route('recuperar.contrasena.enviar') }}" method="POST" novalidate class="max-w-md mx-auto">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="floating_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 dark:text-gray-100 bg-transparent border-0 border-b-2 border-gray-300 dark:border-slate-600 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 dark:focus:border-green-400 peer @error('email') border-b-2 border-red-500 @enderror"
                    placeholder=" " required value="{{ old('email') }}" autocomplete="email" />
                <label for="floating_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-300 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Correo electrónico
                </label>
                @error('email')
                    <p class="text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end text-right">
                <a href="{{ route('login') }}"
                    class="text-xs text-slate-600 dark:text-gray-300 hover:text-slate-500 dark:hover:text-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">Volver al inicio de sesión</a>
            </div>
            <br>
            <div class="flex justify-center items-center mb-2">
                <button type="submit"
                    class="w-2/3 md:w-1/3 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Recuperar
                </button>
            </div>
        </form>
        <br>
    </div>
    <div class="container mx-auto text-center text-white">
        <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
    </div>
</div>
@endsection
