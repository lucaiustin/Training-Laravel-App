import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

export default class Login extends Component {
    state = {
        username: [],
        password: '',
        usernameError: '',
        passwordError: ''
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
        let self = this
        let formData = new FormData()
        formData.append('username', this.state.username)
        formData.append('password', this.state.password)

        this.setState({ usernameError: '' })
        this.setState({ passwordError: '' })

        axios.post('/login', formData)
            .then(function (response) {
                console.log('Redirect!!!')
            })
            .catch(function (error) {

                if (error.response.data.errors.hasOwnProperty('username')) {
                    self.setState({ usernameError: error.response.data.errors.username[0] })
                }
                if (error.response.data.errors.hasOwnProperty('password')) {
                    self.setState({ passwordError: error.response.data.errors.password[0] })
                }
            })
    }

    render () {
        return (
            <div className="container">
                <form onSubmit={this.handleSubmit}>
                    <input type="text" name="username" placeholder="Username" value={this.state.username}
                           onChange={this.handleInputChange} required/>
                    <span className="validation-username-error">{this.state.usernameError}</span>
                    <br/>
                    <input type="password" name="password" placeholder="Password"
                           value={this.state.password} onChange={this.handleInputChange} required/>
                    <span className="validation-password-error">{this.state.passwordError}</span>
                    <br/>
                    <button type="submit">Login</button>
                </form>
            </div>
        )
    }
}
