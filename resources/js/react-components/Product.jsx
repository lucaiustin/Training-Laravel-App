import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { withTranslation, Trans } from 'react-i18next'

export default class Product extends Component {
    state = {
        url: window.location.hostname
    };

    render() {
        return (
            <div className="product">
                <div className="product-image">
                    <img src={window.location.protocol + '//' + this.state.url + ':' + window.location.port + '/storage/images/' + this.props.product.image_name}/>
                </div>
                <div className="product-info">
                    <p> { this.props.product.id } </p>
                    <p> { this.props.product.title } </p>
                    <p> { this.props.product.description } </p>
                    <p> { this.props.product.price } </p>
                </div>
            </div>
        );
    }
}
