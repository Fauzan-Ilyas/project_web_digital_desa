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
