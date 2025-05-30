<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <title>@yield('titulo-tab')</title>
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('icono.png') }}" type="image/png" />
</head>

<body class="bg-gray-100 h-screen flex flex-col p-0" @yield('body-style') >
<div id="loader-bg" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[99999]">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-12 w-12 text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <span class="text-white text-lg font-semibold">Cargando...</span>
    </div>
</div>

@php
  $currentRoute = Route::currentRouteName();
@endphp

@guest
<nav class="border-gray-200 bg-slate-800">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-0">
  <a href="{{route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse ms-2">
    <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-14" alt="avaa Logo" />
    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Stats</span>
  </a>
  <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2  text-gray-400 hover:bg-blue-500 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
    </svg>
  </button>
  <div class="hidden w-full md:block md:w-auto" id="navbar-default">
    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-slate-800 border-gray-700">
    <li>
      <a href="{{route('login')}}"
       class="block py-2 px-3 rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
       {{ $currentRoute == 'login' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
      Iniciar Sesión
      </a>
    </li>
    <li>
      <a href="{{route('register')}}"
       class="block py-2 px-3 rounded md:border-0 md:p-0 text-white hover:bg-green-500 hover:text-white md:hover:bg-transparent
       {{ $currentRoute == 'register' ? 'underline underline-offset-4 decoration-green-500 font-bold' : 'md:hover:text-blue-500' }}">
      Registrarse
      </a>
    </li>
    </ul>
  </div>
  </div>
</nav>
@endguest

@auth
<nav class="border-gray-200 bg-slate-800">
  <div class=" flex flex-wrap items-center justify-between mx-auto min-h-15 py-2 sm:px-10">
    <div class="flex items-center flex-shrink-0">
      <a href="{{route('home')}}" class="flex items-center space-x-1 rtl:space-x-reverse ms-2">
        <img src="{{ asset('imgs/AVAA_LOGO.png') }}" class="w-24" alt="avaa Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Stats</span>
      </a>
    </div>
    <div class="flex-grow"></div>
    <div class="w-auto flex items-center" id="navbar-default">
    <ul class="font-medium flex flex-row items-center p-0 mt-0 border-0 rounded-lg space-x-4 md:space-x-8 rtl:space-x-reverse bg-slate-800 mr-2 md:mr-0">
        @if(auth()->user()->role == 'admin')

            <li class="flex flex-col items-center">
               <a href="{{route('home')}}" title="Inicio"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative">
                    <span class="flex items-center justify-center">
                        <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 495.398 495.398" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"></path> <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"></path> </g> </g> </g> </g></svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'home' ? 'bg-green-600' : 'invisible' }}"></span>
                </a>
            </li>
            <li class="flex flex-col items-center relative group">
                <button type="button"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative focus:outline-none"
                    id="adminDropdownBtn"
                    title="Gestionar Actividades">
                    <span class="flex items-center justify-center">
                        <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" width="20px" height="20px" viewBox="0 0 16 16" id="table-3-16px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="Path_29" data-name="Path 29" d="M37.5,0h-11A2.5,2.5,0,0,0,24,2.5v11A2.5,2.5,0,0,0,26.5,16h11A2.5,2.5,0,0,0,40,13.5V2.5A2.5,2.5,0,0,0,37.5,0Zm-11,1h11A1.5,1.5,0,0,1,39,2.5V4H25V2.5A1.5,1.5,0,0,1,26.5,1ZM25,13.5V5h4V15H26.5A1.5,1.5,0,0,1,25,13.5ZM37.5,15H30V5h9v8.5A1.5,1.5,0,0,1,37.5,15ZM26,6.5a.5.5,0,0,1,.5-.5h1a.5.5,0,0,1,0,1h-1A.5.5,0,0,1,26,6.5Zm2,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,9.5Zm0,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,12.5Zm10-6a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,6.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,9.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,12.5Z" transform="translate(-24)"></path> </g></svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200
                        {{ in_array($currentRoute, ['stats.index', 'stats.upcoming', 'users.manage']) ? 'bg-green-600' : 'invisible' }}"></span>
                </button>
                <div class="hidden absolute right-0 mt-10 w-56 bg-white rounded-md shadow-lg z-50 transition-all duration-300 origin-top-right scale-95 opacity-0"
                    id="adminDropdownMenu">
                    <a href="{{ route('stats.index') }}" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-t-md">
                        <span class="mr-2">
                            <svg fill="#4b5563" width="18px" height="18px" viewBox="0 0 16 16" id="table-3-16px" xmlns="http://www.w3.org/2000/svg"><path id="Path_29" data-name="Path 29" d="M37.5,0h-11A2.5,2.5,0,0,0,24,2.5v11A2.5,2.5,0,0,0,26.5,16h11A2.5,2.5,0,0,0,40,13.5V2.5A2.5,2.5,0,0,0,37.5,0Zm-11,1h11A1.5,1.5,0,0,1,39,2.5V4H25V2.5A1.5,1.5,0,0,1,26.5,1ZM25,13.5V5h4V15H26.5A1.5,1.5,0,0,1,25,13.5ZM37.5,15H30V5h9v8.5A1.5,1.5,0,0,1,37.5,15ZM26,6.5a.5.5,0,0,1,.5-.5h1a.5.5,0,0,1,0,1h-1A.5.5,0,0,1,26,6.5Zm2,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,9.5Zm0,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,12.5Zm10-6a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,6.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,9.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,12.5Z" transform="translate(-24)"></path></svg>
                        </span>
                        Gestionar Actividades
                    </a>
                    <a href="{{ route('stats.index') }}" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                        <span class="mr-2">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 900.000000 900.000000" preserveAspectRatio="xMidYMid meet" class="scale-[1.8] translate-y-0.5">
                                <g transform="translate(0.000000,900.000000) scale(0.100000,-0.100000)" fill="#4b5563" stroke="none">
                                    <path d="M3055 7892 c-6 -5 -31 -16 -56 -26 -64 -23 -114 -76 -133 -140-21 -71-29-692-10-727 7-13 13-34 14-45 0-27 73-96 131-123 46-22 153-29 164-11 3 6 15 10 26 10 11 0 42 22 69 49 79 78 80 86 81 481 0 195-4 346-9 353-5 7-12 24-16 39-10 44-95 112-165 131-69 19-83 20-96 9z"/>
                                    <path d="M5599 7881 c-90 -31 -155 -92 -172 -161-3 -14-9 -170-12 -346-8 -398-4 -427 67 -496 27 -27 58-48 68-48 10 0 22-4 25-10 3-5 34-10 68-10 90 0 153 32 208 106 l44 57 3 369 c3 366 2 370-20 414-34 69-85 110-154 124-32 7-63 13-69 15-5 1-31-5-56-14z"/>
                                    <path d="M2301 7325 c-18 -8 -43 -15 -56 -15 -12 0 -28 -7 -35 -15-7-8-19-15-27-15-49 0-200-186-214-264-4-23-12-59-17-81-5-24-9-741-8-1767 1-1367 4-1730 14-1739 6-7 12-28 12-46 0-31 31-98 84-181 38-60 126-137 201-175 135-69 102-67 1093-67 618 0 893 3 897 11 4 5 0 18-8 27-10 11-16 47-19 103-3 59-10 95-21 113 l-17 26-810 0-809 0-75 24 c-121 40-175 83-228 183-20 37-20 59-23 1333-2 712-1 1323 2 1358 l6 62 2126-2 2126-3 5-427 5-428 37-20 c21-11 53-20 72-20 18 0 55-9 80-21 26-11 54-18 62-15 22 8 21 1660-1 1713-8 19-15 44-15 55 0 23-63 132-95 164-35 36-102 84-118 84-8 0-20 7-27 15-7 8-23 15-35 15-12 0-39 7-58 15-46 19-277 21-295 3-8-8-12-60-12-166 0-143-10-222-32-246-4-6-8-19-8-31 0-28-79-135-126-171-82-61-140-78-274-78-152 1-210 21-294 102-49 47-96 112-96 133 0 6-7 25-15 42-10 24-15 82-17 219-2 114-7 191-14 198-7 7-270 9-845 8 l-834-3-5-190 c-4-159-8-194-22-215-10-13-18-34-18-45 0-44-86-149-165-200-52-34-83-42-199-52-69-5-197 10-226 28-8 5-24 13-35 18-30 13-115 91-126 115-6 12-21 39-34 61-13 22-24 46-24 53-1 8-8 28-16 45-11 24-15 78-17 207 l-3 175-160 2 c-123 2-168-1-194-12z"/>
                                    <path d="M2993 5660 c-117 -5-123 -6-152 -34-57 -54-61-75-61-290 0-181 2-200 21-239 12-23 36-54 53-69 l31-27 238-1 c229 0 240 1 278 23 71 40 79 71 79 310 0 226-5 251-56 298-28 25-35 27-169 31-77 2-195 1-262-2z"/>
                                    <path d="M4048 5623 c-20 -21-41-48-47-60-7-14-11-95-11-226 l0-204 30-44 c21-33 43-51 80-67 46-20 66-22 248-22 182 0 200 1 243 22 73 34 82 58 87 230 3 81 1 189-3 241-6 89-8 95-41 130 l-35 37-258 0-257 0-36-37z"/>
                                    <path d="M5777 5159 c-54 -4-112 -15-129 -23-17-9-52-16-78-16-25 0-55-7-66-15-10-8-31-15-45-15-14 0-34-7-45-15-10-8-27-15-37-15-11 0-31-6-45-14-15-8-49-24-77-37-27-13-73-41-102-61-29-21-55-38-58-38-6 0-33-19-130-93-62-47-210-204-279-296-39-53-93-141-119-196-27-55-55-112-63-127-8-14-14-37-14-50 0-12-7-32-15-42-8-11-15-32-15-47 0-14-6-42-14-60-8-19-17-54-20-79-3-25-11-67-17-95-6-28-12-133-12-235-1-184 3-217 45-375 5-22 12-59 15-82 3-23 11-47 19-54 8-6 14-23 14-36 0-14 7-37 15-51 8-15 24-49 35-77 49-114 107-211 166-278 19-20 34-41 34-47 0-10 138-152 205-210 33-30 186-134 260-178 49-29 210-102 226-102 8-1 32-9 54-20 22-11 58-19 80-20 23 0 46-5 51-10 10-10 44-15 261-39 105-12 424 16 448 40 5 5 27 9 50 9 22 0 57 9 78 20 20 11 44 20 52 20 19 0 262 117 270 130 3 5 15 10 25 10 10 0 23 6 27 12 4 7 34 31 66 52 89 60 220 178 281 253 30 38 66 81 80 97 14 16 26 33 26 37 0 4 20 37 45 73 25 37 45 72 45 80 0 7 7 19 15 26 8 7 15 16 15 21 0 5 11 32 25 61 13 29 34 82 45 117 11 35 24 69 29 75 4 6 11 36 15 67 3 31 13 72 21 92 22 53 22 541 0 594-8 20-18 61-21 92-4 31-11 61-15 67-5 6-18 40-29 75-11 35-32 88-45 117-14 29-25 56-25 61 0 5-7 14-15 21-8 7-15 23-15 36 0 13-6 27-14 31-7 4-21 23-30 41-33 65-137 191-242 296-45 45-124 116-129 116-3 0-30 18-60 40-30 23-63 44-73 48-9 4-42 23-72 43-30 20-66 39-80 43-25 8-74 28-122 53-14 7-37 13-50 13-12 0-32 7-42 15-11 8-39 15-62 15-23 0-59 7-80 16-25 11-91 19-194 25-177 9-207 9-343-2z m397 -318 c17 -5 54 -14 81 -20 93 -18 150 -35 163 -48 7 -7 22 -13 32 -13 16 0 116 -48 175 -83 43 -26 173 -123 215 -161 44 -39 170 -187 170 -199 0 -3 13 -25 29 -49 16 -24 39 -63 51 -88 12 -25 30 -62 41 -83 10 -22 19 -46 19 -55 0 -10 6 -29 14 -44 8 -14 17 -46 21 -70 4 -24 14 -55 21 -70 8 -15 14 -51 14 -80 1 -29 5 -73 10 -98 12 -55 -7 -321 -25 -365-7 -16-16 -50-20 -75-3 -25-15 -64-26 -87-10 -24-19 -48-19 -54 0 -6-7 -23-15 -37-8-15-19 -38-25 -52-67 -164-318 -427-477 -499-11 -5-24 -14-27 -20-8 -12-128 -71-145 -71-7 0-25 -6-39 -14-34 -17-101 -35-172 -46-30 -4-68 -13-85 -19-65 -23-394 -3-490 31-16 6-43 13-60 16-16 2-39 11-50 18-11 8-26 14-35 14-15 0-93 39-185 92-26 16-51 28-56 28-5 0-9 4-9 9 0 5-22 23-49 40-65 39-220 198-279 284-58 85-54 78-92 162-71 157-86 200-96 270-3 28-10 55-15 61-19 23-31 243-19 356 6 61 14 116 17 121 3 6 12 35 19 66 26 119 115 319 181 407 86 115 217 252 254 266 10 4 19 12 19 17 0 5 30 29 68 52 91 59 105 67 122 75 16 6 60 25 113 48 36 16 98 33 172 48 28 5 64 13 80 18 42 11 372 12 409 1z"/>
                                    <path d="M5887 4594 c-36 -11-55 -25-77 -56 l-30 -41 0 -488 c0 -272 4 -498 9 -512 14 -37 63 -84 96 -93 46 -12 757 -16 769 -4 5 5 20 10 32 10 14 0 35 15 53 37 27 32 31 46 31 96 0 53-3 61-39 100 l-40 42-263 5 c-229 4-268 7-291 22 l-26 18-3 377-3 378-28 42 c-41 65-113 90-190 67z"/>
                                    <path d="M3005 4512 c-55 -1-104 -7-109 -12-6-6-17-10-26-10-19 0-47 -30-73 -77-15 -28-17 -58-16-242 2 -193 4-213 23-247 44 -77 50 -79 304 -82 276 -4 302 1 343 67 l29 45 0 221 0 221-27 42 c-17 26-38 45-53 48-14 3-33 10-44 15-19 11-182 16-351 11z"/>
                                </g>
                            </svg>
                        </span>
                        Actividades Próximas
                    </a>
                    <a href="" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-b-md">
                        <span class="mr-2">
                            <svg width="18px" height="18px" viewBox="-0.96 -0.96 25.92 25.92" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#4b5563"><path d="M1.5 6.5C1.5 3.46243 3.96243 1 7 1C10.0376 1 12.5 3.46243 12.5 6.5C12.5 9.53757 10.0376 12 7 12C3.96243 12 1.5 9.53757 1.5 6.5Z" fill="#4b5563"></path> <path d="M14.4999 6.5C14.4999 8.00034 14.0593 9.39779 13.3005 10.57C14.2774 11.4585 15.5754 12 16.9999 12C20.0375 12 22.4999 9.53757 22.4999 6.5C22.4999 3.46243 20.0375 1 16.9999 1C15.5754 1 14.2774 1.54153 13.3005 2.42996C14.0593 3.60221 14.4999 4.99966 14.4999 6.5Z" fill="#4b5563"></path> <path d="M0 18C0 15.7909 1.79086 14 4 14H10C12.2091 14 14 15.7909 14 18V22C14 22.5523 13.5523 23 13 23H1C0.447716 23 0 22.5523 0 22V18Z" fill="#4b5563"></path> <path d="M16 18V23H23C23.5522 23 24 22.5523 24 22V18C24 15.7909 22.2091 14 20 14H14.4722C15.4222 15.0615 16 16.4633 16 18Z" fill="#4b5563"></path></svg>
                        </span>
                        Ver Usuarios
                    </a>
                </div>
            </li>

            @else
            <li class="flex flex-col items-center">
                <a href="{{route('home')}}" title="Inicio"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative">
                    <span class="flex items-center justify-center">
                        <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 495.398 495.398" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"></path> <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"></path> </g> </g> </g> </g></svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'home' ? 'bg-green-600' : 'invisible' }}"></span>
                </a>
            </li>
            <li class="flex flex-col items-center">
                <a href="{{route('stats.index')}}" title="Gestionar Actividades"
                    class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative">
                    <span class="flex items-center justify-center">
                        <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" width="20px" height="20px" viewBox="0 0 16 16" id="table-3-16px" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="Path_29" data-name="Path 29" d="M37.5,0h-11A2.5,2.5,0,0,0,24,2.5v11A2.5,2.5,0,0,0,26.5,16h11A2.5,2.5,0,0,0,40,13.5V2.5A2.5,2.5,0,0,0,37.5,0Zm-11,1h11A1.5,1.5,0,0,1,39,2.5V4H25V2.5A1.5,1.5,0,0,1,26.5,1ZM25,13.5V5h4V15H26.5A1.5,1.5,0,0,1,25,13.5ZM37.5,15H30V5h9v8.5A1.5,1.5,0,0,1,37.5,15ZM26,6.5a.5.5,0,0,1,.5-.5h1a.5.5,0,0,1,0,1h-1A.5.5,0,0,1,26,6.5Zm2,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,9.5Zm0,3a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1,0-1h1A.5.5,0,0,1,28,12.5Zm10-6a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,6.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,9.5Zm0,3a.5.5,0,0,1-.5.5h-6a.5.5,0,0,1,0-1h6A.5.5,0,0,1,38,12.5Z" transform="translate(-24)"></path> </g></svg>
                    </span>
                    <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'stats.index' ? 'bg-green-600' : 'invisible' }}"></span>
                </a>
            </li>


        @endif
        <li class="flex flex-col items-center relative group">
            <button type="button"
                class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative focus:outline-none"
                id="notificacionesDropdownBtn"
                title="Notificaciones">
                <span class="flex items-center justify-center relative">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="19px" height="19px" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,0c-2.20703,0 -4,1.79297 -4,4c0,2.20703 1.79297,4 4,4c2.20703,0 4,-1.79297 4,-4c0,-2.20703 -1.79297,-4 -4,-4zM19.375,6.09375c-4.57031,1.95703 -7.375,6.36328 -7.375,11.90625c0,11 -3.80078,13.76172 -6.0625,15.40625c-1.00391,0.72656 -1.9375,1.40234 -1.9375,2.59375c0,4.20703 6.28125,6 21,6c14.71875,0 21,-1.79297 21,-6c0,-1.19141 -0.93359,-1.86719 -1.9375,-2.59375c-2.26172,-1.64453 -6.0625,-4.40625 -6.0625,-15.40625c0,-5.55859 -2.80078,-9.95312 -7.375,-11.90625c-0.85547,2.27344 -3.05859,3.90625 -5.625,3.90625c-2.56641,0 -4.76953,-1.63672 -5.625,-3.90625zM19,43.875c0,0.03906 0,0.08594 0,0.125c0,3.30859 2.69141,6 6,6c3.30859,0 6,-2.69141 6,-6c0,-0.03906 0,-0.08594 0,-0.125c-1.88281,0.07813 -3.88281,0.125 -6,0.125c-2.11719,0 -4.11719,-0.04687 -6,-0.125z"></path></g></g>
                    </svg>
                    @php
                        $notificacionesNoLeidas = auth()->user()->notifications()->where('leida', false)->count();
                    @endphp

                      <span id="notificacionesBadge" class="absolute -top-1 -right-2 bg-red-600 text-white text-xs rounded-full px-1.5 py-0.5" style="display: none;">
                        {{ $notificacionesNoLeidas }}
                    </span>

                </span>
                <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'notificaciones.index' ? 'bg-green-600' : 'invisible' }}"></span>
            </button>
            <div class="hidden absolute right-0 mt-10 w-72 sm:w-80 bg-white rounded-md shadow-lg z-50 transition-all duration-300 origin-top-right scale-95 opacity-0"
                id="notificacionesDropdownMenu">
                <div class="p-4 border-b font-bold text-gray-700">Notificaciones</div>
                <div class="max-h-64 sm:max-h-80 overflow-y-auto" id="notificacionesLista">
                   @forelse(auth()->user()->notifications()->latest()->take(10)->get() as $notificacion)
                        <a
                            href="{{ route('stats.index', ['highlight' => $notificacion->stat_id]) }}"
                            class="block px-4 py-3 border-b last:border-b-0 {{ $notificacion->leida ? 'bg-gray-100' : 'bg-yellow-100' }} hover:bg-gray-200 cursor-pointer transition-colors"
                        >
                            <div class="font-semibold text-sm text-gray-800">{{ $notificacion->titulo }}</div>
                            <div class="text-xs text-gray-600">{{ $notificacion->mensaje }}</div>
                            <div class="text-xs text-gray-400 text-right">{{ $notificacion->created_at->diffForHumans() }}</div>
                        </a>
                    @empty
                        <div class="px-4 py-3 text-gray-500 text-center">Sin notificaciones</div>
                    @endforelse
                </div>
                <div class="p-2 text-center">
                    <a href="" class="text-blue-600 text-xs hover:underline">Ver todas</a>
                </div>
            </div>
        </li>
        <!-- Dropdown Perfil -->
        <li class="relative flex flex-col items-center group">
            <button type="button" class="flex flex-col items-center rounded md:border-0 md:p-0 text-white hover:bg-slate-700 hover:text-white md:hover:bg-transparent group relative focus:outline-none" id="perfilDropdownBtn">
                <span class="flex items-center justify-center">
                    <svg fill="#ffffff" class="transition-colors duration-200 group-hover:fill-green-300" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 45.532 45.532" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765 S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53 c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012 c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592 c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z"></path> </g> </g></svg>
                </span>
                <span class="block w-full h-1 rounded-t mt-1 transition-all duration-200 {{ $currentRoute == 'configuser.index' || $currentRoute == 'datos.index'? 'bg-green-600' : 'invisible' }}"></span>
            </button>
            <div class="hidden absolute right-0 mt-10 w-56 bg-white rounded-md shadow-lg z-50 transition-all duration-300 origin-top-right scale-95 opacity-0" id="perfilDropdownMenu">
                <a href="{{ route('configuser.index') }}" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-t-md">
                    <span class="mr-3">
                        <svg width="22" height="22" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" fill="#222749" stroke="#222749" stroke-width="0.00024">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path d="M12 14v2a6 6 0 0 0-6 6H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm2.595 7.812a3.51 3.51 0 0 1 0-1.623l-.992-.573 1-1.732.992.573A3.496 3.496 0 0 1 17 14.645V13.5h2v1.145c.532.158 1.012.44 1.405.812l.992-.573 1 1.732-.992.573a3.51 3.51 0 0 1 0 1.622l.992.573-1 1.732-.992-.573a3.496 3.496 0 0 1-1.405.812V22.5h-2v-1.145a3.496 3.496 0 0 1-1.405-.812l-.992.573-1-1.732.992-.572zM18 19.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                            </g>
                        </svg>
                    </span>
                    Configuración de usuario
                </a>

                {{-- <a href="{{ route('datos.index') }}" class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100">
                    <span class="mr-2">
                        <svg width="22" height="22" class="text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    Datos personales
                </a> --}}

                <button type="button" onclick="openLogoutModal()" class="w-full flex items-center text-left px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-b-md">
                    <span class="mr-2">
                      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#262d5e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12L13 12" stroke="#201b4b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#201b4b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19" stroke="#201b4b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>
                    Cerrar Sesión
                </button>
            </div>
            </div>

            <!-- Modal de confirmación de cierre de sesión -->
            <div id="logoutModal" class="fixed inset-0 z-[999999] flex items-center justify-center bg-black bg-opacity-40 hidden opacity-0 transition-opacity duration-300">
                <div id="logoutModalContent" class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xs scale-95 opacity-0 transition-all duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 text-center">¿Cerrar sesión?</h3><hr><br>
                    <p class="mb-6 text-gray-600 text-center">¿Estás seguro que deseas cerrar sesión?</p>
                    <div class="flex justify-center space-x-2 mx-auto">
                        <button onclick="closeLogoutModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancelar</button>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded hover:bg-slate-900 rounded-b-md">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
            <style>
                #logoutModal.opacity-100 { opacity: 1 !important; }
                #logoutModalContent.scale-100 { transform: scale(1) !important; opacity: 1 !important; }
            </style>
        </li>
    </ul>
    </div>
  </div>
</nav>
@endauth

<div class="flex-grow p-0">
    @yield('contenido')
</div>



<footer class="py-4 mt-auto bg-slate-900 text-white">
  <div class="container mx-auto text-center">
    <p>&copy; 2023 AVAA. Todos los derechos reservados.</p>
  </div>
</footer>

@yield('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/locale/es.js"></script>
<script>
    dayjs.extend(window.dayjs_plugin_relativeTime);
    dayjs.locale('es');
    // Loader
    function mostrarLoader() {
        document.getElementById('loader-bg').style.display = 'flex';
    }
    function ocultarLoader() {
        document.getElementById('loader-bg').style.display = 'none';
    }
    window.addEventListener('load', ocultarLoader);

    // Dropdowns
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = [
            {btn: document.getElementById('perfilDropdownBtn'), menu: document.getElementById('perfilDropdownMenu')},
            {btn: document.getElementById('adminDropdownBtn'), menu: document.getElementById('adminDropdownMenu')},
            {btn: document.getElementById('notificacionesDropdownBtn'), menu: document.getElementById('notificacionesDropdownMenu')}
        ];
        function closeAll(exceptMenu) {
            dropdowns.forEach(({menu}) => {
                if (menu && menu !== exceptMenu && !menu.classList.contains('hidden')) {
                    menu.classList.remove('scale-100', 'opacity-100');
                    menu.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => menu.classList.add('hidden'), 200);
                }
            });
        }
        dropdowns.forEach(({btn, menu}) => {
            if (btn && menu) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (menu.classList.contains('hidden')) {
                        closeAll(menu);
                        menu.classList.remove('hidden');
                        setTimeout(() => {
                            menu.classList.remove('scale-95', 'opacity-0');
                            menu.classList.add('scale-100', 'opacity-100');
                        }, 10);
                        if (btn.id === 'notificacionesDropdownBtn') {
                            fetch("{{ route('notificaciones.marcarLeidas') }}", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Accept": "application/json"
                                }
                            }).then(() => {
                                document.querySelectorAll('#notificacionesDropdownBtn .absolute.bg-red-600').forEach(el => el.style.display = 'none');
                            });
                        }
                    } else {
                        menu.classList.remove('scale-100', 'opacity-100');
                        menu.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => menu.classList.add('hidden'), 200);
                    }
                });
            }
        });
        document.addEventListener('click', function (e) {
            dropdowns.forEach(({btn, menu}) => {
                if (btn && menu && !btn.contains(e.target) && !menu.classList.contains('hidden')) {
                    menu.classList.remove('scale-100', 'opacity-100');
                    menu.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => menu.classList.add('hidden'), 200);
                }
            });
        });
    });

    // Logout Modal
    window.openLogoutModal = function() {
        const modal = document.getElementById('logoutModal');
        const content = document.getElementById('logoutModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }
    window.closeLogoutModal = function() {
        const modal = document.getElementById('logoutModal');
        const content = document.getElementById('logoutModalContent');
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    // Notification system
    window.createNotification = function({ type = 'success', title = '', message = '' }) {
        const notificationsContainer = document.getElementById('notificationsContainer');
        const notification = document.createElement('div');
        let color = 'text-green-700', icon = `
            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 13l4 4L19 7" />
            </svg>`;
        if (type === 'error') {
            color = 'text-red-700';
            icon = `<svg fill="#d11f1f" class="w-6 h-6" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z"></path></svg>`;
        }
        notification.className = 'w-full max-w-sm md:max-w-md bg-white shadow-md rounded-md p-4 flex items-center space-x-4 border border-gray-300 opacity-0 translate-x-8 pointer-events-none transition-all duration-500 mb-2';
        notification.innerHTML = `
            ${icon}
            <div class="flex-1">
                <p class="${color} font-semibold text-sm">${title}</p>
                <p class="text-gray-600 text-xs">${message}</p>
            </div>
            <button class="closeBtn text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        notificationsContainer.insertBefore(notification, notificationsContainer.firstChild);
        setTimeout(() => {
            notification.classList.remove('opacity-0', 'translate-x-8', 'pointer-events-none');
            notification.classList.add('opacity-100', 'translate-x-0');
        }, 10);
        const closeBtn = notification.querySelector('.closeBtn');
        let hideTimeout = setTimeout(() => removeNotification(notification), 5000);
        closeBtn.addEventListener('click', function() {
            clearTimeout(hideTimeout);
            removeNotification(notification);
        });
        function removeNotification(notification) {
            notification.classList.remove('opacity-100', 'translate-x-0');
            notification.classList.add('opacity-0', 'translate-x-8', 'pointer-events-none');
            setTimeout(() => notification.remove(), 500);
        }
    };

    // Backend notifications
    @if(session('success'))
        window.addEventListener('DOMContentLoaded', function() {
            createNotification({
                type: 'success',
                title: '¡Éxito!',
                message: @json(session('success'))
            });
        });
    @endif
    @if(session('error'))
        window.addEventListener('DOMContentLoaded', function() {
            createNotification({
                type: 'error',
                title: 'Error',
                message: @json(session('error'))
            });
        });
    @endif

    // Notificaciones polling y render
  // ...existing code...

@if(auth()->check())
let lastNotificationId = null;

function renderNotificaciones(notificaciones) {
    const lista = document.getElementById('notificacionesLista');
    const badge = document.getElementById('notificacionesBadge');
    let noLeidas = 0;
    let html = '';
    let newNotifications = [];

    if (notificaciones.length === 0) {
        html = '<div class="px-4 py-3 text-gray-500 text-center">Sin notificaciones</div>';
    } else {
        notificaciones.forEach(n => {
            if (!n.leida) noLeidas++;
            html += `
                <a href="/tabla-actividades?highlight=${n.stat_id ?? ''}"
                   class="block px-4 py-3 border-b last:border-b-0 ${n.leida ? 'bg-gray-100' : 'bg-yellow-100'} hover:bg-gray-200 cursor-pointer transition-colors">
                    <div class="font-semibold text-sm text-gray-800">${n.titulo}</div>
                    <div class="text-xs text-gray-600">${n.mensaje}</div>
                    <div class="text-xs text-gray-400 text-right">${dayjs(n.created_at).fromNow()}</div>
                </a>
            `;
        });

        // Detectar nuevas notificaciones no leídas
        if (lastNotificationId !== null) {
            // Solo las no leídas y con id mayor a la última mostrada
            newNotifications = notificaciones.filter(n => !n.leida && n.id > lastNotificationId);
            newNotifications.forEach(n => {
                createNotification({
                    type: 'success',
                    title: n.titulo,
                    message: n.mensaje
                });
            });
        }
        // Actualizar el último id
        if (notificaciones.length > 0) {
            lastNotificationId = notificaciones[0].id;
        }
    }
    lista.innerHTML = html;
    if (badge) {
        badge.textContent = noLeidas > 0 ? noLeidas : '';
        badge.style.display = noLeidas > 0 ? '' : 'none';
    }
}

function fetchNotificaciones() {
    fetch('/notificaciones/json')
        .then(res => res.json())
        .then(renderNotificaciones);
}
setInterval(fetchNotificaciones, 20000);
fetchNotificaciones();
@endif
</script>

<div id="notificationsContainer" class="fixed top-8 right-4 z-[99999] flex flex-col items-end space-y-2 md:min-w-[900px]"></div>
</body>

</html>
