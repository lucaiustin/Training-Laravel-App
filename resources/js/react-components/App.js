import React from 'react'
import ReactDOM from 'react-dom'
import {
    BrowserRouter as Router,
    Switch,
    Route,
    HashRouter,
    Link
} from 'react-router-dom'
import Index from './Index'
import Cart from './Cart'
import Login from './Login'
import Products from './Products'
import ProductForm from './ProductForm'
import Orders from './Orders'
import Order from './Order'

function App () {
    return (
        <HashRouter>
            <div>
                <Switch>
                    <Route exact path="/" component={Index}/>
                    <Route path="/cart" component={Cart}/>
                    <Route path="/login" component={Login}/>
                    <Route path="/products" component={Products}/>
                    <Route path="/product/:id" component={ProductForm}/>
                    <Route path="/product/" component={ProductForm}/>
                    <Route path="/order/:id" component={Order}/>
                    <Route path="/orders/" component={Orders}/>
                </Switch>
            </div>
        </HashRouter>
    )
}

ReactDOM.render(
    <HashRouter>
        <App/>
    </HashRouter>,
    document.getElementById('root')
)
