import DisplayClientContactSelector from "./displayClientContactSelector";

class DisplayManagerInfo extends DisplayClientContactSelector {

    static template() {
        return `
        <div class="block-info radio_button_label mb-2 mx-2">
            <div class="h4 title"></div>
            <div class="label">
                <span class="email property"><strong><i class="bi bi-envelope-fill"></i>&nbsp;Email:</strong>&nbsp;</span>
                <span class="phone property"><strong><i class="bi bi-phone-fill"></i>&nbsp;Phone:</strong>&nbsp;</span>
                <span class="fax property"><strong><i class="bi bi-phone-fill"></i>&nbsp;Fax:</strong>&nbsp;</span>
            </div>
        </div>
    `;
    }

    static renderItem(item, selector, container) {
        let teams;
        let template = document.createElement('div');
        template.innerHTML = DisplayManagerInfo.template();
        template.querySelector('.title').innerHTML = `${item.first_name} ${item.last_name}`;
        template.querySelector('.email').innerHTML += `${item.email}`;
        template.querySelector('.phone').innerHTML += `${item.phone}`;
        template.querySelector('.fax').innerHTML += `${(item.fax != null ? item.fax : 'none')}`;
        return template;
    }
}

export default DisplayManagerInfo;
