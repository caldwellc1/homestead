import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import ReactDataGrid from 'react-data-grid';
const {Filters: { NumericFilter, MultiSelectFilter }, Data: { Selectors } } = require('react-data-grid-addons');

class EmptyRowsView extends React.Component {
  render() {
    return (<div>Nothing to show</div>);
  }
}

class LogTable extends React.Component {
  constructor(props, context) {
    super(props, context);
    this._columns = [
      {key: 'user_id', name: 'Actee', width: 100, sortable: true, filterable: true},
      {key: 'timestamp', name: 'Date', width: 100, filterable: true},
      {key: 'description', name: 'Activity', resizable: true, filterable: true, filterRenderer: MultiSelectFilter},
      {key: 'actor', name: 'Actor', width: 100, filterable: true},
      {key: 'notes', name: 'Notes', resizable: true, filterable: true},
      {key: 'banner_id', name: 'Banner ID', width: 100, filterable: true, filterRenderer: NumericFilter}
    ]
    this.state = { originalRows: [], rows: [], filters: {}, sortColumn: null, sortDirection: null }
    this.getRowsData()
    //this.getRowsData = this.getRowsData.bind(this)
    //this.getRows = this.getRows.bind(this)
    this.rowGetter = this.rowGetter.bind(this)
    //this.getSize = this.getSize.bind(this)
    //this.handleGridSort = this.handleGridSort.bind(this)
    this.handleFilterChange = this.handleFilterChange.bind(this)
    this.getValidFilterValues = this.getValidFilterValues.bind(this)
    //this.onClearFilters = this.onClearFilters.bind(this)
  }
  getRowsData() {
      // Sends an ajax request to get the activity data
      $.ajax({
          url: 'index.php?module=hms&action=AjaxActivityLog',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
              this.setState({originalRows: data})
              this.setState({rows: this.state.originalRows.slice(0)})
          }.bind(this),
          error: function(xhr, status, err) {
              alert("Failed to grab displayed data.")
              console.error(this.props.url, status, err.toString())
          }.bind(this)
      });
  }

  getRows(){
    return Selectors.getRows(this.state.originalRows)
  }

  rowGetter(i){
      return this.state.rows[i]
  }

  getSize(){
    return this.state.rows.length
  }

  handleGridSort(sortColumn, sortDirection){
      console.log(sortColumn, sortDirection)
    const comparer = (a, b) => {
      if (sortDirection === 'ASC') {
        return (a[sortColumn] > b[sortColumn]) ? 1 : -1
      } else if (sortDirection === 'DESC') {
        return (a[sortColumn] < b[sortColumn]) ? 1 : -1
      }
    };

    const rows = sortDirection === 'NONE' ? this.state.originalRows.slice(0) : this.state.rows.sort(comparer)

    this.setState({rows: rows})
  }

  handleFilterChange(filter){
    let newFilters = Object.assign({}, this.state.filters)
    if (filter.filterTerm) {
      newFilters[filter.column.key] = filter
    } else {
      delete newFilters[filter.column.key]
    }

    this.setState({ filters: newFilters })
  }

  getValidFilterValues(columnId){
      let values = this.state.rows.map(r => r[columnId])
      return values.filter((item, i, a) => { return i === a.indexOf(item); })
  }

  onClearFilters(){
    this.setState({ filters: {} })
  }

  componentDidMount(){
      this.openGrid.onToggleFilter()
  }
  render() {
    return  (
      <ReactDataGrid
        ref={(datagrid)=>{this.openGrid=datagrid}}
        onGridSort={this.handleGridSort}
        enableCellSelect={true}
        columns={this._columns}
        rowGetter={this.rowGetter}
        rowsCount={this.getSize()}
        minHeight={700}
        onAddFilter={this.handleFilterChange}
        getValidFilterValues={this.getValidFilterValues}
        onClearFilters={this.onClearFilters}
        emptyRowsView={EmptyRowsView}
        />
    )
  }
}

ReactDOM.render(<LogTable />, document.getElementById('activity-log-table'));
