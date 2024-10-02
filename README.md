# Website Ecommerce

**Website E-commerce Laravel Livewire** adalah solusi lengkap untuk membangun platform jual beli online yang modern dan efisien. Berikut adalah ringkasan utama dari produk ini:

### Fitur Utama

- **Front-End dan Back-End Lengkap:** Menggunakan **Tailwind CSS**, **Alpine JS**, dan **Livewire** sebagai panel admin untuk manajemen website dan pencarian produk[1].
- **Integrasi Pembayaran:** Dukungan integrasi dengan whatsApp[1].
- **Manajemen Produk:** Fitur tambah/edit data produk serta kontrol akses produk[1].
- **Pencarian Produktif:** Mekanisme pencarian pintar yang memungkinkan pengguna mencari produk dengan efisiensi tinggi[1].

### Kemudahan Pengembangan

- **Livewire:** Memungkinkan pengembang membangun komponen interaktif dengan cepat tanpa perlu menulis banyak JavaScript, membuat proses pengembangan lebih cepat dan efisien[2].
- **Instalasi Mudah:** Proses instalasi sederhana dengan perintah artisan seperti `composer update`, `npm install`, dan `php artisan key:generate`[1].

Dengan semua fitur ini, **Website E-commerce Laravel Livewire** tidak hanya memberikan solusi jual beli online yang efektif tetapi juga memberikan pengalaman pengguna yang luar biasa.

Citations:
[1] https://github.com/jimipulsar/livewire-ecommerce
[3] https://livewire.laravel.com
## Authors

- [@yogabayu.ap](https://www.instagram.com/yogabayu.ap)
## Deployment

Pertama, pastikan sudah mempunyai database 

```bash
    composer install

    cp .env.example .env

    php artisan key:generate

    --ganti sesuai konfigurasi database anda
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=testerporto
    DB_USERNAME=root
    DB_PASSWORD=

    php artisan livewire:publish --config
    php artisan migrate --seed
    php artisan storage:link
    php artisan optimize:clear
    php artisan serve
```

Kemudian anda bisa membuka web portofolio di alamat ``` localhost:8000 ```

Akun admin 
url:  ``` localhost:8000 ```

email: admin@gmail.com

pass: 123456789
## Features

- Responsive on different screens
- Add/Edit/delete Product
- Checkout to whatsApp
- Support SEO 



## Feedback

If you have any feedback, please reach out to us at yogabayusbi@gmail.com or @yogabayu.ap 


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Tech Stack

**Tech:** Laravel 10, ToastJs, AlpineJS, Livewire

