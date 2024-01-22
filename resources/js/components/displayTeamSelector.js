import DisplayClientContactSelector from "./displayClientContactSelector";

class DisplayTeamSelector extends DisplayClientContactSelector {

    static template() {
        return `
        <div class="block-info radio_button_label mb-2 mx-2">
            <div class="h4 title"></div>
            <h6 class="h6 property foreman"><strong>Foreman:</strong>&nbsp;</h6>
        </div>
    `;
    }

    static renderItem(item, selector, container) {
        let template = document.createElement('div');
        template.innerHTML = DisplayTeamSelector.template();
        template.querySelector('.title').innerHTML = `${item.name}`;
        template.querySelector('.foreman').innerHTML += `${item.foreman.first_name} ${item.foreman.last_name}`;
        return template;
    }
}

export default DisplayTeamSelector;
