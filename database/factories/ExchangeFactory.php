<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exchange;
use Faker\Generator as Faker;

$factory->define(Exchange::class, function (Faker $faker) {
    return [
        [
			'currency' => "USD",
			'spot_buy' => 29.61,
			'spot_sell' => 29.61,
		],
		[
			'currency' => "HKD",
			'spot_buy' => 3.715,
			'spot_sell' => 3.715,
		],
		[
			'currency' => "GBP",
			'spot_buy' => 35.71,
			'spot_sell' => 35.71,
		],
		[
			'currency' => "AUD",
			'spot_buy' => 19.56,
			'spot_sell' => 19.56,
		],
		[
			'currency' => "CAD",
			'spot_buy' => 21.30,
			'spot_sell' => 21.30,
		],
		[
			'currency' => "SGD",
			'spot_buy' => 20.59,
			'spot_sell' => 20.59,
		],
		[
			'currency' => "CHF",
			'spot_buy' => 30.14,
			'spot_sell' => 30.14,
		],
		[
			'currency' => "JPY",
			'spot_buy' => 0.269,
			'spot_sell' => 0.269,
		],
		[
			'currency' => "ZAR",
			'spot_buy' => 0.000,
			'spot_sell' => 0.000,
		],
		[
			'currency' => "SEK",
			'spot_buy' => 2.730,
			'spot_sell' => 2.730,
		],
		[
			'currency' => "NZD",
			'spot_buy' => 18.13,
			'spot_sell' => 18.13,
		],
		[
			'currency' => "THB",
			'spot_buy' => 0.814,
			'spot_sell' => 0.814,
		],
		[
			'currency' => "PHP",
			'spot_buy' => 0.518,
			'spot_sell' => 0.518,
		],
		[
			'currency' => "IDR",
			'spot_buy' => 0.001,
			'spot_sell' => 0.001,
		],
		[
			'currency' => "EUR",
			'spot_buy' => 32.09,
			'spot_sell' => 32.09,
		],
		[
			'currency' => "KRW",
			'spot_buy' => 0.022,
			'spot_sell' => 0.022,
		],
		[
			'currency' => "VND",
			'spot_buy' => 0.000,
			'spot_sell' => 0.000,
		],
		[
			'currency' => "MYR",
			'spot_buy' => 5.776,
			'spot_sell' => 5.776,
		],
		[
			'currency' => "CNY",
			'spot_buy' => 4.086,
			'spot_sell' => 4.086,
		],
    ];
});
