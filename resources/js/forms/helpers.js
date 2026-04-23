/**
 * Factory que crea un helper validateField con guard de campo vacío.
 * Evita disparar validación precognitiva en campos que el usuario no ha tocado.
 */
export function createFieldValidator(context) {
    return function validateField(field) {
        const value = context.form[field];

        if (value === '' || value === null || value === undefined) {
            return;
        }

        context.form.validate(field);
    };
}