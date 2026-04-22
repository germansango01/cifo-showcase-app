import { createFieldValidator } from './helpers';

export default (loginUrl, redirectUrl) => ({
    form: null,
    validateField: null,

    init() {
        this.form = this.$form('post', loginUrl, {
            email: '',
            password: '',
            remember: false,
        }).setValidationTimeout(1000);

        this.validateField = createFieldValidator(this);
    },

    submit() {
        this.form
            .submit()
            .then(() => {
                window.location.href = redirectUrl;
            })
            .catch((error) => {
                if (error?.response?.status !== 422) {
                    console.error('Login error:', error);
                }
            });
    },
});