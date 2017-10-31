import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import ReactDataGrid from 'react-data-grid';

class LogTable extends React.Component {
  constructor(props, context) {
    super(props, context);
    this._columns = [
      {key: 'user_id', name: 'Actee', width: 100, sortable: true},
      {key: 'timestamp', name: 'Date', width: 100},
      {key: 'description', name: 'Activity', resizable: true},
      {key: 'actor', name: 'Actor', width: 100},
      {key: 'notes', name: 'Notes', resizable: true},
      {key: 'banner_id', name: 'Banner ID', width: 100}
    ];
    this.state = { originalRows: [], rows: [], filters: {}, sortColumn: null, sortDirection: null };
    this.getRows()
    this.rowGetter = this.rowGetter.bind(this)
  }
  getRows() {
      // Sends an ajax request to get the activity data
      $.ajax({
          url: 'index.php?module=hms&action=AjaxActivityLog',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
              this.setState({originalRows: data});
              this.setState({rows: this.state.originalRows.slice(0)})
          }.bind(this),
          error: function(xhr, status, err) {
              alert("Failed to grab displayed data.")
              console.error(this.props.url, status, err.toString());
          }.bind(this)
      });
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
        return (a[sortColumn] > b[sortColumn]) ? 1 : -1;
      } else if (sortDirection === 'DESC') {
        return (a[sortColumn] < b[sortColumn]) ? 1 : -1;
      }
    };

    const rows = sortDirection === 'NONE' ? this.state.originalRows.slice(0) : this.state.rows.sort(comparer);

    this.setState({rows: rows});
  };

  handleFilterChange(filter){
    let newFilters = Object.assign({}, this.state.filters);
    if (filter.filterTerm) {
      newFilters[filter.column.key] = filter;
    } else {
      delete newFilters[filter.column.key];
    }

    this.setState({ filters: newFilters });
  }

  getValidFilterValues(columnId){
      let values = this.state.rows.map(r => r[columnId]);
      return values.filter((item, i, a) => { return i === a.indexOf(item); });
  }

  onClearFilters(){
    this.setState({ filters: {} });
  }

  render() {
    return  (
      <ReactDataGrid
        onGridSort={this.handleGridSort}
        enableCellSelect={true}
        columns={this._columns}
        rowGetter={this.rowGetter}
        rowsCount={this.getSize()}
        minHeight={700}
        //toolbar={<Toolbar enableFilter={true}/>}
        //onAddFilter={this.handleFilterChange}
        //onClearFilters={this.onClearFilters}
        />
    );
  }
}

ReactDOM.render(<LogTable />, document.getElementById('activity-log-table'));
