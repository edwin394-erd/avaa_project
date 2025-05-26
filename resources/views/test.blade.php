@extends('layouts.layout')

@section('titulo')
AVAA - Test
@endsection

@section('titulo-tab')
AVAA - Test
@endsection

@section('contenido')
<!-- Contenedor de notificaciones -->
<div id="notificationsContainer" class="fixed bottom-6 right-1/2 translate-x-1/2 md:right-4 md:translate-x-0 flex flex-col-reverse space-y-2 space-y-reverse z-50 w-full max-w-md md:w-auto md:max-w-md md:items-end items-center px-2 md:px-0"></div>

<!-- Botón para mostrar la notificación -->
<button id="showNotificationBtn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition mb-4">
    Mostrar notificación
</button>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const showBtn = document.getElementById('showNotificationBtn');
    const notificationsContainer = document.getElementById('notificationsContainer');

    function createNotification() {
        // Crear elemento de notificación
        const notification = document.createElement('div');
        notification.className = 'w-full max-w-sm md:max-w-md bg-white shadow-md rounded-md p-4 flex items-center space-x-4 border border-gray-300 opacity-0 translate-x-8 pointer-events-none transition-all duration-500 mb-2';

        notification.innerHTML = `
            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 13l4 4L19 7" />
            </svg>
            <div class="flex-1">
              <p class="text-green-700 font-semibold text-sm">Guardado correctamente!</p>
              <p class="text-gray-600 text-xs">Los cambios se han guardado exitosamente.</p>
            </div>
            <button class="closeBtn text-gray-400 hover:text-gray-600 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
        `;

        // Agregar al contenedor (al principio para apilar de arriba a abajo)
        notificationsContainer.insertBefore(notification, notificationsContainer.firstChild);

        // Mostrar con animación (desde la derecha)
        setTimeout(() => {
            notification.classList.remove('opacity-0', 'translate-x-8', 'pointer-events-none');
            notification.classList.add('opacity-100', 'translate-x-0');
        }, 10);

        // Cerrar con botón
        const closeBtn = notification.querySelector('.closeBtn');
        let hideTimeout = setTimeout(() => removeNotification(notification), 10000);

        closeBtn.addEventListener('click', function() {
            clearTimeout(hideTimeout);
            removeNotification(notification);
        });
    }

    function removeNotification(notification) {
        notification.classList.remove('opacity-100', 'translate-x-0');
        notification.classList.add('opacity-0', 'translate-x-8', 'pointer-events-none');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }

    showBtn.addEventListener('click', createNotification);
});
</script>
@endsection
