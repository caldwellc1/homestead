<?php

namespace Homestead;

PHPWS_Core::initModClass('hms', 'WaitingListApplication.php');

class OpenWaitingListView extends View {

    public function show()
    {
        Layout::addPageTitle("Open Waiting List");

        return WaitingListApplication::waitingListPager();
    }
}
