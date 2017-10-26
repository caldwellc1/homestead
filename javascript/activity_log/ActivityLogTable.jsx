const ReactDataGrid = require('react-data-grid');
const { Toolbar, Filters: { NumericFilter, AutoCompleteFilter, MultiSelectFilter, SingleSelectFilter }, Data: { Selectors } } = require('react-data-grid-addons');
const exampleWrapper = require('../components/exampleWrapper');
const React = require('react');

class Example extends React.Component {
  constructor(props, context) {
    super(props, context);
    this._columns = [
      {
        key: 'user_id',
        name: 'Actee',
        width: 80
      },
      {
        key: 'activity',
        name: 'Activity',
        filterable: true,
        filterRenderer: MultiSelectFilter,
        sortable: true
      },
      {
        key: 'actor',
        name: 'Actor',
        filterable: true,
        sortable: true
      },
      {
        key: 'banner_id',
        name: 'Banner ID',
        filterable: true,
        filterRenderer: NumericFilter,
        sortable: true
      },
      {
        key: 'timestamp',
        name: 'Date',
        filterable: true,
        sortable: true
      },
      {
        key: 'notes',
        name: 'Notes',
        filterable: true,
        sortable: true
      }
    ];

    this.state = { rows: {}, filters: {}, sortColumn: null, sortDirection: null };
  }

  getDate = (start, end) => {

  };

  getRows = () => {
    return Selectors.getRows(this.state);
  };

  getSize = () => {
    return this.getRows().length;
  };

  rowGetter = (rowIdx) => {
    const rows = this.getRows();
    return rows[rowIdx];
  };

  handleGridSort = (sortColumn, sortDirection) => {
    this.setState({ sortColumn: sortColumn, sortDirection: sortDirection });
  };

  handleFilterChange = (filter) => {
    let newFilters = Object.assign({}, this.state.filters);
    if (filter.filterTerm) {
      newFilters[filter.column.key] = filter;
    } else {
      delete newFilters[filter.column.key];
    }

    this.setState({ filters: newFilters });
  };
  
  getValidFilterValues = (columnId) => {
      let values = this.state.rows.map(r => r[columnId]);
      return values.filter((item, i, a) => { return i === a.indexOf(item); });
    };

  onClearFilters = () => {
    this.setState({ filters: {} });
  };

  render() {
    return  (
      <ReactDataGrid
        onGridSort={this.handleGridSort}
        enableCellSelect={true}
        columns={this._columns}
        rowGetter={this.rowGetter}
        rowsCount={this.getSize()}
        minHeight={500}
        toolbar={<Toolbar enableFilter={true}/>}
        onAddFilter={this.handleFilterChange}
        onClearFilters={this.onClearFilters} />);
  }
}

module.exports = exampleWrapper({
  WrappedComponent: Example,
  exampleName: 'Filterable Sortable Columns Example',
  exampleDescription,
  examplePath: './scripts/example16-filterable-sortable-grid.js',
  examplePlaygroundLink: undefined
});
