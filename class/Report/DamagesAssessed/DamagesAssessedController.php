<?php

namespace Homestead\Report\DamagesAssessed;

use \Homestead\ReportController;
use \Homestead\iSyncReport;
use \Homestead\iAsyncReport;
use \Homestead\iSchedReport;
use \Homestead\iCsvReportView;

/*
 *
 * @author Jeremy Booker
 * @license http://opensource.org/licenses/gpl-3.0.html
 */

class DamagesAssessedController extends ReportController implements iSyncReport, iAsyncReport, iSchedReport, iCsvReportView {

    public function setParams(Array $params)
    {
        $this->report->setTerm($params['term']);
    }

    public function getParams()
    {
        $params = array();

        $params['term'] = $this->report->getTerm();

        return $params;
    }
}
