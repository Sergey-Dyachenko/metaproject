import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Files extends Component {
    render() {
        return (
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">mime_type</th>
                    <th scope="col">url</th>
                    <th scope="col">path</th>
                    <th scope ="col">action</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td>1</td>
                    <td>type/js</td>
                    <td>http://google.com</td>
                    <td>/storage/</td>
                    <td><a href="#" className="btn btn-danger">delete</a></td>
                </tr>

                </tbody>
            </table>
        );
    }
}

if (document.getElementById('files')) {
    ReactDOM.render(<Files />, document.getElementById('files'));
}
