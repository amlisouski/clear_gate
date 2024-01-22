class Helper {
    static formatMoney(input) {
        let value = input.value;
        value = value.replace(/[^0-9.]/g, '');
        value = parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        input.value = value;
    }
}

export default Helper;

