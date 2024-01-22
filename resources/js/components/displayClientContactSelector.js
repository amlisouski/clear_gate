/**
 * @param { Element} container Set Element for append data
 * @param { Number } user Set the ID of client
 * @param { String } route_url URL path to controller with compiled data for user
 * @param { String } method Method for request GET, POST, PUT, PATCH, DELETE. Default: POST
 * @param { Object } withParams Set additional params to URL request { with:'teams'} => ?with=teams
 */
class DisplayClientContactSelector {

    static template() {
        return `
        <div class="form-check radio_button client_contact_radio_button mb-2">
            <div class="form-check-input-container">
                <input class="form-check-input" type="radio" name="" id="" value="">
            </div>
            <div class="radio_button_label">
                <label class="form-check-label" for="">
                    <span class="h4 title"></span><br/>
                    <span class="email property"><strong><i class="bi bi-envelope-fill"></i>&nbsp;Email:</strong>&nbsp;</span>
                    <span class="phone property"><strong><i class="bi bi-phone-fill"></i>&nbsp;Phone:</strong>&nbsp;</span>
                    <span class="fax property"><strong><i class="bi bi-phone-fill"></i>&nbsp;Fax:</strong>&nbsp;</span>
                </label>
            </div>
        </div>
    `;
    }

    /**
     * @param { Element} container Set Element for append data
     * @param { Number } user Set the ID of client
     * @param { String } route_url URL path to controller with compiled data for user
     * @param { Object } withParams Set additional params to URL request { with:'teams'} => ?with=teams
     * @param { String } method Method for request GET, POST, PUT, PATCH, DELETE. Default: POST
     */
    constructor(container, user, route_url, withParams = {}, method = 'get') {

        route_url = route_url.replace('REPLACED', user.toString());
        if (Number.isInteger(Number(user))) {
            this.getData(route_url, user, method, container, withParams);
        } else {
            container.innerHTML = '';
        }
        return false;
    }

    getData(route_url, user, method, container, withParams) {
        let urlString = '';
        if (Object.keys(withParams).length > 0) {
            const searchParams = new URLSearchParams(withParams);
            urlString = '?' + searchParams.toString();
        }
        axios({
            url: route_url + urlString,
            method: method
        }).then((response) => {
            if (response.data.length === 0) {
                container.innerHTML += '<p class="alert alert-warning">Not loaded</p>';
            } else {
                let elements;
                let selector = `checkbox_${container.dataset.select}`;
                if (Array.isArray(response.data)) {
                    elements = response.data.reduce((acc, data) => {
                        acc.push(window[this.constructor.name].renderItem(data, selector, container));
                        return acc;
                    }, []);
                } else {
                    elements = [window[this.constructor.name].renderItem(response.data, selector, container)];
                }
                container.innerHTML = '';
                if (elements.length > 0) {
                    elements.forEach(element => {
                        container.appendChild(element);
                    });
                    if (container.querySelector('input:first-child')) {
                        container.querySelector('input:first-child').setAttribute('checked', true);
                        if (elements.length > 1 &&
                            Number.isInteger(Number(container.dataset.id)) &&
                            Number(container.dataset.id) > 0
                        ) {
                            container.querySelector(`#${selector}_${Number(container.dataset.id)}}`)
                                .setAttribute('checked', true);
                        }
                    }
                }
            }
        }).catch((data) => {
            console.log(data);
        });
    }

    static renderItem(item, selector, container = null) {
        let buttonTemplate = document.createElement('div');
        buttonTemplate.innerHTML = DisplayClientContactSelector.template();
        buttonTemplate.querySelector('.title').innerHTML = `${item.first_name} ${item.last_name}`;
        buttonTemplate.querySelector('.email').innerHTML += `${item.email}`;
        buttonTemplate.querySelector('.phone').innerHTML += `${item.phone}`;
        buttonTemplate.querySelector('.fax').innerHTML += `${(item.fax != null ? item.fax : 'none')}`;
        buttonTemplate.querySelector('.client_contact_radio_button').classList.add(item.status);
        buttonTemplate.querySelector('.form-check-input').id = `${selector}_${item.id}`;
        buttonTemplate.querySelector('.form-check-input').name = `client_contact_id`;
        buttonTemplate.querySelector('.form-check-input').value = item.id;
        buttonTemplate.querySelector('.form-check-label').setAttribute('for', `${selector}_${item.id}`);
        return buttonTemplate;
    }
}

export default DisplayClientContactSelector;
