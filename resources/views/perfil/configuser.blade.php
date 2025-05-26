@extends('layouts.layout')

@section('titulo-tab')
  Perfil
@endsection

@section('contenido')
<div class="md:w-2/5 mx-auto py-10 px-0 md:px-10">
    <div class="p-0 min-h-[650px]">
            <!-- Inforsmacion personal -->
            <div class="flex items-center justify-center w-full">
                <div class="bg-white shadow-gray-200 border border-gray-300 shadow-2xl rounded-lg px-4 md:px-8 py-6 w-full sm:w-2/3 lg:w-2/3 xl:1/4  mx-3">
                    <h1 class="text-lg 2xl:text-2xl font-bold text-gray-800 text-center">Configuración de Usuario</h1><br>

                    <hr>
                    <form action="{{ route('configuser.update') }}" method="POST" novalidate>
                        @csrf
                         <!-- Email -->
                        <div class="mb-4 mt-4">
                            <div class="flex">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                 @error('email')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{$message}}</p>
                                  @enderror
                            </div>
                            <input type="text" name="email" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-700 @enderror" placeholder="Tu correo electronico" required  value="{{old('email')}}">

                        </div>

                        <!-- Contraseña actual -->
                    <div class="mb-4">
                        <div class="flex">
                              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                               @error('password')
                                <p class="block text-sm font-medium text-red-600 mb-2">- {{$message}}</p>
                                @enderror
                        </div>
                            <input type="text" name="password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('password') border-red-700 @enderror" placeholder="Tu contraseña" required  value="{{old('password')}}">
                        </div>

                        <!-- Nueva contraseña -->
                        <div class="mb-4">
                            <div class="flex">
                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña</label>
                                @error('new_password')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">- {{$message}}</p>
                                @enderror
                            </div>

                            <input type="text" name="new_password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('new_password') border-red-700 @enderror" placeholder="Tu contraseña" required  value="{{old('new_password')}}">
                        </div>

                        <!-- Confirmar nueva contraseña -->
                         <div class="mb-4">
                            <div class="flex">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                                @error('confirm_password')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">- {{$message}}</p>
                                @enderror
                            </div>
                            <input type="text" name="confirm_password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('confirm_password') border-red-700 @enderror" placeholder="Tu contraseña" required  value="{{old('confirm_password')}}">
                        </div>
                        <div class="flex justify-center items-center">
                            <button type="submit"
                                class="mt-auto w-2/3 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Actualizar Datos
                            </button>
                        </div>


                    </form>

                </div>
            </div>
    </div>
</div>


@endsection
