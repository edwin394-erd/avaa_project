@extends('layouts.layout')

@section('titulo-tab')
  Perfil
@endsection

@section('contenido')
<div class="md:w-5/6 mx-auto py-10 px-0 md:px-10">
    <h1 class="text-2xl font-bold text-gray-800 text-center">Perfil de Usuario</h1>
    <h2 class="text-lg font-semibold text-gray-600 text-center">Aquí administrar tu Información Personal, Configuración de Usuario y Metas</h2>
    <hr class="my-4">
    <div class="p-0 min-h-[650px]">
            <!-- Inforsmacion personal -->
            <div class="flex items-center justify-center w-full">
                <div class="bg-white shadow-green-800 shadow-2xl rounded-lg px-8 py-6 w-full sm:w-2/3 lg:w-2/3 xl:1/4  mx-3">
                    <h1 class="text-2xl font-bold text-center mb-4">Configuración de Usuario</h1>
                    <hr>
                    <!-- Email -->
                     <div class="mb-4 mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="text" name="email" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-700 @enderror" placeholder="Tu correo electronico" required  value="{{old('email')}}">
                        @error('email')
                            <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Contraseña actual -->
                   <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                        <input type="text" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('password') border-red-700 @enderror" placeholder="Tu contraseña" required  value="{{old('password')}}">
                        @error('password')
                            <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Nueva contraseña -->
                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña</label>
                        <input type="text" name="new_password" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('new_password') border-red-700 @enderror" placeholder="Tu contraseña" required  value="{{old('new_password')}}">
                        @error('new_password')
                            <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                        @enderror
                    </div>

                    <!-- Confirmar nueva contraseña -->
                   <div class="mb-4">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                        <input type="text" name="confirm_password" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('confirm_password') border-red-700 @enderror" placeholder="Tu contraseña" required  value="{{old('confirm_password')}}">
                        @error('confirm_password')
                            <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Formulario para agregar actividad -->
            <div class="flex items-center justify-center w-full">
                <div class="bg-white shadow-green-800 shadow-2xl rounded-lg px-8 py-6 w-full sm:w-2/3 lg:w-2/3 xl:1/4  mx-3">
                    <h1 class="text-2xl font-bold text-center mb-4">Información Personal</h1>
                    <hr>
                    <form action="#" method="POST">
                        @csrf
                        <!-- Nombre -->
                        <div class="mb-4 mt-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                            <input type="text" name="name" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('name') border-red-700 @enderror" placeholder="Tu nombre completo" required  value="{{old('name')}}">
                            @error('name')
                                <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Cédula -->
                         <div class="mb-4">
                            <label for="cedula" class="block text-sm font-medium text-gray-700 mb-2">Cédula</label>
                            <input type="text" name="cedula" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('cedula') border-red-700 @enderror" placeholder="Tu cédula" required  value="{{old('cedula')}}">
                            @error('cedula')
                                <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Carrera -->
                        <div class="mb-4">
                            <label for="carrera" class="block text-sm font-medium text-gray-700 mb-2">Carrera</label>
                            <input type="text" name="carrera" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('carrera') border-red-700 @enderror" placeholder="Tu carrera" required  value="{{old('carrera')}}">
                            @error('carrera')
                                <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Semestre -->
                       <div class="mb-4">
                            <label for="semestre" class="block text-sm font-medium text-gray-700 mb-2">Semestre</label>
                            <input type="text" name="semestre" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('semestre') border-red-700 @enderror" placeholder="Tu semestre" required  value="{{old('semestre')}}">
                            @error('semestre')
                                <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                         <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="text" name="telefono" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('telefono') border-red-700 @enderror" placeholder="Tu teléfono" required  value="{{old('telefono')}}">
                            @error('telefono')
                                <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Dirección -->
                         <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                            <input type="text" name="direccion" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('direccion') border-red-700 @enderror" placeholder="Tu direccion" required  value="{{old('direccion')}}">
                            @error('direccion')
                                <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Horario -->
                        <label for="horario" class="block text-sm font-medium text-gray-700 mb-2">Horario</label>
                        <div class="flex border border-black p-1 rounded-lg">
                            <label class="block mb-2 text-sm font-medium text-gray-900 w-1/4 border border-r-black text-center" for="multiple_files mx-2">Seleccionar Archivos</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-gray-50  focus:outline-none w-3/4 m-0" id="multiple_files text-center" type="file">
                        </div>

                        <!-- Metas -->
                        <div class="md:col-span-2 grid grid-cols-2 gap-6 my-4">
                            <div >
                                <label for="meta_taller" class="block text-sm font-medium text-gray-700 mb-2">Meta de Talleres</label>
                                <input type="text" name="meta_taller" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('meta_taller') border-red-700 @enderror" placeholder="Tu meta de talleres, Ej: 40 horas" required  value="{{old('meta_taller')}}">
                                @error('meta_taller')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                                @enderror
                            </div>
                            <div >
                                <label for="meta_chat" class="block text-sm font-medium text-gray-700 mb-2">Meta de Chats</label>
                                <input type="text" name="meta_chat" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('meta_chat') border-red-700 @enderror" placeholder="Tu meta de chats, Ej: 15 horas" required  value="{{old('meta_chat')}}">
                                @error('meta_chat')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="meta_volin" class="block text-sm font-medium text-gray-700 mb-2">Meta de Voluntariado Interno</label>
                                <input type="text" name="meta_volin" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('meta_volin') border-red-700 @enderror" placeholder="Tu meta de voluntariado interno, Ej: 60 horas" required  value="{{old('meta_volin')}}">
                                @error('meta_volin')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                                @enderror
                            </div>
                            <div >
                                <label for="meta_volex" class="block text-sm font-medium text-gray-700 mb-2">Meta de Voluntariado Interno</label>
                                <input type="text" name="meta_volex" class="shadow-sm rounded-md w-full px-3 py-2 border focus:outline-none focus:ring-green-500 focus:border-green-500 @error('meta_volex') border-red-700 @enderror" placeholder="Tu meta de voluntariado externo, Ej: 40 horas" required  value="{{old('meta_volex')}}">
                                @error('meta_volex')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
            </div>



    </div>
</div>


@endsection
