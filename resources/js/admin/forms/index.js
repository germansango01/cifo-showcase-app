import loginForm from './loginForm';
import registerForm from './registerForm';
import forgotPasswordForm from './forgotPasswordForm';
import confirmPasswordForm from './confirmPasswordForm';

export default function registerForms(Alpine) {
    Alpine.data('loginForm', loginForm);
    Alpine.data('registerForm', registerForm);
    Alpine.data('forgotPasswordForm', forgotPasswordForm);
    Alpine.data('confirmPasswordForm', confirmPasswordForm);
}