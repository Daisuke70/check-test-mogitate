# 確認テスト　もぎたて

## 環境構築
Dockerビルド  
1.git clone git@github.com:Daisuke70/check-test-mogitate.git  
2.docker-compose up -d --build  

Laravel環境構築  
1.docker-compose exec php bash  
2.composer install  
3..env.exampleファイルから.envを作成し、環境変数を変更  
4.php artisan key:generate  
5.php artisan migrate  

## 使用技術(実行環境)  
・PHP 7.4.9  
・Laravel 8.83.8  
・MySQL 15.1  


## ER図
作成するまでに至りませんでした。  


## URL
・開発環境：http://localhost/  
・phpMyAdmin：http://localhost:8080/
