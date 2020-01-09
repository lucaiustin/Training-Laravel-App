import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Product from './Product'
import Cart from './Cart'
import { withTranslation, Trans } from 'react-i18next'
import { Link, Redirect } from 'react-router-dom'

class Order extends Component {
    state = {
        order: [],
        products: [],
        isLoggedIn: true
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
                    <Link to={'../orders/'}>{this.props.t('goToOrders')}</Link>
                </div>
            </div>
        )
    }
}
export default withTranslation('common')(Order)
