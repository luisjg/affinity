<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Sends the JSON response using the specified data array as well as the
     * desired HTTP response code.
     *
     * @param array $data An array of data to return
     * @param integer $code The HTTP response code to return
     * @param boolean $success Whether the request was successful
     *
     * @return array JSON Response
     */
    public function sendJsonResponse($data, $code=200, $success=true) {

        // return the response
        return response($data, $code);
    }

    protected function sendResponse($data, $type, array $metadata = NULL)
    {
        $response = [
            'status'   => app('Illuminate\Http\Response')->status(),
            'success'  => app('Illuminate\Http\Response')->status() < 400 ? true : false,
            'version'  => 'affinity-1.0',
            'type'     => $type,
        ];

        if(!is_null($metadata))
        {
            foreach($metadata as $key => $value)
            {
                $response[$key] = $value;
            }
        }

        $response[$type] = $data;

        if(count($data) == 0)
        {
            $response['messages']['data'] = 'No records found.';
        }

        if($response['success'] == false)
        {
            $response['messages']['server'] = 'A server error occurred.';
        }

        return $response;
    }
}
