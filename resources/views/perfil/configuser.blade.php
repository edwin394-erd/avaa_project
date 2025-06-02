@extends('layouts.layout')

@section('titulo-tab')
  Perfil
@endsection

@section('contenido')
<div class="w-3/3 md:w-4/5 lg:w-3/5 xl:w-2/5 2xl:2/5 mx-auto py-10 px-0 md:px-10">
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
                            <input type="text" name="email" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('email') border-red-700 @enderror" placeholder="Tu correo electronico" required  value="{{old('email', auth()->user()->email)}}">

                        </div>

                        <!-- Contraseña actual -->
                        <div class="mb-4">
                            <div class="flex">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                                @error('password')
                                    <p class="block text-sm font-medium text-red-600 mb-2">- {{$message}}</p>
                                @enderror
                            </div>
                            <div class="relative flex items-center">
                                <input type="password" name="password" id="password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('password') border-red-700 @enderror" placeholder="Tu contraseña" required value="{{old('password')}}">
                                <button type="button" onclick="togglePassword('password', this)" class="absolute right-2 bg-transparent px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <span class="icon-show">
                                        <!-- Ojo abierto -->
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </span>
                                    <span class="icon-hide hidden">
                                        <!-- Ojo tachado -->
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Nueva contraseña -->
                        <div class="mb-4">
                            <div class="flex">
                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña (Opcional)</label>
                                @error('new_password')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">- {{$message}}</p>
                                @enderror
                            </div>
                            <div class="relative flex items-center">
                                <input type="password" name="new_password" id="new_password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('new_password') border-red-700 @enderror" placeholder="Ingresa tu nueva contraseña" value="{{old('new_password')}}">
                                <button type="button" onclick="togglePassword('new_password', this)" class="absolute right-2 bg-transparent px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <span class="icon-show">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </span>
                                    <span class="icon-hide hidden">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Confirmar nueva contraseña -->
                        <div class="mb-4">
                            <div class="flex">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                                @error('confirm_password')
                                    <p class=" text-red-600 my-2 rounded-lg text-sm py-0 px-1 text-left">- {{$message}}</p>
                                @enderror
                            </div>
                            <div class="relative flex items-center">
                                <input type="password" name="confirm_password" id="confirm_password" class="text-sm shadow-sm rounded-md w-full px-3 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 @error('confirm_password') border-red-700 @enderror" placeholder="Confirmar nueva contraseña" value="{{old('confirm_password')}}">
                                <button type="button" onclick="togglePassword('confirm_password', this)" class="absolute right-2 bg-transparent px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <span class="icon-show">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </span>
                                    <span class="icon-hide hidden">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </span>
                                </button>
                            </div>
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
