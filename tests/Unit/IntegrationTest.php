<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntegrationTest extends TestCase
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
    public function testIntegration()
    {
        //整合測試流程
        //1.訪問列表 ，不能出現 測試的資料 才是正確
        $this->step1();
        
        //2.新建測試資料
        $this->step2();
        //3.顯示測試資料
        $this->step3();
        //4.修改測試資料
        $this->step4();
        //5.再一次訪問列表，應該要出現測試資料
        $this->step5();
        //6.刪除測試資料
        $this->step6();
        
    }

    protected function step1()
    {
    	$response = $this->get('/api/exchange');
    	$response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
            ])
            ->assertJsonStructure(['data' => ['*' => $this->exchangeStruct]])
            ->assertJsonMissing([ 'currency' => $this->inputData['currency']])
            ;
    }

    public function step2()
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

    public function step3()
    {
        $response = $this->get('/api/exchange/'.$this->inputData['currency']);
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->exchangeStruct)
            ;
    }

    public function step4()
    {
        $inputData = [
            'spot_buy' => 1.1,
            'spot_sell' => 0.1
        ];
        $response = $this->put('/api/exchange/'.$this->inputData['currency'], $inputData);
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->exchangeStruct)
            ;
        //验证写入资料一致
       $content = $response->decodeResponseJson()  ;   
       $this->assertEquals($inputData['spot_buy'], $content['spot_buy'] );
       $this->assertEquals($inputData['spot_sell'], $content['spot_sell']);    
    }

    public function step5()
    {

    	$response = $this->get('/api/exchange');
    	$response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ])
            ->assertJsonStructure(['data' => ['*' => $this->exchangeStruct]])
            ->assertJsonFragment([ 'currency' => $this->inputData['currency']])
            ;
            $content = $response->getContent();  

    }

    public function step6()
    {
       $response = $this->delete('/api/exchange/'.$this->inputData['currency']); 
       $response
            ->assertStatus(200)
            ;
    }
}
