1.  Konsep staf
    -> Supervisor pekerjaan (Inspektor)
    -> Pemberi kerja
    -> Quality Control
    -> Pelaksana Pekerjaan
    -> Sistem Admin IT
    -> Maintain aplikasi
    -> Entry Kategori dan Sub Kategori komponnen/Suku cadang
    Kategori Komponen Rel
    Sub Kategori Komponen Batang Utama
    Sub Kategori Klem Rel

        	-> Entry Standar Tipe Kegiatan Kerja
        		 Dasar Jenis Kegiatan Kerja
        			pengukuran dan analisis,
        			perbaikan,
        			penggantian komponen,
        			penggantian material,
        			pembongkaran,
        			pembuatan,
        			penyetelan (adjusment)
        		Ada Kategori untuk mengelompokkan Tipe Kegiatan Kerja,
        		Di Bawah sebuah kategori ada sejumlah item Tipe Kegiatan Kerja
        		Setiap Item Tipe Kegiatan Kerja,
        			--> harus di klasifikasikan dasar jenis kegiatan kerjanya.
        			--> satuan unit kerja
        			--> Kebutuhan jumlah SDM
        			--> kebutuhan peralatan untuk mengerjakan
        			--> kebutuhan komponen per satuan unit kerja
        				-> komponen ... jumlah nya
        				-> komponen ... jumlah nya
        			--> kebutuhan material per satuan unit kerja
        				-> material ... volume/jumlah nya
        				-> material
        		Contoh :
        			Perbaikan Fondasi Jembatan (Kategori Tipe Kegiatan Kerja)
        				-> Item Penambahan Batu Balas (perbaikan)
        				-> Penggantian komponen ....



        	-> Entry
        		Staf	--> Email, Username, password, Status aktif/tidak
        			--> Level jabatan / peran jabatan
        				Pimpinan Proyek
        				Supervisor,
        				Pengukur (pelaksana pengukuran),
        				Analis Teknis (supervisor pengukuran),
        				Pelaksana Kerja,
        				Pemeriksa Kerja,
        				Logistik (inventori)
        				Inventaris Alat

2.  Siklus Pekerjaan
    2.1. Didefinisikan sebuah proyek
    -> Nama Proyek
    -> Tanggal mulai
    -> Tanggal berakhir

    2.2. Di bawah sebuah proyek , bisa didefinisikan 1 atau lebih grup pekerjaan,
    setiap grup pekerjaan, ditetapkan 1 supervisor, 1 atau lebih pemeriksa, 1 atau lebih pelaksana

    2.3. Di bawah sebuah grup pekerjaan dibawah sebuah proyek,
    si supervisor yang ditunjuk bisa mulai mendefinisikan
    tugas kerja.
    Untuk sebuah Tugas kerja, supervisor menetapkan
    -> Judul Tugas
    -> jenis Tipe kegiatan Kerja
    -> staf-staf yang ditugaskan
    -> Catatan instruksi pekerjaan
    --> Kondisi, masalah
    --> teknik pelaksanaan
    --> Standar teknik pemeriksaan
    -> tanggal mulai diminta-siapkan pendukung pelaksanaan
    alat
    komponen suku cadang (apa dan berapa)
    komponen material (apa dan berapa)
    -> tanggal mulai harus dikerjakan
    -> tanggal harus sudah selesai
    -> Predecssor tugas kerja prasyarat (kalau ada)

    2.4. Ketika sebuah Tugas Kerja di rilis oleh supervisor,
    maka keluar berita acara tugas kerja
    -> Berita acara penugasan untuk si pelaksana kerja, detilnya sbb
    no proyek
    no tugas kerja
    judul pekerjaan
    nama supervisor
    detil pekerjaan
    lokasi pekerjaan
    kapan alat kerja harus sudah siap
    kapan suku cadang harus segera diselesaikan persiapan
    kapan material harus segera diselesaikan persiapan
    kapan harus dikerjakan
    -> Berita acara permintaan alat kerja --> ke staf inventaris alat kerja
    -> Berita acara permintaan suku cadang/komponen --> ke inventori
    -> Berita acara pengadaan material --> ke procurement material/inventori

    2.4. Status berita acara tugas kerja
    -> Berita acara penugasan untuk si pelaksana kerja
    statusnya : Rilis --> Dibatalkan (oleh supervisor)
    Rilis --> Dalam Persiapan
    Dalam Persiapan --> Dalam Pengerjaan (di naikkan oleh pelaksa kerja)
    Dalam Pengerjaan --> Selesai pengerjaan (di naikkan oleh pelaksa kerja)
    Selesai pengerjaan --> Dalam Pemeriksaan (di naikkan oleh pemeriksa)
    Dalam Pemeriksaan --> Pending Koreksi (di naikkan oleh pemeriksa)
    Dalam Pemeriksaan --> Selesai diterima (di naikkan oleh pemeriksa)
    Pending Koreksi --> Dalam pengerjaan (di naikkan oleh pelaksana kerja)

        -> Berita acara permintaan alat kerja 		--> ke staf inventaris alat kerja
        	selama dalam status "Dalam persiapan"
        	ada sub status
        		Persiapan Alat Kerja	(sudah/sebagian/belum)
        	(di naikkan oleh Bendahara Peralatan)
        -> Berita acara permintaan suku cadang/komponen --> ke inventori
        	selama dalam status "Dalam persiapan"
        	ada sub status
        		Persiapan Suku Cadang	(sudah/sebagian/belum)
        	(di naikkan oleh Staf logistik/inventori)
        -> Berita acara pengadaan material		--> ke procurement material/inventori
        	selama dalam status "Dalam persiapan"
        	ada sub status
        		Persiapan Material	(sudah/sebagian/belum)
        	(di naikkan oleh Staf logistik/inventori)

    3. Konsol dashboard untuk setiap jenis jabatan staf, memiliki fitur fungsi sebagai berikut
       3.2. Pimpinan Proyek
       -> Membuat grup pekerjaan
       -> Menetapkan untuk proyek tersebut, siapa2 supervisor nya untuk setiap grup pekerjaan
       -> memonitor semua kegiatan tugas kerja yang sedang berlangsung di proyek tersebut
       di semua grup kerja.

        3.1. Supervisor /inspector
        -> membuat tugas-tugas kerja dibawah grup yang dia tanggung jawab,
        dengan detil setiap tugas kerja seperti diatas
        -> memonitor status setiap tugas kerja
        -> status nya
        -> due date nya sisa berapa hari, atau sudah lewat berapa hari
        -> ada masalah dicatatkan, diusukan di sebuah tugas kerja
        -> monitor foto2 kegiatan

        3.2. Pelaksana Pengukuran (Adjustmen
        -> memonitor tugas yang masuk untuk dirinya
        -> melakukan pelaksanaan tugas
        -> menaikkan status tugas kerja tersebut
        --> dalam persiapan --> dalam pengerjaan
        --> dalam pengerjaan --> selesai dikerjakan
        --> pending koreksi --> dalam pengerjaan --> selesai dikerjakan
        3.3. Pelaksana Analisis (pemeriksa kerja pengukuran)
        -> memonitor tugas yang masuk untuk dirinya
        -> melakukan pelaksanaan tugas
        -> menaikkan status tugas kerja tersebut
        selesai dilakukan pengukuran --> selesai diterima
        selesai dilakukan pengukuran --> pending koreksi
        3.4. Pelaksana Pekerjaan
        -> memonitor tugas yang masuk untuk dirinya
        -> melakukan pelaksanaan tugas
        -> menaikkan status tugas kerja tersebut
        --> dalam persiapan --> dalam pengerjaan
        --> dalam pengerjaan --> selesai dikerjakan
        --> pending koreksi --> dalam pengerjaan --> selesai dikerjakan
        3.5. Pelaksana Pemeriksa Pekerjaan
        -> memonitor tugas yang masuk untuk dirinya
        -> melakukan pelaksanaan tugas
        -> menaikkan status tugas kerja tersebut
        selesai dikerjakan --> selesai diterima
        selesai dikerjakan --> pending koreksi
        3.6. Bendahara Peralatan
        -> memonitor tugas yang masuk untuk dirinya
        -> melakukan pelaksanaan tugas
        -> menaikkan status tugas kerja tersebut
        --> Peralatan pendukung kerja dinyatakan siap
        3.7. Petugas Logistik/Inventori
        -> memonitor tugas yang masuk untuk dirinya
        -> melakukan pelaksanaan tugas
        -> menaikkan status tugas kerja tersebut
        --> Material kebutuhan kerja dinyatakan siap
        --> Komponen Suku Cadang kebutuhan kerja dinyatakan siap

3.  Database yang ada
    -> Tabel Kategori Item Jenis Pekerjaan dan Detil Item Jenis Pekerjaan
    -> Tabel Staf
    -> Tabel Kategori dan Sub kategori Suku Cadang/Komponen
    -> Kategori Mekanikal
    -> Sub Kategori Block Bearing

    -> Tabel Jenis Item Suku Cadang/komponen
    -> Item Block Bearing Size 12A teeth 4 Merek SKF
    -> Spek
    -> Foto

    -> Tabel Kartu Gudang untuk setiap Jenis Item Suku cadang/Komponen
    untuk Item Block Bearing Size 12A teeth 4 merek SKF
    adalah catatan historis jumlah nya digudang
    Tanggal dan Jam | Awal | Masuk | Keluar | Catatan Peristiwa | Akhir
    -----------------------------------------------------------------------
    -----------------------------------------------------------------------
    -> Tabel Kategori dan Sub kategori Material
    -> Tabel Jenis Item Material
    -> Tabel Kartu Gudang untuk setiap Jenis Item Material
    -> Tabel Proyek
    -> Tabel Grup Kerja di bawah sebuah proyek
    -> Tabel Item Kerja di bawah sebuah grup kerja dibawah sebuah proyek
    -> Tabel Kategori Alat Kerja
    -> Tabel Item Alat Kerja
    -> Tabel Histori Penggunaan Alat Kerja

4.  Laporan2
    Laporan2 terkait proyek
    -> Laporan pada tahap perencanaan proyek
    -> dipakai untuk memproyeksikan kebutuhan proyek
    -> berapa lama waktu yang diperlukan baik secara artikel kerja
    hingga aggregasi keseluruhan proyek
    -> berapa kebutuhan
    material (jumlah volume material dan nilai rupiah)
    suku cadang (jumlah unit dan nilai rupiah)
    jam kerja dan SDM nya (man hour, sesuai jenjang jabatan, ada nilai rupiah)
    -> berapa final kebutuhan pendanaan untuk pelaksanaan proyek tersebut

    _-> Laporan pada tahap pelaksanaan proyek
    -> dipakai untuk monitoring kegiataan pelaksanaan
    _-> ada masalah di mana
    _-> ada yang terlambat di mana
    _-> seberapa terlambat
    ?-> menghitung kemungkinan dampak keterlambatan terhadap waktu pelaksanaan keseluruhan proyek (Tidak Perlu)
    _-> melihat apa saja tugas yang belum selesai, sedang dilaksanakan, sedang diperiksa, sudah selesai
    _-> melihat apa saja suku cadang dan material yang sudah dikonsumsi oleh proyek ini

    -> Laporan pada tahap post pelaksanaan proyek (proyek sudah selesai dan akan diaudit)

    \*-> Laporan2 terkait logistik (suku cadang dan material)
    -> Melihat Kartu gudang setiap item (histori jumlah barang sebuah item dari waktu ke waktu)
    -> Melihat rekap posisi jumlah semua barang di waktu tertentu

5.  Penjelasan tentang Status Kerja dan Jenis Pekerjaan
    6.1. Jenis Pekerjaan
    -> Pemeriksanaan
    -> Seting dan Adjustment (Penyetelan)
    -> Pemeliharaan
    -> Perbaikan
    -> Penggantian
    -> Pembongkaran (take out)
    -> Pembuatan/Penambahan

    6.2. Status Pekerjaan
    -> Dalam Pendefinisian
    Dalam Pendefinisian --> Rilis

        -> Rilis
        	Rilis --> Dibatalkan (oleh supervisor)
        	Rilis --> Dalam Persiapan

        -> Dalam persiapan
        	Dalam persiapan --> Dalam Pengerjaan (Status dinaikkan oleh Pelaksana kerja)

        -> Dalam Pengerjaan
        	Dalam pengerjaan --> Selesai, Belum Diperiksa (Status dinaikkan oleh Pelaksana kerja)

        -> Selesai Belum Diperiksa
        	Selesai Belum Diperiksa --> Selesai, Sedang Diperiksa (Status dinaikkan oleh Pemeriksa)

        -> Selesai, Sedang Diperiksa
        	Selesai, Sedang Diperiksa  --> Pending Koreksi (status dinaikkan oleh pemeriksa)
        	Selesai, Sedang Diperiksa  --> Selesai, Diterima (status dinaikkan oleh pemeriksa)

        -> Pending Koreksi
        	Pending Koreksi --> Dalam Pengerjaan (status dinaikkan oleh Pelaksana Kerja)

    6.3. Peran Jabatan Staf
    -> Admin IT
    -> Bikin Kategori dan Subkategori Suku cadang dan material
    -> Bikin definisi item Suku cadang dan material
    -> Mendaftarkan staf dan peran jabatan
    -> Mendefinisikan sebuah proyek baru dan manajernya
    -> Manajer Proyek
    -> Bikin Struktur Sebuah Proyek
    Grup Kerja
    Sub Grup Kerja (dan menetapkan siapa supervisornya di sini)

        -> Supervisor
        	-> Bikin Item Kerja dibawah sub grup kerja

        	-> Mendetilkan sebuah item Kerja (selama status Dalam pendefinisian)
        		-> Masalah dan situasi, konsultasi dengan ahlinya, pekerjanya
        		-> Instruksi dan arahan pekerjaan terkait
        		-> Kebutuha material, suku cadang dan komponen
        		-> Waktu kapan dimulai dan kapan harus selesai
        		-> Petugas pelaksana pekerjaan

        	-> Merilis sebuah item kerja (publish)

        -> Pelaksana Kerja (bisa pihak ke 3 statusnya)
        	-> Menerima sebuah rilis item kerja (penugasan)
        	-> Menaikkan status
        		-> Dari Rilis ke Persiapan
        		-> Dari Persiapan ke Dalam Pengerjaan
        		-> Dari Dalam Pengerjaan ke Selesai
        	-> Selama dalam status "Dalam pengerjaan" menginput berbagai laporan situasi dan masalah

        -> Pemeriksa Kerja
        	-> Menerima tugas pemeriksaan yang masuk (status Selesai, belum diperiksa)
        	-> Menaikkan Status
        		-> Dari Selesai,Belum Diperiksa --> Ke Selesai, Sedang Diperiksa
        		-> dst nya
        	-> memberikan beragam catatan tambahan dan koreksi hasil perkejaan selama berstatus sedang diperiksaa


        -> Bendahara Alat Kerja

        -> Bendahara Logistik 	(orang gudang urusan suku cadang dan material)
