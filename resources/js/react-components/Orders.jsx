import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Product from './Product'
import Cart from './Cart'

export default class Orders extends Component {
    state = {
        orders: [],
    }

    componentDidMount () {
        axios
            .get('/orders')
            .then(response => {
                this.setState({
                    orders: response.data
                })
            })
    }

    render () {
        const { orders } = this.state
        const result = orders.map((order) => {
            return (
                <div key={order.id}>
                    <p> {order.created_at} </p>
                    <p> {order.contact_details} </p>
                    <p> {order.prices_sum} </p>
                    <a href={'order/' + order.id}>View Order</a>
                    <hr/>
                </div>
            )
        })

        return (
            <div className="container">
                {result}
                <a href="react/product">Add</a>
            </div>
        )
    }
}

if (document.getElementById('orders')) {
    ReactDOM.render(<Orders/>, document.getElementById('orders'))
}

