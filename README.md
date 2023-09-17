# PhoneShop-TTTN
Thực tập tốt nghiệp - Website bán điện thoại

## Install
* Clone git
* Create a new branch
* Run `composer install`
* Run `composer update`
* Tạo DB
* Tạo file .env theo mẫu file .env.examples.
* Thêm thông tin DB_DATABASE, DB_USERNAME, DB_PASSWORD
* Run `php artisan:migrate`
* Run `php artisan orchid:admin` sau đó tạo tài khoản để đăng nhập admin
* Run `php artisan serve` sau đó vào admin bằng Route `http://127.0.0.1:8000/admin/main`
