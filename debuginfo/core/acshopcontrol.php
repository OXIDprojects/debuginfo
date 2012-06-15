<?php

class acShopControl extends acShopControl_parent {

    /**
     * Stops resource monitor, summarizes and outputs values
     *
     * @param bool  $blIsCache  Is content cache
     * @param bool  $blIsCached Is content cached
     * @param bool  $sViewID    View ID
     * @param array $aViewData  View data
     *
     * @return null
     */
    protected function _stopMonitor( $blIsCache = false, $blIsCached = false, $sViewID = null, $aViewData = array() )
    {
        if( !$this->_isDebugMode() || $this->isAdmin() ) {
            return;
        }

        // output timing
        $this->_dTimeEnd = microtime(true);

        $oDebugInfo = oxNew('oxDebugInfo');
        $aMemory    = $oDebugInfo->getMemoryData();

        $iMemoryM   = (int) ini_get('memory_limit');
        $iMemoryR   = round( $iMemoryM - $iMemoryM / 4 );
        $iMemoryY   = round( $iMemoryM - $iMemoryM / 2);

        $aProfilerCount  = $oDebugInfo->getProfilerData('count');

        $aProfilerTime  = $oDebugInfo->getProfilerData('time');

        echo "
        <div style='margin: 10px auto; width:940px;'>

            <hr>
            <div id='pie_chart'></div>
            <div id='bar_chart'></div>

            <hr>
            <div id='gauge_chart'></div>

            <script type='text/javascript' src='https://www.google.com/jsapi'></script>
            <script type='text/javascript'>
              google.load('visualization', '1', {packages:['gauge','corechart']});
              google.setOnLoadCallback(drawGaugeChart);
              google.setOnLoadCallback(drawPieChart);
              google.setOnLoadCallback(drawBarChart);

              function drawGaugeChart() {
                var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
        ";
        foreach ($aMemory as $sLabel => $sValue) {
            $sValue = round($sValue / 1024 / 1024);
            echo "['{$sLabel}', {$sValue}],";
        }
        echo "])
                var options = {
                  width: 940, height: 120, max: {$iMemoryM},
                  redFrom: {$iMemoryR}, redTo: {$iMemoryM},
                  yellowFrom:{$iMemoryY}, yellowTo: {$iMemoryR},
                  minorTicks: 5
                };

                var chart = new google.visualization.Gauge(document.getElementById('gauge_chart'));
                chart.draw(data, options);
              }

              function drawPieChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Function', 'time'],
                   ";
        foreach ($aProfilerTime as $sLabel => $aValue) {

            if ($sLabel == 'process') {
                continue;
            }

            $sValue = $aValue[time];
            $sCount = $aValue[count];
            echo "['{$sLabel} ({$sCount})', {$sValue}],";
        }
        echo "])

                var options = {
                   width: 940, height: 400,
                };

                var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                chart.draw(data, options);
              }

        function drawBarChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Function', 'time'],
                   ";
        foreach ($aProfilerCount as $sLabel => $aValue) {
            if ($sLabel == 'process') {
                continue;
            }
            $sValue = $aValue[count];
            echo "['{$sLabel}', {$sValue}],";
        }
        echo "])

                var options = {
                   width: 940, height: 800,
                };

                var chart = new google.visualization.BarChart(document.getElementById('bar_chart'));
                chart.draw(data, options);
              }
            </script>

        </div>
        ";
    }
}