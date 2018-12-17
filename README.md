# REST API SEDERHANA



disini saya membuat rest api untuk mendapatkan data tentang kota dan provinsi dengan menggunakan API rajaongkir

1) pertama kita buat database bernama 'rajaongkir' di phpmyadmin

2) setelah itu git clone repo ini dan masuk folder clone kita tadi lalu jalankan perintah **composer install**

3) kita ganti nama file **.env.example** menjadi **.env** lalu kita rubah beberapa variabel sesuai dengan database kita

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rajaongkir
DB_USERNAME=root
DB_PASSWORD=
```
setelah itu kita jalankan perintah
**php artisan migrate** untuk membuat tabel di database **rajaongkir**

4) setelah itu jalankan perintah **php artisan fetch:province** untuk memasukkan data provinsi dan kota dari API rajaongkir ke dalam database rajaongkir tunggu sampai ada tulisan **done**

5) setelah itu jalankan laravel dengan menggunakan perintah **php artisan serve** lalu buka halaman http://localhost:8000 jika ada tulisan **Laravel** maka laravel sudah berjalan dengan benar
jika masih error jalankan perintah **php artisan key:generate** lalu jalankan perintah **php artisan serve**

<!--6) register dahulu dengan masuk ke **http://localhost:8000/register?user=coba&pass=coba1** disini kita menggunakan **username** **coba** dan **password coba1** untuk percobaan register  jika berhasil anda akan mendapat json seperti ini-->

<!--```-->
<!--{-->
<!--user: "coba",-->
<!--pass: "coba1",-->
<!--updated_at: "2018-12-14 11:48:36",-->
<!--created_at: "2018-12-14 11:48:36",-->
<!--id: 2,-->
<!--}-->
<!--```-->
<!--tandanya anda telah berhasil register dalam sistem-->

<!--7) setelah itu login dengan user dan pass yang sudah anda buat tadi yaitu user=coba dan pass=coba1 dengan masuk ke link berikut **http://localhost:8000/login?user=coba&pass=coba1** jika berhasil anda akan mendapatkan json seperti dibawah ini-->

<!--```-->
<!--{-->
<!--key: "1d94be6d288a0b1fefadd52fbe44b8e223b2da847358de1a30b7f5f20b5e088c",-->
<!--keterangan: "gunakan key untuk search/cities?id={city_id} atau search/provinces?id={province_id}",-->
<!--}-->
<!--```-->

<!--8) keterangan disini saya gunakan untuk memperjelas anda agar bisa mencari provinsi dan kota dengan key yang sudah anda dapatkan dengan begini anda bisa mencari provinsi atau kota dengan menuju link **search/cities?id={city_id}** atau **search/provinces?id={province_id}** misal kita coba mencari provinsi dengan id 1 maka kita menuju link **https://localhost:8000/search/provinces?id=1&key=1d94be6d288a0b1fefadd52fbe44b8e223b2da847358de1a30b7f5f20b5e088c** dengan menuju ke link berikut maka anda akan mendapatkan json seperti di bawah ini-->

<!--```-->
<!--[-->
<!--{-->
<!--province_id: 1,-->
<!--province: "Bali",-->
<!--created_at: "2018-12-14 11:46:10",-->
<!--updated_at: "2018-12-14 11:46:10",-->
<!--}-->
<!--]-->
<!--```-->
<!--9) untuk melihat semua id city anda bisa melihat disini **http://localhost:8000/cities** sedangkan provinsi bisa dilihat disini **http://localhost:8000/provinces**-->
# REVISI
revisi kali ini register dengan username yang sama tidak diperbolehkan dan key digunakan di header dan beberapa url sensitif seperti login
atau register atau pencarian selalu menggunakan method POST dan juga saat register password akan otomatis di hash beberapa fungsi CRUD 
yang saya buat antara lain /create/provinces, /create/cities, /provinces, /cities, /update/provinces/{id}, /update/cities/{id},
/delete/provinces/{id}, /delete/cities/{id}

beberapa API yang terdaftar

| API        | METHOD           | PARAMETER  |HEADER |EXAMPLE|JSON|
| ------------- |:-------------:| -----:|-----:|-----:|-----:|
| /register      | POST | user,pass | |curl -d "user=cobs&pass=coba" -X POST http://localhost:8000/register|{"user":"cobs","pass":"132e80d3caf4e1327ff9ad906aa5084ebdc5e625088b9133fcef2e38a58206cc","updated_at":"2018-12-17 11:42:35","created_at":"2018-12-17 11:42:35","id":3} |
| /login      | POST      |   user,pass | |curl -d "user=cobs&pass=coba" -X POST http://localhost:8000/login |{"key":"37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619","keterangan":"gunakan key untuk POST dan GET beberapa API"} |
| /search/provinces | POST      |    id |Key |curl -d "id=1" -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X POST http://localhost:8000/search/provinces |[{"province_id":1,"province":"Bali","created_at":"2018-12-17 10:42:44","updated_at":"2018-12-17 10:42:44"}]|
| /search/cities |POST|id|Key|curl -d "id=1" -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X POST http://localhost:8000/search/cities|[{"city_id":1,"province_id":21,"province":"Nanggroe Aceh Darussalam (NAD)","type":"Kabupaten","city_name":"Aceh Barat","postal_code":"23681","created_at":"2018-12-17 10:42:42","updated_at":"2018-12-17 10:42:42"}]|
|/provinces|GET||Key|curl  -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X GET http://localhost:8000/provinces|[Array of Provinces]| 
|/cities|GET||Key|curl  -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X GET http://localhost:8000/cities|[Array of cities]|
|/create/provinces|POST|province|Key| curl -d "province=eastjava" -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X POST http://localhost:8000/create/provinces |{"province":"eastjava","province_id":37,"updated_at":"2018-12-17 12:02:49","created_at":"2018-12-17 12:02:49","id":0}|
|/create/cities|POST|province_id,city_name,postal_code,type|Key|curl -d "province_id=1&city_name=banda&postal_code=1231&type=kelurahan" -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X POST http://localhost:8000/create/cities|{"province_id":"1","province":"Bali","city_id":503,"city_name":"banda","postal_code":"1231","type":"kelurahan","updated_at":"2018-12-17 12:05:36","created_at":"2018-12-17 12:05:36","id":0|
|/delete/provinces/{id}|DELETE||Key|curl -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X DELETE http://localhost:8000/delete/provinces/5 |{"sukses":"sukses delete id 5"}|
|/delete/cities/{id}|DELETE||Key|curl -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X DELETE http://localhost:8000/delete/cities/5 |{"sukses":"sukses delete id 5"}|
|/update/cities/{id}|POST|province_id,city_name,type,postal_code|Key|curl -d "province_id=1&city_name=banda&postal_code=1231&type=kelurahan" -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X POST http://localhost:8000/update/cities/1|[{"city_id":1,"province_id":1,"province":"Bali","type":"kelurahan","city_name":"banda","postal_code":"1231","created_at":"2018-12-17 10:42:42","updated_at":"2018-12-17 12:31:30"}]|
|/update/provinces/{id}|POST|province|Key|curl -d "province=kuja" -H "Key:37c21c19b8586cc6730f71c060e276bc808fa409fb77ae61f3f657b38f881619" -X POST http://localhost:8000/update/provinces/1  |[{"province_id":1,"province":"kuja","created_at":"2018-12-17 10:42:44","updated_at":"2018-12-17 12:33:08"}]|



