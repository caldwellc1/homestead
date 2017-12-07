import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import PropTypes from 'prop-types';
import {Button} from 'react-bootstrap';

class GroupAssign extends React.Component{
    constructor(props, context) {
        super(props, context);

        this.state = {
            hallList: [],
            groups:[],
            assignmentOptions: [],
            currentAssignmentType: 0
        };

        this.updateAssignmentType = this.updateAssignmentType.bind(this);
        this.componentWillMount = this.componentWillMount.bind(this);
    }

    updateAssignmentType(value) {
        this.setState({
            currentAssignmentType: value
        });
    }

    componentWillMount() {
        var hallList = [];

        $.getJSON('index.php', {
            module: 'hms',
            action: 'JSONGetHalls'
        }, function (data) {
                hallList = data;

            $.getJSON('index.php', {
                module: 'hms',
                action: 'JSONGetOptions'
            }, function(data){
                this.setState({
                    hallList: hallList,
                    assignmentOptions: data.assignment_type,
                    currentAssignmentType: data.default_assignment
                });

            }.bind(this));
            $.getJSON('index.php', {
                module: 'hms',
                action: 'GetRlcList'
            }, function(data){
                this.setState({
                    groups: data
                });
            }.bind(this));
        }.bind(this));
    }

    render() {
        return (
            <div>
                <Options {...this.state} updateAssignmentType={this.updateAssignmentType} />
                <Halls hallList={this.state.hallList}  assignmentType={this.state.currentAssignmentType} groups={this.state.groups}/>
            </div>
        );
    }
}
class Options extends React.Component{
    constructor(props){
        super(props);

        this.state = {currentAssignmentType: 0};

        this.componentWillReceiveProps = this.componentWillReceiveProps.bind(this);
        this.updateAssignmentType = this.updateAssignmentType.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            currentAssignmentType: nextProps.currentAssignmentType
        });
    }

    updateAssignmentType(event) {
        this.props.updateAssignmentType(event.target.value);
        this.setState({
            currentAssignmentType: event.target.value
        });
    }

    render() {
        return (
            <div className="panel panel-primary">
                <div className="panel-heading">
                    <h3 className="panel-title">Assignment settings</h3>
                </div>
                <div className="row panel-body">
                    <div className="col-sm-6 form-group">
                        <label htmlFor="assignmentType">Assignment&nbsp;type:</label>
                        <DropSelect options={this.props.assignmentOptions}  selectId='assignmentType' default={this.state.currentAssignmentType} ref="assignmentType" onChange={this.updateAssignmentType} />
                    </div>
                </div>
            </div>
        );
    }
}
class DropSelect extends React.Component{
    render() {
        return (
            <select className="form-control" id={this.props.selectId} value={this.props.default} onChange={this.props.onChange}>
                {this.props.options.map(function(value, i){
                    return <option key={i} value={value.id}>{value.value}</option>;
                })}
            </select>
        );
    }
}

DropSelect.defaultProps = {
        options: [],
        selectId: null,
        default: null
};
class Halls extends React.Component{
    constructor(props){
        super(props);

        this.state =  {
            hallName: 'Choose a hall',
            floorName: '',
            selected: false,
            icon: 'fa-building-o',
            floors: [],
            floorDisabled: true,
            timestamp: Date.now()
        };
        this.loadFloors = this.loadFloors.bind(this);
        this.updateHall = this.updateHall.bind(this);
        this.onChildChanged = this.onChildChanged.bind(this);
    }
    onChildChanged(newFloor){
        this.setState({floorName: newFloor})
    }
    loadFloors(hallId) {
        //this.getInitialState();
        $.getJSON('index.php', {
            module: 'hms',
            action: 'JSONGetFloors',
            hallId: hallId
        }, function (data) {
            if (data) {
                this.setState({
                    floors: data,
                    floorDisabled: false
                });
            }
        }.bind(this));
    }
    updateHall(index) {
        this.setState({
            hallName: this.props.hallList[index].title,
            selected: true,
            timestamp: Date.now()
        });
        this.loadFloors(this.props.hallList[index].id);
    }
    render() {
        return (
            <div>
                <DropDown floorList={this.state.floorList} icon={this.state.icon} listing={this.props.hallList} onClick={this.updateHall} selected={this.state.selected} title={this.state.hallName}/>
                <Floors key={this.state.timestamp} floorDisabled={this.state.floorDisabled} floorList={this.state.floors} assignmentType={this.props.assignmentType} hall={this.state.hallName} callbackParent={(newState)=>this.onChildChanged(newState)}/>
                <Groups groupList={this.props.groups} hallSelected={this.state.hallName} floorSelected={this.state.floorName}/>
            </div>
        );
    }
}

class Floors extends React.Component{
    constructor(props){
        super(props);

        this.state = {
            selected: false,
            floorName: 'Choose a floor',
            icon: 'fa-list',
            displayStatus: 'empty',
            mounted: false
        };
        this.componentDidMount = this.componentDidMount.bind(this);
        this.componentWillUnMount = this.componentWillUnMount.bind(this);
        this.updateFloor = this.updateFloor.bind(this);
    }
    componentDidMount(){
        this.setState({mounted: true});
    }
    componentWillUnMount(){
        this.setState({mounted: false});
    }
    updateFloor(index) {
        this.setState({
            floorName: this.props.floorList[index].title,
            selected: true
        });
        this.setState({
            displayStatus: 'loading'
        });
        this.props.callbackParent(this.state.floorName)
    }
    render() {
        return (
            <div>
                <DropDown disabled={this.props.floorDisabled} icon={this.state.icon} listing={this.props.floorList} onClick={this.updateFloor} selected={this.state.selected} title={this.state.floorName}/>
            </div>
        );
    }
}

Floors.propTypes = {
    floorList: PropTypes.array,
    floorDisabled: PropTypes.bool
};
Floors.defaultProps ={
    floorList: []
}

class Groups extends React.Component{
    constructor(props){
        super(props);

        this.state =  {
            groupName: 'Choose a group',
            selected: false,
            icon: 'fa-user-circle-o',
            timestamp: Date.now(),
        };
        this.updateGroup = this.updateGroup.bind(this);
        this.submit = this.submit.bind(this);
    }
    updateGroup(index) {
        this.setState({
            groupName: this.props.groupList[index].title,
            selected: true,
            timestamp: Date.now()
        });
    }
    submit(){
        $.ajax({
            url: 'index.php?module=hms&action=AssignmentGroup',
            method: 'POST',
            dataType: 'text',
            data: {groupName: this.state.groupName,
            hallName: this.props.hallList,
            floorName: this.props.floorList,
            reason: this.props.assignmentType},
            success: function() {
                //load next page
            },
            error: function(xhr, status, err) {
                alert("Failed to Submit.")
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    }
    render() {
        var disabled = this.state.selected && this.props.hallSelected !== 'Choose a hall' ? false : true;
        var buttonClassName = this.state.selected && this.props.hallSelected !== 'Choose a hall' ? 'btn-success' : 'btn-default';
        return (
            <div>
                <DropDown icon={this.state.icon} listing={this.props.groupList} onClick={this.updateGroup} selected={this.state.selected} title={this.state.groupName} disabled={false}/>
            <br/><Button onClick={this.submit} disabled={disabled} className={buttonClassName}>Submit</Button>
            </div>
        );
    }
}
class DropDown extends React.Component{
    render() {
        var buttonClass = this.props.selected ? 'btn-success' : 'btn-default';
        var buttonDisabled = this.props.disabled ? 'disabled' : '';
        return (
            <div className="btn-group">
                <div className="btn-group" role="group">
                    <button aria-expanded="false" className={buttonClass + ' btn btn-lg dropdown-toggle'} data-toggle="dropdown" disabled={buttonDisabled} type="button">
                        <i className={'fa ' + this.props.icon}></i>{' '}
                        {this.props.title}
                        {' '}
                        <span className="caret"></span>
                    </button>
                    <ul className="dropdown-menu" role="menu">
                        {this.props.listing.map(function (listItem, i) {
                    return (
                            <DropDownChoice key={i} onClick={this.props.onClick.bind(null, i)} title={listItem.title}/>
                    );
                }, this)}
                    </ul>
                </div>
            </div>
        );
    }
}

DropDown.propTypes = {
    listing: PropTypes.array,
    selected: PropTypes.bool,
    title: PropTypes.string,
    icon: PropTypes.string,
    disabled: PropTypes.bool
}
DropDown.defaultProps = {
    listing: [],
    selected: false,
    title: 'Click here to choose',
    icon: 'fa-check',
    disabled: false
}

class DropDownChoice extends React.Component{
    render() {
        return (
            <li onClick={this.props.onClick}>
                <a style={{cursor: 'pointer', fontSize: '1.3em'}}>{this.props.title}</a>
            </li>
        );
    }
}
ReactDOM.render(<GroupAssign/>, document.getElementById('group-assign'));
