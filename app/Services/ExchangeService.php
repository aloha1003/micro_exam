<?php
namespace App\Services;
class ExchangeService {


	/**
	 *  讀取台銀的csv當作資料源
	 *
	 * @param    array                    $query   [description]
	 * @param    array                    $columns [description]
	 *
	 * @return   [type]                            [description]
	 *
	 * @Author   Peter(yj@tiigod.com
	 *
	 * @DateTime 2020-05-27T21:55:39+0800
	 */
	public function bankOfTaiwancsv($query = [], $columns = [])
	{
		$url = 'https://rate.bot.com.tw/xrt/flcsv/0/day';
		$csvData = file_get_contents($url);
		$lines = explode(PHP_EOL, $csvData);
		$array = [];
		foreach ($lines as $line) {
		    $array[] = str_getcsv($line);
		}
		//去掉標題列
		array_shift($array);
		//當天記錄
		$today = date('Y-m-d', time());
		collect($array)->map(function($item){
			$return  = [
				
			];
		})
		dd($array);
	}

	protected function writeToModel($data)
	{

	}
}