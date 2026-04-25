<div class="toast toast-end toast-bottom z-9999 fixed pointer-events-none"
    x-data="{ toasts: [] }"
    @toast.window="
        const t = $event.detail;
        toasts.push(t);
        setTimeout(() => toasts.splice(toasts.indexOf(t), 1), {{ $duration }});
    ">
    <template x-for="(t, i) in toasts" :key="i">
        <div class="alert alert-soft pointer-events-auto shadow-lg" :class="'alert-' + (t.type || 'info')">
            <i :class="t.icon || 'icofont-info-circle'" aria-hidden="true"></i>
            <span x-text="t.message"></span>
        </div>
    </template>
</div>
