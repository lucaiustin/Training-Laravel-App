import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import {
    BrowserRouter as Router,
    Route,
    Link,
    Redirect
} from 'react-router-dom'

export default class ProductForm extends Component {
    state = {
        title: '',
        description: '',
        price: '',
        image: null,
        titleError: '',
        descriptionError: '',
        priceError: '',
        imageError: '',
        redirectToProducts: false
    }

    componentDidMount () {
        let self = this;
        if (this.props.match.params.id) {
            axios
                .get('/product/' + self.props.match.params.id)
                .then(response => {
                    self.setState({
                        title: response.data.title,
                        description: response.data.description,
                        price: response.data.price
                    })
                })
        }
    }

    handleInputChange = (event) => {
        const target = event.target
        const value = target.value
        const name = target.name
        this.setState({
            [name]: value
        })
    }

    fileChangedHandler = (event) => {
        this.setState({ image: event.target.files[0] })
    }

    handleSubmit = (event) => {
        event.preventDefault()
        let self = this

        this.setState({ titleError: '' })
        this.setState({ descriptionError: '' })
        this.setState({ priceError: '' })
        this.setState({ imageError: '' })

        let formData = new FormData()
        formData.append('title', this.state.title)
        formData.append('description', this.state.description)
        formData.append('price', this.state.price)
        formData.append('image', this.state.image)

        let postUrl = '/product/'
        if (this.props.match.params.id) {
            formData.append('_method', 'PATCH')
            postUrl = '/product/' + this.props.match.params.id
        }

        axios.post(postUrl, formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                self.setState({ redirectToProducts: true })
            })
            .catch(function (error) {
                if (error.response.status === 422) {
                    if (error.response.data.errors.hasOwnProperty('title')) {
                        self.setState({ titleError: error.response.data.errors.title[0] })
                    }
                    if (error.response.data.errors.hasOwnProperty('description')) {
                        self.setState({ descriptionError: error.response.data.errors.description[0] })
                    }
                    if (error.response.data.errors.hasOwnProperty('price')) {
                        self.setState({ priceError: error.response.data.errors.price[0] })
                    }
                    if (error.response.data.errors.hasOwnProperty('image')) {
                        self.setState({ imageError: error.response.data.errors.image[0] })
                    }
                }
            })
    }

    render () {
        if (this.state.redirectToProducts) {
            return <Redirect to = {{ pathname: "/products" }} />;
        }

        return (
            <div className="container">
                <form method="POST" onSubmit={this.handleSubmit}>
                    <input type="text" name="title" placeholder="Title" value={this.state.title} onChange={this.handleInputChange} required/>
                    <span className="validation-title-error">{this.state.titleError}</span>
                    <br/>
                    <input type="text" name="description" placeholder="Description" value={this.state.description} onChange={this.handleInputChange} required/>
                    <span className="validation-description-error">{this.state.descriptionError}</span>
                    <br/>
                    <input type="text" name="price" placeholder="Price" value={this.state.price} onChange={this.handleInputChange} required/>
                    <span className="validation-price-error">{this.state.priceError}</span>
                    <br/>
                    <input type="file" name="image" onChange={this.fileChangedHandler} />
                    <span className="validation-image-error">{this.state.imageError}</span>
                    <br/>
                    <button type="submit">Save</button>
                </form>
                <br/>

                <Link to={'/products'}>Products</Link>
            </div>
        )
    }
}
