import { createFieldValidator } from './helpers';

export default (confirmUrl) => ({
    form: null,
    validateField: null,

    init() {
        this.form = this.$form('post', confirmUrl, {
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