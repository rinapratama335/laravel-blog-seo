## Menampilkan Isi Konten Post dan SEO Url

Materi kali ini berfokus pada pemecahan template menjadi beberapa bagian (blog.blade, head.blade, content.blade, footer.blade, isi_post.blade, widget.blade).

Kita juga membuat route unutk url dengan parameter adalah slug dari kontent dan mengaliaskan dengan name.
Yang perlu kita ingat adalah jika route itu dialiaskan maka pemanggilannya adalah dengan `name` nya, tetapi jika tidak maka pemanggilannya adalah `url` nya.

Untuk selebihnya adalah pengakasesan data dari database dan juga menampilkannya ke dalam view.
