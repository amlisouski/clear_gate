<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, ValidatesRequests;

	/**
	 * @param RedirectResponse $response
	 * @param bool $status The status for Notyf popup alert
	 * @param string $message The message for Notyf popup alert
	 * @return RedirectResponse
	 */
	public function redirect_with_notyf(
		RedirectResponse $response,
		bool $status = true,
		string $message = ''
	): \Illuminate\Http\RedirectResponse
	{

		if (empty(trim($message))) {
			$message = ($status === false)
				? __('Operation failed')
				: __('Operation completed successfully');
		}
		return $response
			->with('status', $status)
			->with('status_message', $message);
	}

}
