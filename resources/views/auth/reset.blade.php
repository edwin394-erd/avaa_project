{{-- filepath: resources/views/auth/reset.blade.php --}}
@extends('layouts.auth-layout')

@section('titulo-tab')
    Restablecer Contraseña
@endsection

@section('body-style')
    style="background-image: url('{{ asset('imgs/avaa.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"
@endsection

@section('contenido')
<div class="h-screen flex flex-col items-center justify-center py-10 w-full ">
    <div class="mb-10 bg-white shadow-green-900 shadow-2xl rounded-lg px-8 xl:px-20 py-6 w-full sm:w-2/3 lg:w-1/3 xl:1/4 mx-3 mt-0 md:mt-20 -translate-y-10">
        <img src="{{ asset('imgs/avaalogo_color.png') }}" class="w-40 mx-auto mb-4" alt="avaa Logo" />
        <h1 class="text-gray-700 text-md xl:text-xl font-bold text-center mb-2 ">Restablecer Contraseña</h1> <br>

        <form action="{{ route('password.update') }}" method="POST" novalidate>
             @csrf
            <!-- Email -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="email" id="reset_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('email') border-red-500 @enderror"
                    placeholder=" " required value="{{ old('email', $email ?? '') }}" autocomplete="email" />
                <label for="reset_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Correo electrónico
                </label>
                @error('email')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nueva contraseña -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password" id="reset_password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer @error('password') border-red-500 @enderror"
                    placeholder=" " required autocomplete="new-password" />
                <label for="reset_password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Nueva contraseña
                </label>
                <button type="button" onclick="togglePassword('reset_password', this)" class="absolute right-2 top-3 bg-transparent px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <span class="icon-show">
                        <!-- Ojo abierto -->
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                    <span class="icon-hide hidden">
                        <!-- Ojo tachado -->
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                </button>
                @error('password')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="password" name="password_confirmation" id="reset_password_confirmation"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-green-600 peer"
                    placeholder=" " required autocomplete="new-password" />
                <label for="reset_password_confirmation"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-green-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Confirmar contraseña
                </label>
                <button type="button" onclick="togglePassword('reset_password_confirmation', this)" class="absolute right-2 top-3 bg-transparent px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <span class="icon-show">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                    <span class="icon-hide hidden">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </span>
                </button>
            </div>

            <!-- Token oculto -->
            <input type="hidden" name="token" value="{{ $token }}">
           <div class="flex justify-end text-right">
                <a href="{{ route('login') }}"
                    class="text-xs text-slate-600 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">Volver al inicio de sesión</a>
            </div>
            <br>
            <div class="flex justify-center items-center">
                <button type="submit"
                    class="mt-auto w-2/3 md:w-1/3 flex justify-center py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Restablecer
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
