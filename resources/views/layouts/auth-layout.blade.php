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

    <body class="min-h-screen flex flex-col p-0 bg-gradient-to-br from-blue-500 to-blue-400 bg-no-repeat bg-fixed md:bg-cover md:bg-center sm:bg-blue-500" @yield('body-style') >
        <div id="loader-bg" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-[99999]">
            <div class="flex flex-col items-center">
                <svg class="animate-spin h-12 w-12 sm:h-10 sm:w-10 xs:h-8 xs:w-8 text-green-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                <span class="text-white text-lg sm:text-base font-semibold">Cargando...</span>
            </div>
        </div>

        <!-- CONTENIDO -->
        <div class="flex-grow p-0">
            @yield('contenido')
        </div>

        <!-- FOOTER -->
        <footer class="text-white font-bold py-4 mt-auto">
        </footer>

@yield('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
function mostrarLoader() {
    document.getElementById('loader-bg').style.display = 'flex';
}
function ocultarLoader() {
    document.getElementById('loader-bg').style.display = 'none';
}
window.addEventListener('load', function() {
    ocultarLoader();
});
</script>

         <script>
window.createNotification = function({ type = 'success', title = '', message = '' }) {
    const notificationsContainer = document.getElementById('notificationsContainer');
    const notification = document.createElement('div');
    let color = 'text-green-700', icon = `
        <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 13l4 4L19 7" />
        </svg>`;
    if (type === 'error') {
        color = 'text-red-700';
        icon = `<svg fill="#d11f1f" class="w-6 h-6" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" stroke="#d11f1f"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect id="Icons" x="-704" y="-64" width="1280" height="800" style="fill:none;"></rect> <g id="Icons1" serif:id="Icons"> <g id="Strike"> </g> <g id="H1"> </g> <g id="H2"> </g> <g id="H3"> </g> <g id="list-ul"> </g> <g id="hamburger-1"> </g> <g id="hamburger-2"> </g> <g id="list-ol"> </g> <g id="list-task"> </g> <g id="trash"> </g> <g id="vertical-menu"> </g> <g id="horizontal-menu"> </g> <g id="sidebar-2"> </g> <g id="Pen"> </g> <g id="Pen1" serif:id="Pen"> </g> <g id="clock"> </g> <g id="external-link"> </g> <g id="hr"> </g> <g id="info"> </g> <g id="warning"> </g> <path id="error-circle" d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734l-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z"></path> <g id="plus-circle"> </g> <g id="minus-circle"> </g> <g id="vue"> </g> <g id="cog"> </g> <g id="logo"> </g> <g id="radio-check"> </g> <g id="eye-slash"> </g> <g id="eye"> </g> <g id="toggle-off"> </g> <g id="shredder"> </g> <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g> <g id="react"> </g> <g id="check-selected"> </g> <g id="turn-off"> </g> <g id="code-block"> </g> <g id="user"> </g> <g id="coffee-bean"> </g> <g id="coffee-beans"> <g id="coffee-bean1" serif:id="coffee-bean"> </g> </g> <g id="coffee-bean-filled"> </g> <g id="coffee-beans-filled"> <g id="coffee-bean2" serif:id="coffee-bean"> </g> </g> <g id="clipboard"> </g> <g id="clipboard-paste"> </g> <g id="clipboard-copy"> </g> <g id="Layer1"> </g> </g> </g></svg>`;
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
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
};
</script>

{{-- Notificaciones desde el backend --}}
<script>
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
</script>
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
</body>
<div id="notificationsContainer" class="fixed top-8 right-4 z-[99999] flex flex-col items-end space-y-2"></div>

</html>
