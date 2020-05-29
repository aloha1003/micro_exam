# 微程式考試需求

## RESTful API
# 前端需要呈現如圖的相關資料，請使用 Laravel 與 RDBMS 實作的相關 RESTful API， 需要以下幾個功能:
1. 查看現有的所有的幣別、現金匯率(買入、賣出)、即期匯率(買入、賣出) 2. 查看特定幣別的現金匯率(買入、賣出)、即期匯率(買入、賣出)
3. 新增新的幣別、現金匯率(買入、賣出)、即期匯率(買入、賣出)
4. 更新既有的幣別匯率紀錄
5. 刪除既有的幣別匯率紀錄

# 單元測試及整合測試
1. 若明確得知，匯率在短時間內都不會有變化，要如何更改現有的程式架構優化查詢 匯率所需的時間
2. 請為上述所寫的程式撰寫單元測試及整合測試

# 部署說明:
1. 使用docker建置開發環境

## 執行步驟:
1. 建置環境
	
		docker-compose up -d 
		docker-compose exec php composer install
		docker-compose exec php php artisan migrate
		
2. 測試API，為了方便面試官驗證結果，已經加上Swagger文件，請直接訪問API文件[http://127.0.0.1:8080/api_doc/dist/index.html#/]

3. 單元測試，請執行以下指令
		
		docker-compose exec php vendor/bin/phpunit --filter tests\Unit\ExchangeTest


4. 整合測試，請執行以下指令
	
		docker-compose exec php vendor/bin/phpunit --filter tests\Unit\IntegrationTest

#  程式問題優化:

Q:若明確得知，匯率在短時間內都不會有變化，要如何更改現有的程式架構優化查詢 匯率所需的時間

Ans: 利用快取機制，目前是在原生的Model上再包一層 respositoy的架構，透過它本身是透過觀察者模式，在異動資料的時候，更新快取



