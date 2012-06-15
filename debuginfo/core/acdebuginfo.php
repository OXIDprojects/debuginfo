<?php

class acDebugInfo extends acDebugInfo_parent {

    public function formatMemory( $iBytes )
    {
        return round ( $iBytes / 1024 / 1024 , 2);
    }

    /**
     * Get memory usage data
     *
     * @return array
     */
    public function getMemoryData()
    {
        $aMemory = array();
        if ( function_exists( 'memory_get_usage' ) &&  function_exists( 'memory_get_peak_usage' ) ) {

            $aMemory['Memory']   = memory_get_usage();
            $aMemory['Memory *'] = memory_get_peak_usage();

            $aMemory['System']   = memory_get_usage(true);
            $aMemory['System *'] = memory_get_peak_usage(true);
        }
        return $aMemory;
    }

    /**
     * Get profiler data
     *
     * @return array
     */
    public function getProfilerData($sStorting = 'time')
    {
        global $aProfileTimes;
        global $aExecutionCounts;
        global $aProfileBacktraces;

        if ($sStorting == 'time') {
            asort($aProfileTimes);
            $aKeys = array_keys($aProfileTimes);
        }

        if ($sStorting == 'count') {
            arsort($aExecutionCounts);
            $aKeys = array_keys($aExecutionCounts);
        }


        $aProfiler = array();
        if (is_array($aKeys)) {

            foreach ($aKeys as $sKey) {
                $aData = array();

                if (isset($aProfileTimes[$sKey])) {
                    $aData['time'] = $aProfileTimes[$sKey];
                }

                if (isset($aExecutionCounts[$sKey])) {
                    $aData['count'] = $aExecutionCounts[$sKey];
                }

                if (isset($aProfileBacktraces[$sKey])) {
                    $aData['trace'] = $aProfileBacktraces[$sKey];
                }

                $aProfiler[$sKey] = $aData;
            }
        }

        return $aProfiler;
    }
}