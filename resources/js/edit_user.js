import {Notyf} from "notyf";
import RenderToCanvas from "./components/renderToCanvas";

window.RenderToCanvas = RenderToCanvas;

class EditUser {
    register() {
        this.addConfirmDeleteEventListeners();

        document.getElementById('certificate_window_enable').addEventListener('click', () => {
            window.AddCertificateModal = new bootstrap.Modal(document.getElementById('AddCertificateModal'));
            window.AddCertificateModal.show();
        });

        document.getElementById('addCertificateToUser').addEventListener('click', (event) => {
            if (false === this.validateAddCertificateData()) {
                return false;
            }
            this.renderCertificateFromSelector();
            this.addConfirmDeleteEventListeners();
            window.AddCertificateModal.hide();
        });
    }

    confirmDelete(event) {
        if (confirm('Are you sure that you want to remove the certificate that you currently have on user?')) {
            document.getElementById(event.currentTarget.dataset.id).remove();
        }
    }

    addConfirmDeleteEventListeners() {
        let certificateDeleteButtons = document.querySelectorAll('.delete_button');
        for (let deleteButton of certificateDeleteButtons) {
            deleteButton.removeEventListener('click', this.confirmDelete);
            deleteButton.addEventListener('click', this.confirmDelete);
        }
    }

    renderCertificate(target, id, selectedText, filepath, filetype, expiration_date) {
        let template = document.querySelector('#certificate_template').content.cloneNode(true);
        template.querySelector('#certificates').value = id;
        template.querySelector('#certificates').setAttribute('id', 'certificates-' + id);
        template.querySelector('#certificate_expiration_date').value = expiration_date;
        template.querySelector('#certificate_expiration_date').setAttribute('name', `certificate_expiration_date[${id}]`);
        template.querySelector('#certificate_expiration_date').setAttribute('id', `certificate_expiration_date-${id}`);

        template.querySelector('#certificate-').setAttribute('id', 'certificate-' + id);
        template.querySelector('.card-header').setAttribute('data-bs-content', selectedText);
        template.querySelector('.card-header').innerHTML = selectedText.substring(0, 20) + '...';
        template.querySelector('canvas').setAttribute('id', 'cert-' + id);
        template.querySelector('canvas').setAttribute('data-file', filepath);
        template.querySelector('canvas').setAttribute('data-type', filetype);
        template.querySelector('.card-footer .property').innerHTML += moment(expiration_date).format('MM/DD/YYYY');
        template.querySelector('.delete_button').setAttribute('data-id', 'certificate-' + id);
        target.parentNode.insertBefore(template, target);
    }

    renderCertificateFromSelector() {
        const selector = document.querySelector('#certificate_list');
        const selectedText = selector.selectedOptions[0].innerText;
        const file_path = selector.selectedOptions[0].dataset.file;
        const file_type = selector.selectedOptions[0].dataset.type;
        const expiration_date = document.querySelector('#expiration_date').value;
        const selected = parseInt(selector.value);

        if (document.querySelector('#certificate-' + selected)) {
            new Notyf().error('Current user already has this certificate');
        } else {
            let targetElement = document.getElementById('certificate_window_enable').parentNode;
            this.renderCertificate(targetElement, selected, selectedText, file_path, file_type, expiration_date);
            new RenderToCanvas(document.getElementById('cert-' + selected)).render();
        }
    }

    validateAddCertificateData() {
        let certificateSelect = document.getElementById('certificate_list');
        let expirationDateInput = document.getElementById('expiration_date');

        if (certificateSelect.value === '') {
            certificateSelect.classList.add('is-invalid');
            return false;
        }

        if (expirationDateInput.value === '') {
            expirationDateInput.classList.add('is-invalid');
            return false;
        }
        return true;
    }
}

window.EditUser = EditUser;







