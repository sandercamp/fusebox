import React from 'react';
import ReactDOM from 'react-dom';

class P1Message extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            header: '',
            values: []
        };

        this.getMessage();
    }

    componentDidMount() {
        this.interval = setInterval(
            () => this.getMessage(),
            5000
        );
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }

    render() {
        return (
            <table className='P1Message'>
                <thead>
                    <tr>
                        <th>{this.state.header}</th>
                    </tr>
                </thead>
                
                <tbody>
                    {this.state.values.map((item, index) => (
                        <P1Row key={index} description={item.description} value={item.value} />
                    ))}
                </tbody>
            </table>
        );
    }

    getMessage() {
        fetch('/message')
        .then(response => response.json())
        .then(result => {
            this.setState({
                header: result.header,
                values: JSON.parse(result.values)
            })
        });
    }
}

class P1Row extends React.Component {
    render() {
        return (
            <tr className='P1Row'>
                <td>{this.props.description}</td>
                <td>{this.props.value}</td>
            </tr>
        );
    }
}

ReactDOM.render(<P1Message/>, document.getElementById('message'));
