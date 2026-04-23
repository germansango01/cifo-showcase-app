{{--
    Notificaciones: DaisyUI dropdown para la UI, Alpine solo para marcar leídas (JS necesario).
    En producción, conectar con un sistema de notificaciones real (Laravel Notifications).
    Por ahora, usa datos dummy para demostración.
--}}

<div class="dropdown dropdown-end" x-data="{
    notifications: [
        { id: 1, read: false, icon: 'icofont-ui-user', color: 'text-primary', message: 'Nuevo usuario registrado', time: 'Hace 5 min' },
        { id: 2, read: false, icon: 'icofont-shield', color: 'text-secondary', message: 'Rol Admin asignado a María G.', time: 'Hace 1 h' },
        { id: 3, read: true, icon: 'icofont-check-circled', color: 'text-success', message: 'Backup completado', time: 'Hace 3 h' },
    ],
    get unreadCount() { return this.notifications.filter(n => !n.read).length },
    markRead(id) { this.notifications = this.notifications.map(n => n.id === id ? { ...n, read: true } : n) },
    markAllRead() { this.notifications = this.notifications.map(n => ({ ...n, read: true })) }
}">
    {{-- Botón con badge de no leídas --}}
    <div tabindex="0" role="button" class="btn btn-ghost btn-sm btn-square relative" aria-label="Notificaciones">
        <i class="icofont-notification text-xl" aria-hidden="true"></i>
        <span x-show="unreadCount > 0" x-cloak x-text="unreadCount"
            class="badge badge-primary badge-xs absolute -top-0.5 -right-0.5 min-w-4 h-4 text-xs" aria-live="polite"
            :aria-label="`${unreadCount} notificaciones sin leer`"></span>
    </div>

    {{-- Panel desplegable --}}
    <div tabindex="0"
        class="dropdown-content mt-2 z-50 card card-compact shadow-xl bg-base-100 border border-base-300 w-80">
        {{-- Header del panel --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-base-300">
            <h2 class="font-semibold text-sm">Notificaciones</h2>
            <button type="button" class="text-xs text-primary hover:underline" @click="markAllRead()"
                x-show="unreadCount > 0" x-cloak>
                Marcar todas leídas
            </button>
        </div>

        {{-- Lista de notificaciones --}}
        <ul class="divide-y divide-base-200 max-h-72 overflow-y-auto">
            <template x-for="notif in notifications" :key="notif.id">
                <li @click="markRead(notif.id)"
                    class="flex items-start gap-3 px-4 py-3 cursor-pointer hover:bg-base-200 transition-colors"
                    :class="{ 'opacity-60': notif.read }" role="button" tabindex="0"
                    @keydown.enter="markRead(notif.id)">
                    {{-- Icono --}}
                    <span class="mt-0.5">
                        <i :class="notif.icon + ' text-lg ' + notif.color" aria-hidden="true"></i>
                    </span>
                    {{-- Contenido --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm leading-snug" :class="{ 'font-medium': !notif.read }" x-text="notif.message">
                        </p>
                        <p class="text-xs text-base-content/50 mt-0.5" x-text="notif.time"></p>
                    </div>
                    {{-- Indicador de no leída --}}
                    <span x-show="!notif.read" class="mt-1.5 w-2 h-2 bg-primary rounded-full flex-shrink-0"
                        aria-hidden="true"></span>
                </li>
            </template>

            {{-- Estado vacío --}}
            <li x-show="notifications.length === 0" x-cloak class="py-8 text-center text-base-content/50 text-sm">
                <i class="icofont-check-circled text-2xl block mb-2 text-success" aria-hidden="true"></i>
                Sin notificaciones pendientes
            </li>
        </ul>

        {{-- Footer --}}
        <div class="p-3 border-t border-base-300 text-center">
            <a href="#" class="text-xs text-primary hover:underline">
                Ver todas las notificaciones
            </a>
        </div>
    </div>
</div>
