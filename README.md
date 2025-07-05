<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
## Cara Kerja Tim Proyek Ini

1. Semua fitur dikerjakan di branch masing-masing (`feature/nama-fitur`)
2. Jangan push langsung ke `main`
3. Gunakan `pull request` untuk review
4. Format kode pakai Laravel Pint sebelum push
5. Kalo bingung, tanya Mack 😄


## Cara push ke repo utama, kalo project sudah dikerjakan
1. git status -> untuk melihat perubahan kode yang telah dibuat
2. git branch -> untuk melihat dan memastikan, bahwa kita tidak push di branch main
3. git add . -> untuk menambahkan kode terbaru ke dalam direktori lokal (cmiiw)
4. git commit -m "commit project" -> untuk menyimpan perubahan kode ke direktori lokal, dan penamaannya
5. git push -u origin nama_branch_yang_ada_sewaktu_dicek -> ini untuk push project, tapi push ke branch yang sebelumnya dibuat, dan dicek tadi sewaktu git branch, setelah dipush
6. buka github tempat repo utama disimpan, buka pull request nanti ada button bertuliskan "compare and pull request", klik itu dan akan muncul hal-hal yang harus disetting agar kode bisa push ke branch main di repo utama
7. minta ketua untuk terima request-an kode agar dimasukkan ke dalam repo utama atau branch main, lalu ketua akan menghapus branch yang sudah tidak dibutuhkan di reponya.


## Membuat kode baru

1. Pastikan branchnya berada di main, klo masih di branch lain, ketik perintah " git branch -M main "
2. git origin -v -> untuk memastikan kita sudah berada di branch main, agar bisa menarik kode terbaru
3. tapi sebelum menarik kode baru, pastikan untuk ketua sudah approve sama kode yang dibuat sebelumnya, kalo kode sebelumnya sudah diapprove,
4. git pull -> untuk menarik semua kode terbaru yang ada di repo
5. git branch new_project -> buat branch baru sesuai dengan nama project yang dikerjakan, agar tidak bentrok dengan branch main
6. git checkout new_project -> untuk masuk ke branch yang sudah dibuat
7. git branch -> untuk memastikan apakah kita sudah masuk ke branch yang sudah dibuat, kalo sudah masuk
8. Lanjutkan coding


NB: Usahakan saat ngoding untuk memerhatikan setiap kode yang dibuat, huruf besar, huruf kecil, kata-katanya, jangan sampai ada yang terlewat ataupun salah kata.

Tips: Gunakan github copilot, windsurf, blackbox.ai untuk memudahkan proses debugging dan lain sebagainya
>>>>>>> origin/main
