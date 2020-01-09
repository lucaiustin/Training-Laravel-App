import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Product from './Product'
import Cart from './Cart'
import { withTranslation, Trans } from 'react-i18next'
import { Link, Redirect } from 'react-router-dom'

class Orders extends Component {
    state = {
        orders: [],
        isLoggedIn: true
    }

    componentDidMount () {
        let self = this
        axios
            .get('/orders')
            .then(response => {
                this.setState({
                    orders: response.data
                })
            })
            .catch(function (error) {
                if (error.response.status === 401) {
                    self.setState({ isLoggedIn: false })
                }
            })
    }

    render () {
        if (this.state.isLoggedIn == false) {
            return <Redirect to={{ pathname: '/login' }}/>
        }

        const { orders } = this.state
        const result = orders.map((order) => {
            return (
                <div key={order.id}>
                    <p> {order.created_at} </p>
                    <p> {order.contact_details} </p>
                    <p> {order.prices_sum} </p>
                    <Link to={'order/' + order.id}>{this.props.t('viewOrder')}</Link>
                    <hr/>
                </div>
            )
        })

        return (
            <div className="container">
                {result}
            </div>
        )
    }
}
export default withTranslation('common')(Orders)
