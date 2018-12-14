jika anda menggunakan php7 jangan lupa menjalankan perintah **php artisan key:generate** setelah composer install
# REST API SEDERHANA

jika anda menggunakan php 7 pindah ke branch **php7**

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

6) register dahulu dengan masuk ke **http://localhost:8000/register?user=coba&pass=coba1** disini kita menggunakan **username** **coba** dan **password coba1** untuk percobaan register  jika berhasil anda akan mendapat json seperti ini

```
{
user: "coba",
pass: "coba1",
updated_at: "2018-12-14 11:48:36",
created_at: "2018-12-14 11:48:36",
id: 2,
}
```
tandanya anda telah berhasil register dalam sistem

7) setelah itu login dengan user dan pass yang sudah anda buat tadi yaitu user=coba dan pass=coba1 dengan masuk ke link berikut **http://localhost:8000/login?user=coba&pass=coba1** jika berhasil anda akan mendapatkan json seperti dibawah ini

```
{
key: "1d94be6d288a0b1fefadd52fbe44b8e223b2da847358de1a30b7f5f20b5e088c",
keterangan: "gunakan key untuk search/cities?id={city_id} atau search/provinces?id={province_id}",
}
```

8) keterangan disini saya gunakan untuk memperjelas anda agar bisa mencari provinsi dan kota dengan key yang sudah anda dapatkan dengan begini anda bisa mencari provinsi atau kota dengan menuju link **search/cities?id={city_id}** atau **search/provinces?id={province_id}** misal kita coba mencari provinsi dengan id 1 maka kita menuju link **https://localhost:8000/search/provinces?id=1&key=1d94be6d288a0b1fefadd52fbe44b8e223b2da847358de1a30b7f5f20b5e088c** dengan menuju ke link berikut maka anda akan mendapatkan json seperti di bawah ini

```
[
{
province_id: 1,
province: "Bali",
created_at: "2018-12-14 11:46:10",
updated_at: "2018-12-14 11:46:10",
}
]
```
9) untuk melihat semua id city anda bisa melihat disini **http://localhost:8000/cities** sedangkan provinsi bisa dilihat disini **http://localhost:8000/provinces**

