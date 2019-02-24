import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Files extends Component {
    constructor(){
        super();
        this.state = {
            data: [],
            showMessageErrorAddFile: false,
            showSuccessAddMessageFile: false,
            showSuccessMessageDelete: false,

        }
    }


    showSuccessAddFile ()
    {
        let $this = this;
        $this.setState(() => {
            return { showSuccessAddMessageFile : true}
        })
    };

    showErrorAddFile ()
    {
        let $this = this;
        $this.setState(() => {
            return { showMessageErrorAddFile : true}
        })
    };

    showSuccessDeleteFile ()
    {
        let $this = this;
        $this.setState(() => {
            return {  showSuccessMessageDelete : true}
        })
    };

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
        this.showSuccessDeleteFile();

        }).catch(error => {
            console.log(error);
            this.showErrorAddFile()
        });
        const newState = this.state.data.slice();
        newState.splice(newState.indexOf(file), 1);
        this.setState({
            data: newState
        });

        setTimeout(() => {
            this.setState({
                showSuccessMessageDelete:false
            });
        }, 5000);

    }

    pasteData(e) {
       let url_text = e.clipboardData.getData('Text');
       console.log(url_text);
        const params = {
            url: url_text,
        };
       axios.post('api/files', params).then(response => {
           this.showSuccessAddFile();
           axios.get('/api/files')
               .then(res => {

                   const files = res.data;
                   this.setState({data : files });
                   console.log(this.state.files);
               })
        }).catch(error => {
            this.showErrorAddFile();
        });

        setTimeout(() => {
            this.setState({
                showMessageErrorAddFile:false
            });
        }, 5000);

        setTimeout(() => {
            this.setState({
                showSuccessAddMessageFile:false
            });
        }, 5000)


    }

    render() {
        return (
            <div>
                {this.state.showSuccessMessageDelete && <div className="alert alert-success delete message" role="alert">Deleted succesfully!</div>}
                {this.state.showSuccessAddMessageFile && <div className="alert alert-success" role="alert">File added succesfully!</div>}
                {this.state.showMessageErrorAddFile && <div className="alert alert-danger" role="alert">Somethig went wrong!</div>}
                <div className="form-group">
                <input type="text" name="url" className="form-control" id="exampleInputEmail1" onPaste={this.pasteData.bind(this)} aria-describedby="emailHelp" placeholder="Input url for download and save file" />
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
