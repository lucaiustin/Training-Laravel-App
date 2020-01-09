import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Product from './Product'
import Cart from './Cart'

export default class Products extends Component {
    state = {
        products: [],
    };

    componentDidMount() {
        axios
            .get('/products')
            .then(response => {
                this.setState({
                    products: response.data
                })
            })
    }

    addProduct = (event, id) => {
        event.preventDefault();
        axios
            .get('/' + id)
            .then(response => {
                this.setState({ products: response.data})
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
                console.log(error);
            })
    }

    handleDeleteLogout = (event, id) => {
        event.preventDefault()
        let self = this
        axios.post('/logout')
            .then(function (response) {
                console.log('Redirect')
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    render() {
        const { products } = this.state

        const result = products.map((product) => {
            return (
                <div key={product.id}>
                    <Product product={product}/>
                    <a  href={'/react/product/' + product.id}>Edit</a>
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
                <a href="react/product">Add</a>

                <form method="POST" onSubmit={this.handleDeleteLogout}>
                    <button type="submit">Logout</button>
                </form>
            </div>
        );
    }
}
