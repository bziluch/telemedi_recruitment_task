import React, {Component} from "react";
import axios from "axios";
import {getBaseUrl} from "../tools/UrlFunctions";
import {getCurrentDate} from "../tools/DateFunctions";

class ExchangeRates extends Component {

    constructor() {
        super();
        this.state = { currencies: {}, loading: true, date: getCurrentDate()};
    }

    loadCurrencies() {
        const url = getBaseUrl() + `/api/exchange-rates` + (this.state.date ? `?date=` + this.state.date : '')
        axios.get(url).then(response => {
            this.setState({ currencies: Object.keys(response.data).map((key) => response.data[key]), loading: false})
        }).catch(function (error) {
            console.error(error);
            this.setState({loading: false});
        });
    }

    updateDate(val) {
        this.setState({ date: val, loading: true})
        this.loadCurrencies()
    }

    componentDidMount() {

        this.loadCurrencies();
    }

    render() {
        const loading = this.state.loading;
        const currencies = this.state.currencies;
        const date = this.state.date;

        const handleDateChange = (e) => {
            this.updateDate(e.target.value)
        }

        return (
            <div>
                <h2>Kursy walut</h2>
                <input type={'date'} min={'2023-01-01'} value={date} onChange={handleDateChange}/>
                <table className={'table'}>
                    <thead>
                    <tr>
                        <th>Symbol</th>
                        <th>Nazwa</th>
                        <th>Kurs średni z {date}</th>
                        <th>Kurs kupna z {date}</th>
                        <th>Kurs sprzedaży z {date}</th>
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
