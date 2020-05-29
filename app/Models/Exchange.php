<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
/**
 * @OA\Schema(
 *     schema="匯率",
 *     type="object",
 *     @OA\Property(
 *         property="currency",
 *         type="string",
 *         description="幣別"
 *     ),
 *     @OA\Property(
 *         property="spot_buy",
 *         type="string",
 *         description="即期買入"
 *     ),
 *     @OA\Property(
 *         property="spot_sell",
 *         type="string",
 *         description="即期賣出"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="匯率列表",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/匯率")
 * )
 */
/**
 * Class Exchange.
 *
 * @package namespace App\Models;
 */
class Exchange extends Model implements Transformable
{
    use TransformableTrait;

    protected $casts = [
        'spot_buy' => 'double',
        'spot_sell' => 'double',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'exchange_rates';
	protected $hidden = ['updated_at', 'created_at'];
    protected $fillable = [ 'currency', 'spot_buy','spot_sell'];

}
