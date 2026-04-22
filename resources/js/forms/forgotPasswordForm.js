import { createFieldValidator } from './helpers';

export default () => ({
    form: null,
    validateField: null,
    status: null,

    init() {
        this.form = this.$form('post', '/forgot-password', {
            email: '',
        }).setValidationTimeout(1000);

        this.validateField = createFieldValidator(this);
    },

    submit() {
        this.form
            .submit()
            .then((response) => {
                this.status = response.data?.status ?? 'Te hemos enviado el enlace de recuperación.';
                this.form.reset();
            })
            .catch((error) => {
                if (error?.response?.status !== 422) {
                    console.error('Forgot password error:', error);
                }
            });
    },
});