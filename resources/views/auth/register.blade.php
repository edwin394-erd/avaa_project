@extends('layouts.layout')

@section('titulo-tab')
    REGISTER
@endsection

@section('body-style')
    style="background-image: url('{{ asset('imgs/verdeclaro.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"
@endsection

@section('contenido')
    <!-- component -->
<div class=" flex items-center py-10 justify-center w-full ">

	<div class="bg-white shadow-green-800 shadow-2xl rounded-lg px-8 py-6 w-full md:w-1/3 mx-3">

		<h1 class="text-2xl font-bold text-center mb-4 ">Registrate</h1>

		<form action="{{route('register')}}" method="POST" novalidate>
            @csrf
            <div class="mb-4">
				<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
				<input type="text" name="name" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-700 @enderror" placeholder="Tu nombre" required  value="{{old('name')}}">
                @error('name')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

             <div class="mb-4">
				<label for="lastname" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
				<input type="text" name="lastname" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('lastname') border-red-700 @enderror" placeholder="Tu nombre" required  value="{{old('name')}}">
                @error('lastname')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

			<div class="mb-4">
				<label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo</label>
				<input type="email" name="email" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-700 @enderror" placeholder="tucorreo@email.com" required  value="{{old('email')}}">
                @error('email')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

			<div class="mb-4">
				<label for="password" class="block text-sm font-medium text-gray-700  mb-2">Contraseña</label>
				<input type="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('password') border-red-700 @enderror" placeholder="Ingresa tu Contraseña" required>
                @error('password')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror

			</div>
			<div class="mb-4">
				<label for="password_confirmation" class="block text-sm font-medium text-gray-700  mb-2">Confirmar Contraseña</label>
				<input type="password" name="password_confirmation" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500  @error('password_conftirmation') border-red-700 @enderror" placeholder="Ingresa tu Contraseña" required>
			</div>

			<div class="mb-4">
				<label for="cedula" class="block text-sm font-medium text-gray-700 mb-2">Cédula</label>
				<input type="text" name="cedula" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-700 @enderror" placeholder="Tu cédula" required value="{{old('name')}}">
                @error('cedula')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

			<button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Registrar</button>
		</form>
	</div>
</div>

@endsection
