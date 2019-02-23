import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Files extends Component {
    constructor(){
        super();
        this.state = {
            data: []
        }
    }

    componentWillMount(){
        let $this = this;

        axios.get('/api/files').then(response => {
            $this.setState({
                data: response.data
            })
        })
    }

    deleteFile(file){
        console.log(file);
        axios.delete('api/files/'+ file.id).then(response => {

        }).catch(error => {
            console.log(error);
        })
        const newState = this.state.data.slice();
        newState.splice(newState.indexOf(file), 1);
        this.setState({
            data: newState
        })
    }

    render() {
        return (
            <div>
                <div className="form-group">

                    <input type="text" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Input url for download and save file" />

                </div>
                <table className="table">
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
                {
                    this.state.data.map((file, i) => (
                    <tr key={i} >
                        <td>{file.id}</td>
                        <td>{file.mime_type}</td>
                        <td>{file.url}</td>
                        <td><a href={'/download/' + file.id}>{file.path}</a></td>
                        <td><a href="javascript:;" className="btn btn-danger" onClick={this.deleteFile.bind(this, file)}>delete</a></td>
                    </tr>
                    )
                    )
                }
                </tbody>
            </table>
            </div>
        );
    }
}

if (document.getElementById('files')) {
    ReactDOM.render(<Files />, document.getElementById('files'));
}
