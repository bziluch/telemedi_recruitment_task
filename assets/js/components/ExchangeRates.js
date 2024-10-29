import React, {Component} from "react";
import axios from "axios";

class ExchangeRates extends Component {

    constructor() {
        super();
        this.state = { currencies: {}, loading: true, date: null};
    }

    getBaseUrl() {
        return 'http://127.0.0.1:8000';
    }

    loadCurrencies() {
        axios.get(this.getBaseUrl() + `/api/exchange-rates`).then(response => {
            this.setState({ currencies: Object.keys(response.data).map((key) => response.data[key]), loading: false})
            console.log(this.state.currencies)
        }).catch(function (error) {
            console.error(error);
            this.setState({loading: false});
        });
    }

    componentDidMount() {
        this.loadCurrencies();
    }

    render() {
        const loading = this.state.loading;
        const currencies = this.state.currencies;
        return (
            <div>
                <h2>Kursy walut</h2>
                <table className={'table'}>
                    <thead>
                    <tr>
                    <th>Symbol</th>
                            <th>Nazwa</th>
                            <th>Kurs średni</th>
                            <th>Kurs kupna</th>
                            <th>Kurs sprzedaży</th>
                            <th>Kurs średni z dzisiaj</th>
                            <th>Kurs kupna z dzisiaj</th>
                            <th>Kurs sprzedaży z dzisiaj</th>
                        </tr>
                    </thead>
                    <tbody>
                        {loading ? (
                            <tr>
                                <td colSpan={8}>
                                    <div className={'text-center'}>
                                        <span className="fa fa-spin fa-spinner fa-4x"></span>
                                    </div>
                                </td>
                            </tr>
                        ) : (
                            currencies.map(function (currency, index, array) {
                                return <tr>
                                    <td>{currency.code}</td>
                                    <td>{currency.name}</td>
                                    <td>{currency.rates.selectedDate.rate}</td>
                                    <td>{currency.rates.selectedDate.sellRate}</td>
                                    <td>{currency.rates.selectedDate.buyRate}</td>
                                    <td>{currency.rates.now.rate}</td>
                                    <td>{currency.rates.now.sellRate}</td>
                                    <td>{currency.rates.now.buyRate}</td>
                                </tr>
                            })
                        )}
                    </tbody>
                </table>
            </div>
        )
    }

}

export default ExchangeRates;