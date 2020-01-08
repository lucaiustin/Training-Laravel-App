import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Product from './Product'

export default class Cart extends Component {
    state = {
        products: [],
        name: '',
        contactDetails: '',
        comments: '',
        nameError: '',
        contactDetailsError: '',
        commentsError: '',
        submitMessage: ''
    }

    componentDidMount () {
        axios
            .get('/cart')
            .then(response => {
                console.log(response.data)
                this.setState({
                    products: response.data
                })
            })
    }

    removeProduct = (event, id) => {
        event.preventDefault()
        axios
            .get('/cart/' + id)
            .then(response => {
                this.setState({ products: response.data })
            })
    }

    handleInputChange = (event) => {
        const target = event.target
        const value = target.value
        const name = target.name
        this.setState({
            [name]: value
        })
    }

    handleSubmit = (event) => {
        event.preventDefault()
        let self = this;
        let formData = new FormData()
        formData.append('name', this.state.name)
        formData.append('contact_details', this.state.contactDetails)
        formData.append('comments', this.state.comments)

        axios.post('/cart', formData)
            .then(function (response) {
                if (response.data.hasOwnProperty('msg')) {
                    console.log(response.data.msg)
                    self.setState({ submitMessage: response.data.msg })
                    // axios
                    //     .get('/removeAllFromCart')
                    //     .then(response => {
                    //         self.$router.push('/')
                    //     })
                }
            })
            .catch(function (error) {
                if (error.response.status === 422) {
                    if (error.response.data.errors.hasOwnProperty('name')) {
                        this.setState({ nameErrors: error.response.data.errors.name[0] })
                    }
                    if (error.response.data.errors.hasOwnProperty('contact_details')) {
                        this.setState({ contactDetailsError: error.response.data.errors.contact_details[0] })
                    }
                    if (error.response.data.errors.hasOwnProperty('comments')) {
                        this.setState({ commentsError: error.response.data.errors.comments[0] })
                    }
                }
            })
    }

    render () {
        const { products } = this.state

        const result = products.map((product) => {
            return (
                <div key={product.id}>
                    <Product product={product}/>
                    <a onClick={(e) => this.removeProduct(e, product.id)} href={'/cart/' + product.id}>Remove</a>
                    <hr/>
                </div>
            )
        })

        return (
            <div className="container">
                {result}
                <form onSubmit={this.handleSubmit}>
                    <input type="text" name="name" placeholder="Name" value={this.state.name}
                           onChange={this.handleInputChange} required/>
                    <span className="validation-name-error">{this.state.nameError}</span>
                    <br/>
                    <input type="text" name="contactDetails" placeholder="Contact Details"
                           value={this.state.contactDetails} onChange={this.handleInputChange} required/>
                    <span className="validation-contact-details-error">{this.state.contactDetailsError}</span>
                    <br/>
                    <textarea rows="10" cols="30" name="comments" placeholder="Comments" value={this.state.comments}
                              onChange={this.handleInputChange}/>
                    <span className="validation-comments-error">{this.state.commentsError}</span>
                    <br/>
                    <button type="submit">Checkout</button>
                </form>
                <div className="submit-message">{this.state.submitMessage}</div>
                <a href={'/react/'}>Got to Index</a>
            </div>
        )
    }
}

if (document.getElementById('cart')) {
    ReactDOM.render(<Cart/>, document.getElementById('cart'))
}
