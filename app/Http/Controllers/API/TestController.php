<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Services\ExchangeService;
class TestController extends Controller {

	public function index()
	{
		$service = app(ExchangeService::class);
		$service->bankOfTaiwancsv();

	}
}