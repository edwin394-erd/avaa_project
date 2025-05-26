@extends('layouts.auth-layout')

@section('titulo-tab')
    LOGIN
@endsection

@section('body-style')
    style="background-image: url('{{ asset('imgs/avaa.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"
@endsection

@section('contenido')
    <!-- component -->
<div class="h-screen flex flex-col items-center justify-center py-10 w-full ">
	<div class="mb-10 bg-white shadow-green-900 shadow-2xl rounded-lg px-8 py-6 w-full sm:w-2/3 lg:w-1/3 xl:1/4 mx-3 mt-0 md:mt-20">

		<img src="{{ asset('imgs/avaalogo_color.png') }}" class="w-40 mx-auto mb-4" alt="avaa Logo" />
		<h1 class="text-gray-700 text-2xl font-bold text-center mb-4 ">Inicia Sesión</h1>
		<hr><br>

		<form action="{{route('login')}}" method="POST" novalidate>
			@csrf
			@if (session('msg_error'))
				<p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{@session('msg_error')}}</p>
			@endif

			@if (session('msg_registroExitoso'))
				<p class="bg-green-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{@session('msg_registroExitoso')}}</p>
			@endif

			<div class="mb-4">
				<label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo</label>
				<input type="email" name="email" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror" value="{{old('email')}}" placeholder="tucorreo@email.com" required>
				@error('email')
					<p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
				@enderror
			</div>
			<div class="mb-4">
				<label for="password" class="block text-sm font-medium text-gray-700  mb-2">Contraseña</label>
				<input type="password" name="password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror" placeholder="Ingresa tu Contraseña" required>
				@error('password')
					<p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
				@enderror
				<a href="#"
					class="text-xs text-gray-600 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">¡Olvidaste tu Contraseña?</a>
			</div>
			<div class="flex items-center justify-between mb-4">
				<div class="flex items-center">
					<input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500 focus:outline-none">
					<label for="remember" class="ml-2 block text-sm text-gray-700 ">Recuerdame</label>
				</div>
				<a href="{{route('register')}}"
					class="text-xs text-green-700 hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Registrarse</a>
			</div>
            <div class="flex justify-center items-center">
                	<button type="submit" class="w-2/3 md:w-1/3 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Iniciar Sesión</button>
            </div>

		</form>
		<br>
	</div>
	<div class="container mx-auto text-center text-white">
    <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
  </div>
</div>

@endsection
