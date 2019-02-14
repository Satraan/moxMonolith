import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import Dashboard from './Dashboard'

class App extends Component {
    constructor(props) {
        super(props);
    }
    render () {
        return (
            <Dashboard />
        )
    }
}

ReactDOM.render(<App />, document.getElementById('app'));
