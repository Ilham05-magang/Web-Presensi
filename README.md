## Cara install

-   Clone this repository

```sh
git clone https://github.com/Ilham05-magang/Web-Presensi.git
# make sure you are in the folder
cd (folder yang sudah diclone tadi)
```

-   Install semua package

```sh
npm install
```

```sh
composer install atau composer update
```

- Menyalakan Xampp terlebih dahulu, nyalakan **Apache dan Mysql**

- Ubah **.env.example menjadi .env**

- Membuat Database di mysql dengan **Nama Database yang sesuai dengan .env** Cukup lihat di baris **14**


- Melakukan generate datadummy
```sh
php artisan migrate:fresh --seed
```

- Menjalankan web **jalankan di dua terminal yang berbeda**
```sh
npm run dev 
```

```sh
php artisan serve 
```

-   And go to **http://127.0.0.1:8000/**  atau ( CRTL + klik ) link yang ada di terminal **php arisan serve**

## Cara refresh branch local vsc
```sh
  git fetch
```
## Catatan Selalu melakukan Singkronisasi/pull pada VSC
