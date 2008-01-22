<h2>{TABLE_TITLE}</h2>
<table width="%60">
    <tr>
        <th>{BEDROOM_LABEL}</th>
        <th>{BED_LETTER_LABEL}</th>
        <th>{ASSIGNED_TO_LABEL}</th>
        <th>{RA_LABEL}</th>
    </tr>
    <!-- BEGIN empty_table -->
    <tr>
        <td colspan="2">{EMPTY_MESSAGE}</td>
    </tr>
    <!-- END empty_table -->
    <!-- BEGIN listrows -->
    <tr {TOGGLE}>
        <td>{BEDROOM}</td>
        <td>{BED_LETTER}</td>
        <td>{ASSIGNED_TO}</td>
        <td>{RA}</td>
    </tr>
    <!-- END listrows -->
</table>
<br />
<!-- BEGIN page_label -->
<div align="center">
Assignments: {TOTAL_ROWS}
</div>
<!-- END page_label -->
<!-- BEGIN pages -->
<div align="center">
{PAGE_LABEL}: {PAGES}
</div>
<!-- END pages -->
<!-- BEGIN limits -->
<div align="center">
{LIMIT_LABEL}: {LIMITS}
</div>
<!-- END limits -->
