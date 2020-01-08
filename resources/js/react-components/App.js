import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Index from './Index';

export default class App extends Component {
    render() {
        return (
            <div className="container">
                <Index/>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
