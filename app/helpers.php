<?php

/**
 * Generate basic API response array
 *
 * @param string $collection - e.g. classes, membership-classes, etc.
 * @param boolean $success - default true
 * @param int $status_code - default 200
 * @return array
 * @internal param string $data_type - e.g. classes, membership-classes, etc.
 */
function buildResponseArray($collection, $success = true, $status_code = 200)
{
    return $response = [
        'success'    => ($success ? "true" : "false"),
        'status'     => strval($status_code),
        'api'        => 'affinity',
        'version'    => '1.0',
        'collection' => $collection
    ];
}
