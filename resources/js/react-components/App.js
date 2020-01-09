import React from 'react'
import ReactDOM from 'react-dom'
import {
    BrowserRouter as Router,
    Switch,
    Route,
    HashRouter,
    Link
} from 'react-router-dom'

import {I18nextProvider} from 'react-i18next';
import i18next from 'i18next';

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

i18next.init({
    interpolation: { escapeValue: false },  // React already does escaping
    lng: 'en',                              // language to use
    resources: {
        en: {
            common: {
                'add': 'Add',
                'goToCart': 'Go to cart',
                'remove': 'Remove',
                'goToIndex': 'Go to Index',
                'name': 'Name',
                'contactDetails': 'Contact Details',
                'comments': 'Comments',
                'checkout': 'Checkout',
                'edit': 'Edit',
                'deleteProduct': 'Delete Product',
                'logout': 'Logout',
                'title': 'Title',
                'description': 'Description',
                'price': 'Price',
                'save': 'Save',
                'products': 'Products',
                'username': 'Username',
                'password': 'Password',
                'login': 'Login',
                'viewOrder': 'View Order',
                'goToOrders': 'Go to Orders'
            }
        },
    },
});

ReactDOM.render(
    <I18nextProvider i18n={i18next}>
        <HashRouter>
            <App/>
        </HashRouter>,
    </I18nextProvider>,
    document.getElementById('root')
)
