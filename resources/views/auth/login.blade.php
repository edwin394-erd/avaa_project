@extends('layouts.layout')

@section('titulo-tab')
    LOGIN
@endsection

@section('contenido')
    <!-- component -->
<div class="min-h-full flex items-center py-10 justify-center w-full ">
    
	<div class="bg-white shadow-green-800 shadow-2xl rounded-lg px-8 py-6 w-full md:w-1/3 mx-3">

		<h1 class="text-2xl font-bold text-center mb-4 ">Inicia Sesión</h1>
		<form action="{{route('login')}}" method="POST" novalidate>
			@csrf
			@if (session('msg_error'))
                    <p  class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{@session('msg_error')}}</p>
                    
                @endif

                @if (session('msg_registroExitoso'))
                    <p  class="bg-green-700 text-white my-2 rounded-lg text-sm p-2 text-center">{{@session('msg_registroExitoso')}}</p>
                    
                @endif

			<div class="mb-4">
				<label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo</label>
				<input type="email" name="email" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror" value="{{old('email')}}" placeholder="tucorreo@email.com" required>
				@error('email')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>
			<div class="mb-4">
				<label for="password" class="block text-sm font-medium text-gray-700  mb-2">Contraseña</label>
				<input type="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror" placeholder="Ingresa tu Contraseña" required>
				@error('password')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
				<a href="#"
					class="text-xs text-gray-600 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">¡Olvidaste tu Contraseña?</a>
			</div>
			<div class="flex items-center justify-between mb-4">
				<div class="flex items-center">
					<input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500 focus:outline-none" checked>
					<label for="remember" class="ml-2 block text-sm text-gray-700 ">Recuerdame</label>
				</div>
				<a href="{{route('register')}}"
					class="text-xs text-green-700 hover:text-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Registrarse</a>
			</div>
			<button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Login</button>
		</form>
	</div>
</div>

@endsection