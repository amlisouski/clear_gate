/**
 *
 * @param { Element } element DOM element from document.querySelect()
 * @param { Element } template DOM element of <template> document.querySelect()
 * @param { String } url URL for load view with form.
 * @param { String } method set the method for sending form. Get dynamically from hidden element input[name=method] or form
 * params.
 * @param { Element } button
 * @param { CallableFunction } callback
 */
class laraForm {
    /**
     *
     * @param { Element } element DOM element from document.querySelect()
     * @param { Element | false } template DOM element of <template> document.querySelect().
     *                                     Use false to load form dynamically.
     * @param { String } url URL for load view with form.
     * @param { String } method set the method for sending form.
     *                      Get dynamically from hidden element input[name=method] or form params.
     * @param { CallableFunction } callback
     */
    constructor(
        element,
        template,
        url= '',
        method = '',
        callback = function callback() {}
    ) {
        if (typeof element !== 'object' || typeof template !== 'object') {
            throw new Error('element and template must be objects');
        }

        this.elementID = element;
        this.templateID = template;
        this.callback = callback;

        if (typeof arguments[arguments.length - 1] === 'function') {
            this.callback = arguments[arguments.length - 1];
        }

        if (this.includeTemplateToModal(element, template)) {
            this.formParams = this.getFormParams(element, method, url);
        }

        let submitModalFormHandler = this.submitModalForm.bind(this, this.formParams);

        this.formParams.button.addEventListener('click', submitModalFormHandler);
    }

    submitModalForm(formOptions, event) {

        event.preventDefault();

        let formData = new FormData(formOptions.form, formOptions.button);
        window.axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': formOptions.token
        };

        window.axios({
            method: formOptions.method,
            url: formOptions.url,
            data: formData,
            responseType: 'json',
        }).then((response) => {
                this.modalForm.hide();
                this.callback(response);
        }).catch((exception) => {
            formOptions.form.querySelectorAll('span.text-danger').forEach((el) =>{
                el.remove();
            });
            if (exception.response.data.error) {
                console.log('error:', exception.response.data.error);
            }
            if (exception.response.data.errors) {
                for (const fieldName in exception.response.data.errors) {
                    if (Object.prototype.hasOwnProperty.call(exception.response.data.errors, fieldName)) {
                        this.displayErrors(formOptions.form, fieldName, exception.response.data.errors[fieldName][0]);
                    }
                }
            }
        });
        return false;
    }

    displayErrors(form, fieldName, errorMessage) {
        let errorContainer = new DOMParser().parseFromString('<span class="text-danger">' + errorMessage + '</span>', 'text/html');
        form.querySelector('[name="' + fieldName + '"]').parentNode.appendChild(errorContainer.body.firstChild);
    }

    openModal(
        elementID = this.elementID
    ) {
        this.modalForm = new bootstrap.Modal(elementID);
        this.modalForm.show();
    }

    includeTemplateToModal(element, template) {
        if (!element) {
            console.error('element not found', element);
            return false;
        }

        if (!template) {
            console.error('Template not found', template);
            return false;
        }

        let modalBody = element.querySelector('.modal-body');
        modalBody.innerHTML = String();
        modalBody.appendChild(template.content.cloneNode(true));
        return true;
    }

    getFormParams(element, method, url, button) {
        let form = element.querySelector('form');

        if (typeof method === "function" || method.length === 0) {
            method = form.querySelector('input[name="method"]') ?
                form.querySelector('input[name="method"]').value
                : form.getAttribute('method');
        }

        if (typeof url === "function" || url.length === 0) {
            url = form.getAttribute('action');
        }

        return {
            form: form,
            url: url,
            method: method,
            button: form.querySelector('input[type="submit"]'),
            token: form.querySelector('input[name="_token"]').value
        };
    }
}

export default laraForm;
