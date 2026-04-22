import { createFieldValidator } from './helpers';

export default () => ({
    form: null,
    validateField: null,

    init() {
        this.form = this.$form('post', '/register', {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        }).setValidationTimeout(1000);

        this.validateField = createFieldValidator(this);
    },

    submit() {
        this.form
            .submit()
            .then(() => {
                window.location.href = '/dashboard';
            })
            .catch((error) => {
                if (error?.response?.status !== 422) {
                    console.error('Register error:', error);
                }
            });
    },
});