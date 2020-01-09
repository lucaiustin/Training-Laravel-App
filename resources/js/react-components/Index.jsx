import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Product from './Product'
import { Link } from 'react-router-dom'

export default class Index extends Component {
    state = {
        products: [],
    };

    componentDidMount() {
        axios
            .get('/')
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

    render() {
        const { products } = this.state

        const result = products.map((product) => {
            return (
                <div key={product.id}>
                    <Product product={product}/>
                    <a  onClick={(e) => this.addProduct(e, product.id)} href={'/' + product.id}>Add</a>
                    <hr/>
                </div>
            )
        })

        return (
            <div className="container">
                {result}

                <Link to={'/cart'}>Go to cart</Link>
            </div>
        );
    }
}
