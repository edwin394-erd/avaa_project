@extends('layouts.layout')

@section('titulo-tab')
    Agregar Actividad
@endsection

@section('contenido')
<div class="min-h-full flex items-center py-10 justify-center w-full ">
    
	<div class="bg-white shadow-green-800 shadow-2xl rounded-lg px-8 py-6 w-full md:w-1/3 mx-3">

		<h1 class="text-2xl font-bold text-center mb-4 ">Agregar Actividad</h1>

        <form action="{{route('stat.store')}}" method="POST" novalidate>
            @csrf
            <div class="mb-4">
				<label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Titulo</label>
				<input type="text" name="titulo" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('titulo') border-red-700 @enderror" placeholder="Titulo de la Actividad" required value="{{old('titulo')}}">
                @error('titulo')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

			<div class="mb-4">
				<label for="actividad" class="block text-sm font-medium text-gray-700 mb-2">Actividad</label>		
                <select name="actividad" class="shadow-sm rounded-md bg-white w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('actividad') border-red-700 @enderror">
                    <option value="">Seleccione</option>
                    <option value="chat">Chat</option>
                    <option value="taller">Taller de Formación</option>
                    <option value="volin">Voluntariado Interno</option>
                    <option value="volex">Voluntariado Externo</option>
                </select>
                @error('actividad')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

            <div class="mb-4">
				<label for="modalidad" class="block text-sm font-medium text-gray-700 mb-2">Modalidad</label>		
                <select name="modalidad" class="shadow-sm rounded-md bg-white w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('modalidad') border-red-700 @enderror">
                    <option value="">Seleccione</option>
                    <option value="presencial">Presencial</option>
                    <option value="online">Online</option>
                </select>
                @error('modalidad')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>
            
            <div class="mb-4">
				<label for="duracion" class="block text-sm font-medium text-gray-700 mb-2">Duración</label>
				<input type="text" name="duracion" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('duracion') border-red-700 @enderror" placeholder="Ejemplo: 1.5" required value="{{old('duracion')}}">
                @error('duracion')
                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                @enderror
			</div>

            <input type="hidden" name="user_id" value="{{$user->id}}">
			
			<button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Agregar</button>
        </form>
	</div>
</div>

@endsection