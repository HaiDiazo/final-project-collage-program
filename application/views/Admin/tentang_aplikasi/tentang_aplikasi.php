<div class="m-3">
    <div class="card rounded">
        <div class="card-body">

            <div class="card">
                <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h6 class="card-header" style="color: #3659A2;">Aplikasi ini tentang apa? </h6>
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="card-body" style="font-size: 14px; text-align: justify;">
                        Aplikasi ini adalah Sistem Rekomendasi Penerima Bantuan Sosial Covid-19, aplikasi ini digunakan untuk melakukan perangkingan data penduduk dimana penduduk untuk diberikan bantuan sosial Covid-19 oleh pemerintah, sehingga akan terlihat dari data penduduk yang telah diolah oleh sistem akan tampil dari peringkat tertinggi hingga terendah yang dimana peringkat tertinggi memiliki rekomendasi untuk menerima bantuan sosial.
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <a class="" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h6 class="card-header" style="color: #3659A2;">Metode apa yang digunakan dalam sistem ini?</h6>
                </a>
                <div class="collapse" id="collapseExample1">
                    <div class="card-body" style="font-size: 14px;">
                        Dalam aplikasi ini menggunakan metode AHP (Analythical Hierarci Process)
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <a class="" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h6 class="card-header" style="color: #3659A2;">Apa itu metode AHP?</h6>
                </a>
                <div class="collapse" id="collapseExample3">
                    <div class="card-body" style="font-size: 14px;">
                        Metode AHP atau <i>Analythical Hierarci Process</i> adalah model sistem pendukung keputusan dimana menguraikan masalah multi faktor atau multi kriteria yang kompleks menjadi sebuah hierarki dimana struktur dalam hirarki direpresesntasikan dengan struktur multilevel dengan level pertama adalah goal atau tujuan, yang diikuti kriteria, subkriteria, dan paling akhir adalah alternatif.
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <a class="" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h6 class="card-header" style="color: #3659A2;">Langkah - Langkah AHP</h6>
                </a>
                <div class="collapse" id="collapseExample2">
                    <div class="card-body" style="font-size: 14px;">
                        Melakukan sebuah perhitungan menggunakan metode AHP memiliki tahapan – tahapan yang harus dilakukan, tahapan tersebut yaitu:
                        <ul>
                            <li>Mengidentifikasi masalah dan menentukan kriteria serta subkriteria yang akan diolah ke dalam metode AHP yang dimana dapat menentukan sebuah solusi yang diinginkan.</li>
                            <li>Membuat matriks perbandingan atau pariwise comparison, dimana terdapat langkah yang dilakukan, yaitu:</li>
                            <ol>
                                <li>Langkah pertama, menentukan nilai prioritas elemen dengan membuat perbandingan pasangan dari elemen yang telah ditentukan.</li>
                                <li>Langkah kedua, matriks perbandingan berpasangan diisi menggunakan bilangan untuk merepresentasikan kepentingan dari suatu tingkat skala prioritas elemen terhadap elemen lainnya.</li>
                            </ol>
                            <li>Selanjutnya dilakukan sintesis, pertimbangan terhadap perbandingan berpasangan untuk memperoleh keseluruhan prioritas. Dalam hal ini terdapat langkah yang harus dilakukan, yaitu</li>
                            <ol>
                                <li>Menjumlahkan nilai – nilai dari setiap kolom pada baris matriks perbandingan</li>
                                <img src="<?= base_url('assets/img/ahp/matrix_comparison.png'); ?>" alt="matrix_comparison"> <br>
                                Dengan keterangan rumus, dibawah ini: <br>
                                total = penjumlahan nilai dari setiap kolom pada baris matriks, <br>
                                k = kolom pada matriks, dari 1 hingga banyaknya kriteria <br>
                                d = nilai atau data angka <br>
                                b = baris pada matriks, dari 1 hingga banyaknya kriteria <br>
                                <li>
                                    Membagi setiap nilai dari kolom dengan total kolom yang bersangkutan untuk memperoleh normalisasi matriks
                                </li>
                                <img src="<?= base_url('assets/img/ahp/rumus2.png'); ?>" alt="rumus"><br>
                                Dengan keterangan rumus, dibawah ini: <br>
                                x_bk = hasil dari pembagian setiap nilai dari baris kolom dengan total yang didapatkan dari langkah sebelumnya. <br>
                                <li>Menjumlahkan nilai – nilai dari setiap baris dan membaginya dengan jumlah lemen untuk mendapatkan nilai rata – rata.</li>
                                <img src="<?= base_url('assets/img/ahp/rumus3.png'); ?>" alt="">
                                Dengan keterangan rumus, dibawah ini: <br>
                                〖x̄〗_b= Hasil rata – rata dari setiap baris <br>
                                n = banyaknya elemen kriteria <br>
                            </ol>
                            <li>Proses perhitungan untuk menentukan λmax dimana nilai λmax akan digunakan untuk mengukur konsistensi seberapa baik yang telah diperhitungkan di sintesis agar tidak menginginkan keputusan dengan pertimbangan konsistensi yang rendah. Dalam hal ini terdapat langkah yang dilakukan yaitu:</li>
                            <ol>
                                <li>Kalikan setiap nilai pada kolom pertama di matriks perbandingan dengan prioritas relative elemen pertama, nilai pada kolom kedua dengan relative elemen kedua dan seterusnya, kemudian menjumlahkan nilai setiap baris setelah itu hasil dari penjumlahan baris dibagi dengan elemen prioritas dengan rumus, dibawah ini:</li>
                                <img src="<?= base_url('assets/img/ahp/rumus4.png'); ?>" alt=""> <br>
                                Dengan keterangan rumus, dibawah ini: <br>
                                b = baris dalam matriks, dari 1 hingga banyaknya kriteria <br>
                                k = kolom dalam matriks, dari 1 hingga banyaknya kriteria <br>
                                x_bk = hasil yang digunakan untuk mendapatkan λmaks <br>
                                d_bk = data nilai dari setiap baris dan kolom <br>
                                〖bobot〗_b= nilai bobot yang telah didapatkan dari proses sebelumnya <br>
                            </ol>
                            <li>Menjumlahkan hasil bagi sebelumnya dengan banyaknya elemen yang ada, yang dimana hasilnya ini disebut λmaks dimana rumusnya dengan sebagai berikut:</li>
                            <img src="<?= base_url('assets/img/ahp/rumus5.png'); ?>" alt="">
                            <li>Menghitung Indeks Konsistensi (CI) dengan rumus:</li>
                            <img src="<?= base_url('assets/img/ahp/rumus6.png'); ?>" alt=""> <br>
                            Dengan keterangan, dibawah ini:
                            CI = Consistency Index <br>
                            λmaks = Eigen Value <br>
                            n = banyak elemen
                            <li>Menghitung Rasio Konsistensi (CR) dengan rumus:</li>
                            <img src="<?= base_url('assets/img/ahp/rumus7.png'); ?>" alt=""> <br>
                            Dengan keterangan, dibawah ini:
                            CR = Consistency Random <br>
                            CI = Consistency Index <br>
                            IR = Index Random Consistency, <br>
                            dengan daftar Index Random Consistency dapat dilihat pada dibawah ini: <br>
                            <img src="<?= base_url('assets/img/ahp/rumus8.png'); ?>" alt="tabel_ir" style="width: 60vh;">
                            <li>Memeriksa konsistensi hierarki, Untuk mengetahui seberapa baik konsistensi hierarki dapat dilihat, jika nilainya kurang atau sama dengan 0.1, maka hasil perhitungan bisa dinyatakan telah konsisten. Jika nilai lebih dari 0.1, maka penilaian nilai perbandingan harus diperbaiki. </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <a class="" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <h6 class="card-header" style="color: #3659A2;">Bagaimana cara menggunakan sistem?</h6>
                </a>
                <div class="collapse" id="collapseExample4">
                    <div class="card-body" style="font-size: 14px;">
                        Dalam aplikasi ini menggunakan metode AHP (Analythical Hierarci Process)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>