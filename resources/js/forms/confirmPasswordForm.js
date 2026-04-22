import { createFieldValidator } from './helpers';

export default () => ({
    form: null,
    validateField: null,

    init() {
        this.form = this.$form('post', '/user/confirm-password', {
            password: '',
        }).setValidationTimeout(1000);

        this.validateField = createFieldValidator(this);
    },

    submit() {
        this.form
            .submit()
            .then(() => {
                window.location.reload();
            })
            .catch((error) => {
                if (error?.response?.status !== 422) {
                    console.error('Confirm password error:', error);
                }
            });
    },
});