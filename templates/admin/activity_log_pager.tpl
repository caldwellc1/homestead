<!-- BEGIN empty_table -->
<p>{EMPTY_MESSAGE}</p>
<!-- END empty_table -->

<!-- BEGIN listrows -->
<div style="margin-bottom: 1em; border: solid 1px #ccc;">
    <div style="color: #333; font-size: 80%; background: #ccc; padding: .25em;">
        <strong>{ACTIVITY}</strong> - <strong>{ACTEE}</strong><br />
        <!-- BEGIN ACTOR -->By: {ACTOR} <!-- END ACTOR -->On: {DATE} at {TIME}
    </div>
    <div style="margin: .25em;">
        {NOTES}
    </div>
</div>
<!-- END listrows -->

<div class="container">
    <div id="activity-log-table"></div>
</div>

<div class="text-center">
    {TOTAL_ROWS}<br />
    {PAGE_LABEL} {PAGES}<br />
    {LIMIT_LABEL} {LIMITS}
</div>

<script type="text/javascript" src="{vendor_bundle}"></script>
<script type="text/javascript" src="{entry_bundle}"></script>
