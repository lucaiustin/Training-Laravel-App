import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Product from './Product'
import Cart from './Cart'
import { Redirect, Link } from 'react-router-dom'

export default class Products extends Component {
    state = {
        products: [],
        isLoggedIn: true
    }

    componentDidMount () {
        let self = this
        axios
            .get('/products')
            .then(response => {
                this.setState({
                    products: response.data
                })
            }).catch(function (error) {
            if (error.response.status === 401) {
                self.setState({ isLoggedIn: false })
            }
        })
    }

    addProduct = (event, id) => {
        event.preventDefault()
        axios
            .get('/' + id)
            .then(response => {
                this.setState({ products: response.data })
            })
    }

    handleDeleteProduct = (event, id) => {
        event.preventDefault()
        let self = this
        let formData = new FormData()
        formData.append('_method', 'DELETE')
        axios.delete('/products/' + id, formData)
            .then(function (response) {
                self.setState({ products: response.data })
            })
            .catch(function (error) {
                console.log(error)
            })
    }

    handleDeleteLogout = (event, id) => {
        event.preventDefault()
        let self = this
        axios.post('/logout')
            .then(function (response) {
                self.setState({ isLoggedIn: false })
            })
            .catch(function (error) {
                console.log(error)
            })
    }

    render () {
        if (this.state.isLoggedIn == false) {
            return <Redirect to={{ pathname: '/login' }}/>
        }

        const { products } = this.state

        const result = products.map((product) => {
            return (
                <div key={product.id}>
                    <Product product={product}/>
                    <Link to={'/product/' + product.id}>Edit</Link>
                    <form method="POST" onSubmit={(e) => this.handleDeleteProduct(e, product.id)}>
                        <button type="submit">Delete Product</button>
                    </form>
                    <hr/>
                </div>
            )
        })

        return (
            <div className="container">
                {result}

                <Link to={'/product'}>Add</Link>

                <form method="POST" onSubmit={this.handleDeleteLogout}>
                    <button type="submit">Logout</button>
                </form>
            </div>
        )
    }
}
