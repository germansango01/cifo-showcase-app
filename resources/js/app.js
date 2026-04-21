import Alpine from 'alpinejs';
import Precognition from 'laravel-precognition-alpine';

window.Alpine = Alpine;
Alpine.plugin(Precognition);

// Componente del formulario de login
Alpine.data('loginForm', () => ({
    form: null,

    init() {
        this.form = this.$form('post', '/login', {
            email: '',
            password: '',
            remember: false,
        });
    },

    submit() {
        this.form.submit({
            onSuccess: () => {
                // Fortify devuelve 200 JSON en peticiones XHR.
                // Redirigimos manualmente al home configurado.
                window.location.href = '/dashboard'; // Ajusta a tu ruta
            },
        }).catch((error) => {
            // 422 ya lo maneja Precognition automáticamente (form.errors).
            // Solo nos interesa loggear otros errores.
            if (error?.response?.status !== 422) {
                console.error('Error inesperado al iniciar sesión', error);
            }
        });
    },
}));

Alpine.start();