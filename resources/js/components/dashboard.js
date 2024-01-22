class Dashboard {
    constructor(props) {
        this.route_to_statistics = 'statistics/all';
        this.route_to_statistics_provided_sum = 'statistics/amounts';
        this.clients_selector = '.clients_counter';
        this.sites_selector = '.sites_counter';
        this.managers_selector = '.managers_counter';
        this.teams_selector = '.teams_counter';
    }

    init() {
        this.loadBasicStatistic();
        this.loadProvidedAmount();
    }

    updateCounter(type, number, object) {
        let countersNodes = this.getCounterNodes(type, object);
        if (countersNodes.length > 0) {
            countersNodes.forEach(counterObject => {
                const numberFlip = new NumberFlip({
                    rootElement: counterObject,
                });
                numberFlip.setNumberTo({
                    newNumber: number,
                });
            });
        }
    }

    loadBasicStatistic() {
        axios({
            url: this.route_to_statistics,
            method: "GET"
        }).then((response) => {
            if (response.data.length === 0) {
                console.warn('Nothing to show');
            } else {
                this.updateCounter('clients', response.data.clients.counter, this);
                this.updateCounter('sites', response.data.sites.counter, this);
                this.updateCounter('managers', response.data.managers.counter, this);
                this.updateCounter('teams', response.data.teams.counter, this);
            }
        }).catch((data) => {
            console.log(data);
            if (data.response.status === 403) {
                console.error(data.response.statusText + ': ' + data.response.data.message);
            }
        });
    }

    getCounterNodes(type, object) {
        let counter_selector = type + '_selector';
        let counter_selector_exist = object.hasOwnProperty(counter_selector);
        if (counter_selector_exist) {
            if (document.querySelectorAll(object[counter_selector])) {
                return document.querySelectorAll(object[counter_selector]);
            }
        } else {
            console.warn('Warning: Attempting to update a non-existent counter type [' + type + '_selector]');
        }
    }

    loadProvidedAmount() {
        axios({
            url: this.route_to_statistics_provided_sum,
            method: "GET"
        })
            .then(response => {
                document.querySelector('.total_provided_amount').innerHTML += response.data.total;
                new Chartist.Line('.provided_amount_chart', {
                    labels: response.data.labels,
                    series: [
                        response.data.sums
                    ]
                }, {
                    fullWidth: true,
                    chartPadding: {
                        right: 40
                    },
                    plugins: [
                        Chartist.plugins.tooltip()
                    ]
                });

            })
            .catch((data) => {
                console.log(data);
                if (data.response && data.response.status === 403) {
                    console.error(data.response.statusText + ': ' + data.response.data.message);
                }
            });
    }
}

export default Dashboard;
