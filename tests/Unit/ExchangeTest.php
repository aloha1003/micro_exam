<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Exchange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExchangeTest extends TestCase
{
    use RefreshDatabase;
    //匯率結構
    protected $exchangeStruct = ['id', 'currency','spot_buy', 'spot_sell'];
    // 測試輸入資料
    protected $inputData = [
            'currency' => 'test',
            'spot_buy' => 1.1,
            'spot_sell' => 0.1
        ];
    

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->seed('ExchangeSeeder');
        $response = $this->get('/api/exchange');
        //验证目标
        //1. 需要有data
        //2. 项目结构检查
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ])
            ->assertJsonStructure(['data' => ['*' => $this->exchangeStruct]])
            ;
    }

    /**
     * 测试新建汇率
     *
     * @return   [type]                   [description]
     *
     * @Author   Peter(yj@tiigod.com
     *
     * @DateTime 2020-05-29T11:58:13+0800
     */
    public function testStore()
    {
        
        $response = $this->post('/api/exchange', $this->inputData);
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->exchangeStruct)
            ;
       $content = $response->decodeResponseJson()  ;   
       //验证写入资料一致
       $this->assertEquals($this->inputData['currency'], $content['currency'] );
       $this->assertEquals($this->inputData['spot_buy'], $content['spot_buy'] );
       $this->assertEquals($this->inputData['spot_sell'], $content['spot_sell']);
    }

    public function testShow()
    {
        $response = $this->get('/api/exchange/USD');
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->exchangeStruct)
            ;

    }

    public function testUpdate()
    {
        $inputData = [
            'spot_buy' => 1.1,
            'spot_sell' => 0.1
        ];
        $response = $this->put('/api/exchange/USD', $inputData);
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->exchangeStruct)
            ;
        //验证写入资料一致
       $content = $response->decodeResponseJson()  ;   
       $this->assertEquals($inputData['spot_buy'], $content['spot_buy'] );
       $this->assertEquals($inputData['spot_sell'], $content['spot_sell']);    
    }

    public function testDelete()
    {
       $response = $this->delete('/api/exchange/USD'); 
       $response
            ->assertStatus(200)
            ;
    }
}
