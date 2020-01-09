import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Product from './Product'
import Cart from './Cart'

export default class Order extends Component {
    state = {
        order: [],
        products: []
    }

    componentDidMount () {
        let self = this
        axios
            .get('/order/' + this.props.match.params.id)
            .then(response => {
                self.setState({
                    order: response.data.order,
                    products: response.data.products
                })
                var totalPrice = 0
                for (var product in self.state.products) {
                    totalPrice += parseFloat(self.state.products[product].price)
                }
                var orderCopy = self.state.order;
                orderCopy['totalPrice'] = totalPrice;
                self.setState({
                    order: orderCopy,
                })
                console.log(orderCopy)
            })
    }

    render () {
        const { order } = this.state
        const { products } = this.state

        const result = products.map((product) => {
            return (
                <div key={product.id}>
                    <Product product={product}/>
                </div>
            )
        })

        return (
            <div className="container">
                <div>
                    {order.name}
                    <br/>
                    {order.contact_details}
                    <br/>
                    {order.comments}
                    <br/>
                    {order.totalPrice}
                    <br/>
                    {order.created_at}
                    <br/><br/>
                    {result}
                    <a href="react/product">Add</a>
                </div>
            </div>
        )
    }
                }
