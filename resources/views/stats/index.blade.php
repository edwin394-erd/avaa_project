@extends('layouts.layout')

@section('titulo-tab')
    Tabla de Estadísticas
@endsection

@section('contenido')
<div class="md:w-5/6 mx-auto p-10">

    <h1 class="text-2xl font-bold text-gray-800 text-center">Tabla de Actividades</h1>
    <h2 class="text-lg font-semibold text-gray-600 text-center">Aquí puedes agregar actividades y ver tus estadísticas</h2>
    <hr class="my-4">
    <br>

<div class="flex flex-wrap p-0">
    <!-- Formulario para agregar actividad -->
    <div class="w-full lg:w-1/4 p-2">
      <div class="flex flex-col bg-white border shadow-xl shadow-green-600 rounded-xl p-5">
        <h1 class="text-2xl font-bold text-center mb-4">Agregar Actividad</h1>
        <form action="{{ route('stat.store') }}" method="POST" novalidate>
          @csrf
          <div class="mb-4">
            <div class="flex">
              <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">Título</label>
              @error('titulo')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
              @enderror
            </div>
            <input type="text" name="titulo" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('titulo') border-red-700 @enderror" placeholder="Titulo de la Actividad" required value="{{ old('titulo') }}">
          </div>

          <div class="mb-4">
            <div class="flex">
              <label for="actividad" class="block text-sm font-medium text-gray-700 mb-2">Actividad</label>
              @error('actividad')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
              @enderror
            </div>
            <select name="actividad" class="shadow-sm rounded-md bg-white w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('actividad') border-red-700 @enderror">
              <option value="">Seleccione</option>
              <option value="chat">Chat</option>
              <option value="taller">Taller de Formación</option>
              <option value="volin">Voluntariado Interno</option>
              <option value="volex">Voluntariado Externo</option>
            </select>
          </div>

          <div class="mb-4">
            <div class="flex">
              <label for="modalidad" class="block text-sm font-medium text-gray-700 mb-2">Modalidad</label>
              @error('modalidad')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
              @enderror
            </div>
            <select name="modalidad" class="shadow-sm rounded-md bg-white w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('modalidad') border-red-700 @enderror">
              <option value="">Seleccione</option>
              <option value="presencial">Presencial</option>
              <option value="online">Online</option>
            </select>
          </div>

          <div class="mb-4">
            <div class="flex">
              <label for="duracion" class="block text-sm font-medium text-gray-700 mb-2">Duración</label>
              @error('duracion')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
              @enderror
            </div>
            <input type="text" name="duracion" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('duracion') border-red-700 @enderror" placeholder="Ejemplo: 1.5" required value="{{ old('duracion') }}">
          </div>

          <div class="mb-4">
            <div class="flex">
              <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha</label>
              @error('fecha')
                <p class="block text-sm font-medium text-red-600 mb-2">- {{ $message }}</p>
              @enderror
            </div>
            <input type="date" name="fecha" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('fecha') border-red-700 @enderror" required value="{{ old('fecha') }}">
          </div>

          <input type="hidden" name="user_id" value="{{ $user->id }}">

          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-700 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Agregar</button>
        </form>
      </div>
    </div>

    <!-- Tabla de estadísticas -->
    <div class="w-full lg:w-3/4 p-2">
      <div class="flex flex-col bg-white border shadow-xl shadow-green-600 rounded-xl p-5">
        <div class="overflow-y-auto h-[510px]">
          <table class="w-full text-sm text-left rtl:text-right text-black table-auto bg-white" id="myTable">
            <thead class="text-green-700 text-md uppercase">
              <tr>
                <th scope="col" class="px-1 py-3">Titulo</th>
                <th scope="col" class="px-1 py-3">Actividad</th>
                <th scope="col" class="px-1 py-3">Modalidad</th>
                <th scope="col" class="px-1 py-3">Horas</th>
                <th scope="col" class="px-1 py-3">Fecha</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($stats as $stat)
                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-green-100">
                  <td class="px-1 py-4 ">{{ $stat->titulo }}</td>
                  <td class="px-1 py-4">
                    @switch($stat->actividad)
                      @case('chat')
                        Chat
                        @break
                      @case('taller')
                        Taller de Formación
                        @break
                      @case('volin')
                        Voluntariado Interno
                        @break
                      @case('volex')
                        Voluntariado Externo
                        @break
                      @default
                        {{ $stat->actividad }}
                    @endswitch 
                  </td>
                  <td class="px-1 py-4">{{ $stat->modalidad }}</td>
                  <td class="px-1 py-4">{{ $stat->duracion }}</td>
                  <td class="px-1 py-4">{{ $stat->fecha }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="p-10 text-center uppercase text-gray-500 align-middle">no tienes estadísticas</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection