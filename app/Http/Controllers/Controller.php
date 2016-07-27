<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	protected function sendResponse($data, $type, array $metadata = NULL)
	{
		$response = [
			'status'   => app('Illuminate\Http\Response')->status(),
			'success'  => app('Illuminate\Http\Response')->status() < 400 ? true : false,
			'version'  => 'attributes-1.0',
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
