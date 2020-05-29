<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeAddRequest;
use App\Http\Requests\ExchangeUpdateRequest;
use App\Repositories\ExchangeRepository;
/**
 * @OA\Server(url="http://127.0.0.1:8080/api/exchange")
 */
/**
 * @OA\Schema(
 *     schema="Error",
 *     @OA\Property(
 *         property="code",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string"
 *     )
 * )
 */


/**
 
 *     @OA\Info(
 *         version="1.0.0",
 *         title="微程式考題-API文件",
 *         description="微程式考題-API文件"
 *     )
 */


class ExchangeController extends Controller
{
    protected $model;
    public function __construct(ExchangeRepository $exchangeRepo)
    {
        $this->model = $exchangeRepo;
    }
   
    /**
     * @OA\Get(
     *   path="/",
     *   tags={"匯率"},
     *   summary="匯率列表",
     *   description="匯率列表",
     *   operationId="index",
     *     @OA\Parameter(name="currency", in="query", @OA\Schema(type="string"), description="幣別"),
     *     @OA\Response(
     *         response=200,
     *         description="匯率列表",
            @OA\Property(
                     property="data",
     *       @OA\Schema(ref="#/components/schemas/匯率列表")
     *       )
     *     ),
     * @OA\Response(
     *     response="500",
     *     description="An unexpected error occured.",
     *     @OA\schema(ref="#/components/schemas/Error")
     * )


     * )
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = request();
        $result = $this->model->findWhere($query->all());
        return response()->json(['data'=>$result]);
        
    }

    /**
     * @OA\Post(
     *   path="/",
     *   tags={"匯率"},
     *   summary="新建匯率",
     *   description="新建匯率",
     *   operationId="store",
     *     @OA\Parameter(name="currency", in="query",
     *     required=true, description="幣別", 
     *     @OA\Schema(type="string",  enum={"USD","HKD","GBP","AUD","CAD","SGD","CHF","JPY","ZAR","SEK","NZD","THB","PHP","IDR","EUR","KRW","VND","MYR","CNY"})
     *     ),
     *     @OA\Parameter(name="spot_buy", in="query", @OA\Schema(type="number"), required=true, description="即期買入"),
     *     @OA\Parameter(name="spot_sell", in="query", @OA\Schema(type="number"), required=true, description="即期賣出"),
     *     @OA\Response(
     *         response=200,
     *         description="匯率",
     *       @OA\Schema(ref="#/components/schemas/匯率")
     *     ),
     *  @OA\Response(
     *     response="500",
     *     description="An unexpected error occured.",
     *     @OA\schema(ref="#/components/schemas/Error")
     *   )
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExchangeAddRequest $request)
    {
        try {
            $exchange = $this->model->findWhere(['currency' => $request['currency']])->first();

            if ($exchange) {
                throw new \Exception("Has Created");
            }
            $exchange = $this->model->create($request->all());
            
            return response()->json($exchange);
        } catch (\Exception $ex) {
            return response()->json(['code' => $ex->getCode(), 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *   path="/{currency}",
     *   tags={"匯率"},
     *   summary="取得匯率",
     *   description="匯率",
     *   operationId="show",
     *     @OA\Parameter(name="currency", in="path",
     *     required=true, description="幣別", 
     *     @OA\Schema(type="string", enum={"USD","HKD","GBP","AUD","CAD","SGD","CHF","JPY","ZAR","SEK","NZD","THB","PHP","IDR","EUR","KRW","VND","MYR","CNY"})),
     *     @OA\Response(
     *         response=200,
     *         description="匯率",
     *       @OA\Schema(ref="#/components/schemas/匯率")
     *     ),
      * @OA\Response(
     *     response="500",
     *     description="An unexpected error occured.",
     *     @OA\schema(ref="#/components/schemas/Error")
     * )
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($currency)
    {
        try {
            $exchange = $this->model->findWhere(['currency' => $currency])->first();
            if (!$exchange) {
                throw new \Exception("Not found Exchange");
            }
            return response()->json($exchange);
        } catch (\Exception $ex) {
            return response()->json(['code' => $ex->getCode(), 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * @OA\Put(
     *   path="/{currency}",
     *   tags={"匯率"},
     *   summary="修改匯率",
     *   description="修改匯率",
     *   operationId="store",
     *     @OA\Parameter(name="currency", in="path",
     *     required=true, description="幣別", 
     *     @OA\Schema(type="string",  enum={"USD","HKD","GBP","AUD","CAD","SGD","CHF","JPY","ZAR","SEK","NZD","THB","PHP","IDR","EUR","KRW","VND","MYR","CNY"})),
     *     @OA\Parameter(name="spot_buy", in="query", @OA\Schema(type="number"), required=false, description="即期買入"),
     *     @OA\Parameter(name="spot_sell", in="query", @OA\Schema(type="number"), required=false, description="即期賣出"),
     *     @OA\Response(
     *         response=200,
     *         description="匯率",
     *       @OA\Schema(ref="#/components/schemas/匯率")
     *     ),
      * @OA\Response(
     *     response="500",
     *     description="An unexpected error occured.",
     *     @OA\schema(ref="#/components/schemas/Error")
     * )
     * )
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExchangeUpdateRequest $request, $currency)
    {
        try {
            $exchange = $this->model->findWhere(['currency' => $currency])->first();
            if (!$exchange) {
                throw new \Exception("Not found Exchange");
            }
            $result = $this->model->update($request->all(), $exchange->id);
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json(['code' => $ex->getCode(), 'message' => $ex->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *   path="/{currency}",
     *   tags={"匯率"},
     *   summary="刪除匯率",
     *   description="刪除匯率",
     *   operationId="destory",
     *     @OA\Parameter(name="currency", in="path",
     *     required=true, description="幣別", 
     *     @OA\Schema(type="string",  enum={"USD","HKD","GBP","AUD","CAD","SGD","CHF","JPY","ZAR","SEK","NZD","THB","PHP","IDR","EUR","KRW","VND","MYR","CNY"})),
     *     @OA\Response(
     *         response=200,
     *         description="删除匯率",
     *         @OA\Schema(
     *         type="object",
     *         @OA\Property(
     *             property="status",
     *             type="int",
     *             required=true,
     *             description="狀態:1:操作成功"
     *         ),
     *        )
     *     ),
     * @OA\Response(
     *     response="500",
     *     description="An unexpected error occured.",
     *     @OA\schema(ref="#/components/schemas/Error")
     * )
     * )
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy($currency)
    {
        try {
            $exchange = $this->model->findWhere(['currency' => $currency]);
            if (!$exchange) {
                throw new \Exception("Not found Exchange");
            }
             $this->model->deleteWhere(['currency' => $currency]);
            return response()->json(['status' => 1]);
        } catch (\Exception $ex) {
            return response()->json(['code' => $ex->getCode(), 'message' => $ex->getMessage()], 500);
        }
    }
}
