import laraForm from './components/lara-form';

window.laraForm = laraForm;

import DisplayClientContactSelector from './components/displayClientContactSelector';

window.DisplayClientContactSelector = DisplayClientContactSelector;

import DisplayManagerInfo from './components/displayMangerSelector';

window.DisplayManagerInfo = DisplayManagerInfo;

import DisplayTeamSelector from "./components/displayTeamSelector";

window.DisplayTeamSelector = DisplayTeamSelector;

class CellSite {
    constructor(options) {
        for (const [key, value] of Object.entries(options)) {
            this[key] = value;
        }
    }

    register() {

        this.bidApproveHandler();
        this.riggingPlanHandler();
        this.noticeProceedHandler();

        $('#ac_add_event').on('click', this.addAcItemForm);
        $('#bid_approved').on('change', this.bidApproveHandler);
        $('#rigging_plan').on('select2:select change', this.riggingPlanHandler);
        $('#notice_to_proceed').on('select2:select change', this.noticeProceedHandler);
        $('#clients_create_event').on('click', function (event) {
            let addClientForm = new laraForm(
                document.querySelector('#modalWindow'),
                document.querySelector('#addNewClient'),
                function (response) {
                    if (response.status === 200) {
                        let newOption = new Option(response.data.name, response.data.id, false, true);
                        $('#client').append(newOption).trigger('change');
                    }
                });
            addClientForm.openModal();
            event.preventDefault();
            return false;
        });

        const clientSelector = this.client.selector;
        this.renderClientContactSelector(clientSelector.val());
        clientSelector.on('select2:select', (event) => {
            let data = event.params.data;
            this.renderClientContactSelector(data.id);
        });

        const managerSelector = this.manager.selector;
        this.renderManagerInfo(managerSelector.val());
        managerSelector.on('select2:select', (event) => {
            let data = event.params.data;
            this.renderManagerInfo(data.id);
        });

        const teamSelector = this.team.selector;
        this.renderTeamInfo(teamSelector.val());
        teamSelector.on('select2:select', (event) => {
            let data = event.params.data;
            this.renderTeamInfo(data.id);
        });
    }


    renderClientContactSelector(id) {
        new DisplayClientContactSelector(
            this.client.displayTo,
            id,
            this.client.route
        );
    }

    renderManagerInfo(id) {
        new DisplayManagerInfo(
            this.manager.displayTo,
            id,
            this.manager.route
        );
    }

    renderTeamInfo(id) {
        new DisplayTeamSelector(
            this.team.displayTo,
            id,
            this.team.route
        );
    }


    bidApproveHandler(event) {
        const label = document.querySelector('label[for="bid_approved"]');
        if ($('#bid_approved').prop('checked')) {
            label.textContent = 'Yes, approved';
            document.getElementById('tech_spec').classList.remove('d-none');
        } else {
            label.textContent = 'No, not approved';
            document.getElementById('tech_spec').classList.add('d-none');
            $('#rigging_plan').val(0).trigger('change');
        }
    }

    riggingPlanHandler() {
        if ($('#rigging_plan').val() > 0) {
            document.getElementById('ntp_section').classList.remove('d-none');
        } else {
            $('#notice_to_proceed').val('none').trigger('change');
            document.getElementById('ntp_section').classList.add('d-none');
        }
    }

    noticeProceedHandler() {
        if ($('#notice_to_proceed').val() !== 'none') {
            document.getElementById('rest_of_form').classList.remove('d-none');
        } else {
            document.getElementById('rest_of_form').classList.add('d-none');
        }
    }

    addAcItemForm() {
        CellSite.addAcItem();
    }

    static addAcItem(item = null) {
        let index = item ? item.id : (document.querySelectorAll('.AcItem').length + 1);
        let tpl = document.getElementById('addAcItem').innerHTML.replaceAll('ID', index);
        let template = document.createElement("div");
        template.innerHTML = tpl;
        if (item) {
            template.querySelector('#ac_amount_' + item.id).value = item.amount;
            template.querySelector('#ac_desc_' + item.id).innerText = item.description;
        }
        template.querySelectorAll('.delete_button').forEach(item => {
            item.addEventListener('click', function (event) {
                let AcItem_Id = event.currentTarget.dataset.id;
                document.getElementById(AcItem_Id).remove();
            });
        });
        document.getElementById('additional_price_container').append(template);
    }
}

window.CellSite = CellSite;

