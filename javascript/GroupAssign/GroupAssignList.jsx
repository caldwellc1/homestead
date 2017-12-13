import React from 'react';
import ReactDOM from 'react-dom';
import {Button} from 'react-bootstrap';


class GroupAssignList extends React.Component{
    constructor(props, context) {
        super(props, context);

        this.saveAssignments = this.saveAssignments.bind(this)
    }
    saveAssignments(){

    }
    render() {
        return (
            <div>
                <Button onClick={this.saveAssignments}>Submit </Button>
            </div>
        );
    }
}
ReactDOM.render(<GroupAssignList/>, document.getElementById('group-assign-list'));
