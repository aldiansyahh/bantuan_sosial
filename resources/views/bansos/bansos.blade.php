@extends('bansos.master')

@section('content')
    <div class="w-min mt-4">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 text-left">
                        <h1 class="m-0">Klasifikasi Kelayakan Penerima Bantuan Sosial Pada Tahun 2024</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <p>Total Keluarga</p>
                                <h1>{{ $totalKeluarga }}</h1>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users-cog" style="color: white"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-target="#semuaModal"
                                onclick="changeChart('semuakk')">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- Total Layak -->
                    <div class="col-12 col-md-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <p>Total Layak</p>
                                <h1>{{ $totalLayak }}</h1>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle" style="color: white"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-target="#layakModal"
                                onclick="changeChart('layak')">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Tidak Layak -->
                    <div class="col-12 col-md-4">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <p>Total Tidak Layak</p>
                                <h1>{{ $totalTidakLayak }}</h1>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle" style="color: white"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-target="#tidakLayakModal"
                                onclick="changeChart('tidakLayak')">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Chart Section -->
                    <div class="row ">
                        <section class="w-min ">
                            <div class="card ">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0 d-flex align-items-center">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Jumlah Kepala Keluarga Setiap RW
                                    </h3>
                                    <div class="ml-auto">
                                        <a href="#" class="btn btn-secondary btn-sm" data-target="#semuakModal"
                                            onclick="changeChart('semua')">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>



                                <div class="card-body w-min ">
                                    <div class="tab-content">
                                        <div class="chart tab-pane active " id="revenue-chart">
                                            <!-- Canvas untuk diagram batang -->
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="d-flex justify-content-center w-50">
                                                    <canvas id="rwChart"></canvas>
                                                </div>
                                                <div class="d-flex">
                                                    <p id="description" class="mt-4"></p>
                                                </div>
                                                <div class="landingpages" onclick="changeChart('landingpages')"
                                                    id="initialDescription" id="initialDescription">

                                                </div>
                                                <div class="container mt-4">
                                                    <button id="toggleTable" class="btn btn-primary">Data Keluarga</button>

                                                    <div class="table-responsive mt-3" id="table-container"
                                                        style="display: none;">
                                                        <table class="table table-bordered table-hover text-center">
                                                            <thead class="table-secondary">
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama</th>
                                                                    <th>RW</th>
                                                                    <th>Penghasilan</th>
                                                                    <th>Status Bangunan</th>
                                                                    <th>Jumlah Kendaraan</th>
                                                                    <th>Jumlah Tanggungan</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table-body">
                                                                @if ($kepala_keluarga->count() > 0)
                                                                    @foreach ($kepala_keluarga as $item)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $item->nama }}</td>
                                                                            <td>{{ $item->rw }}</td>
                                                                            <td>Rp
                                                                                {{ number_format($item->penghasilan, 0, ',', '.') }}
                                                                            </td>
                                                                            <td>{{ $item->status_bangunan }}</td>
                                                                            <td>{{ $item->jumlah_kendaraan }}</td>
                                                                            <td>{{ $item->jumlah_tanggungan }}</td>
                                                                            <td>
                                                                                <span
                                                                                    class="badge bg-{{ $item->keterangan == 'Layak' ? 'success' : 'danger' }}">
                                                                                    {{ $item->keterangan }}
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="8" class="text-center text-muted">
                                                                            Tidak ada data</td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                    <!-- Tambahkan jQuery sebelum script -->
                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                    <script></script>

                                                </div>
                                            </div>
                                        </div>


                                        <!-- Deskripsi Dinamis -->

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
        </section>
    </div>
@endsection




<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Memanggil changeChart saat halaman dimuat
        changeChart('landingpages'); // Menggunakan parameter 'semua' sebagai contoh
    });

    var chart; // Inisialisasi chart secara global
    function changeChart(type) {
        // Jika chart sudah ada, hancurkan terlebih dahulu
        if (chart) {
            chart.destroy();
        }

        var ctx = document.getElementById('rwChart').getContext('2d'); // Canvas chart
        var description = document.getElementById('description');
        var initialDescription = document.getElementById('initialDescription'); // Elemen deskripsi awal
        var tableContainer = document.getElementById('table-container'); // Kontainer untuk tabel

        // Menyembunyikan deskripsi awal ketika memilih chart
        initialDescription.style.display = 'none';

        // Menyembunyikan tabel sebelumnya jika ada
        tableContainer.style.display = 'none';

        // Data untuk diagram batang (diambil dari server)
        var dataKepalaKeluarga = @json($dataKepalaKeluarga);
        var kepala_keluarga = @json($kepala_keluarga);

        // Siapkan variabel untuk data yang akan ditampilkan
        var labels = [];
        var layakData = [];
        var tidakLayakData = [];
        var totalData = [];
        var tableRows = [];
        var total = 0,
            layak = 0,
            tidakLayak = 0;

        // Isi data sesuai dengan tipe chart yang dipilih
        if (type === 'layak') {
            $(document).ready(function() {
                $("#table-container").hide(); // Awalnya tabel disembunyikan

                $("#toggleTable").click(function() {
                    $("#table-container").show(); // Toggle hide/show tanpa perlu if-else
                });


            });


            dataKepalaKeluarga.forEach(function(item) {
                labels.push(item.rw);
                layakData.push(item.layak);


            });
            let nomorUrut = 1;
            kepala_keluarga.forEach(function(item) {
                if (item.keterangan === 'Layak') {

                    tableRows.push(
                        `<tr><td>${nomorUrut++}</td>
                <td>${item.nama}</td>
                <td>${item.rw}</td>
                <td>${item.penghasilan}</td>
                <td>${item.status_bangunan}</td>
                <td>${item.jumlah_kendaraan}</td>
                <td>${item.jumlah_tanggungan}</td>
                <td>${item.keterangan}</td>
            </tr>`

                    );
                }
                layak += item.layak;
            });

            description.innerHTML =
                "<h2>Rw 3 memiliki jumlah keluarga terbanyak yaitu berjumlah 27 keluarga, sedangkan Rw 6,8 memiliki jumlah keluarga yang layak mendapat bantuan sosial paling sedikit berjumlah 15 keluarga.</h2>";
            chart = new Chart(ctx, {
                type: 'bar', // Tipe chart batang
                data: {
                    labels: labels, // Label RW
                    datasets: [{
                        label: 'Layak',
                        data: layakData,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)', // Warna hijau
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kepala Keluarga Berdasarkan RW'
                        }
                    }
                }
            });

            // Menampilkan tabel yang relevan sesuai dengan jenis chart yang dipilih
            tableContainer.style.display = 'block';

            // Menyisipkan baris tabel ke dalam tabel
            document.getElementById('table-body').innerHTML = tableRows.join('');
        } else if (type === 'tidakLayak') {
            $(document).ready(function() {
                $("#table-container")
                    .hide(); // Pastikan tabel tersembunyi saat halaman pertama kali dimuat

                $("#toggleTable").click(function() {
                    $("#table-container").show(); // Efek muncul / menghilang

                });

            });
            dataKepalaKeluarga.forEach(function(item) {
                labels.push(item.rw);
                tidakLayakData.push(item.tidak_layak);
            });
            let nomorUrut = 1;
            kepala_keluarga.forEach(function(item) {
                if (item.keterangan === 'Tidak Layak') {
                    tableRows.push(
                        `<tr><td>${nomorUrut++}</td>
                <td>${item.nama}</td>
                <td>${item.rw}</td>
                <td>${item.penghasilan}</td>
                <td>${item.status_bangunan}</td>
                <td>${item.jumlah_kendaraan}</td>
                <td>${item.jumlah_tanggungan}</td>
                <td>${item.keterangan}</td>
            </tr>`
                    );
                }
                tidakLayak += item.tidak_layak;
            });

            description.innerHTML =
                "<h2>Rw 5 memiliki jumlah keluarga yang Tidak Layak mendapat bantuan sosial terbanyak yaitu berjumlah 28 keluarga, sedangkan Rw 10 memiliki jumlah keluarga yang Tidak Layak mendapat bantuan sosial paling sedikit berjumlah 16 keluarga.</h2>";
            chart = new Chart(ctx, {
                type: 'bar', // Tipe chart batang
                data: {
                    labels: labels, // Label RW
                    datasets: [{
                        label: 'Tidak Layak',
                        data: tidakLayakData,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna merah
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kepala Keluarga Berdasarkan RW'
                        }
                    }
                }
            });

            // Menampilkan tabel yang relevan sesuai dengan jenis chart yang dipilih
            tableContainer.style.display = 'block';

            // Menyisipkan baris tabel ke dalam tabel
            document.getElementById('table-body').innerHTML = tableRows.join('');
        } else if (type === 'semua') {
            $(document).ready(function() {
                $("#table-container")
                    .hide(); // Pastikan tabel tersembunyi saat halaman pertama kali dimuat

                $("#toggleTable").click(function() {
                    $("#table-container").show();

                });

            });
            dataKepalaKeluarga.forEach(function(item) {
                labels.push(item.rw);
                layakData.push(item.layak);
                tidakLayakData.push(item.tidak_layak);
            });
            let nomorUrut = 1;
            kepala_keluarga.forEach(function(item) {
                tableRows.push(
                    `<tr><td>${nomorUrut++}</td>
            <td>${item.nama}</td>
            <td>${item.rw}</td>
            <td>${item.penghasilan}</td>
            <td>${item.status_bangunan}</td>
            <td>${item.jumlah_kendaraan}</td>
            <td>${item.jumlah_tanggungan}</td>
            <td>${item.keterangan}</td>
        </tr>`
                );
                layak += item.layak;
                tidakLayak += item.tidak_layak;
            });

            description.innerHTML =
                "<h2>Rw 3 memiliki jumlah keluarga yang layak mendapat bantuan sosial terbanyak yaitu berjumlah 25 keluarga Dan Rw 5 memiliki jumlah keluarga yang Tidak Layak mendapat bantuan sosial paling banyak berjumlah 28 keluarga.</h2>";
            chart = new Chart(ctx, {
                type: 'bar', // Tipe chart batang
                data: {
                    labels: labels, // Label RW
                    datasets: [{
                            label: 'Layak',
                            data: layakData,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Warna hijau
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Tidak Layak',
                            data: tidakLayakData,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna merah
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kepala Keluarga Berdasarkan RW'
                        }
                    }
                }
            });

            // Menampilkan tabel yang relevan sesuai dengan jenis chart yang dipilih
            tableContainer.style.display = 'block';

            // Menyisipkan baris tabel ke dalam tabel
            document.getElementById('table-body').innerHTML = tableRows.join('');
        } else if (type === 'semuakk') {
            $(document).ready(function() {
                $("#table-container")
                    .hide(); // Pastikan tabel tersembunyi saat halaman pertama kali dimuat

                $("#toggleTable").click(function() {
                    $("#table-container").show(); // Efek muncul / menghilang

                });

            });

            dataKepalaKeluarga.forEach(function(item) {
                labels.push(item.rw);
                totalData.push(item.total);
            });
            let nomorUrut = 1;
            kepala_keluarga.forEach(function(item) {
                tableRows.push(
                    `<tr><td>${nomorUrut++}</td>
            <td>${item.nama}</td>
            <td>${item.rw}</td>
            <td>${item.penghasilan}</td>
            <td>${item.status_bangunan}</td>
            <td>${item.jumlah_kendaraan}</td>
            <td>${item.jumlah_tanggungan}</td>
            <td>${item.keterangan}</td>
        </tr>`
                );
                layak += item.layak;
                tidakLayak += item.tidak_layak;
            });

            description.innerHTML =
                "<h2>Berdasarkan hasil klasifikasi yang dilakukan menggunakan algoritma K-Means, data penerima bantuan sosial menunjukkan bahwa RW 1, RW 2, dan RW 3 menyumbang jumlah keluarga terbanyak, yaitu sebanyak 44 Keluarga. sedangkan rw 7 menyumbang jumlah keluarga paling dikit yang berjumlah 33 Keluarga untuk mendapatkan penerimaan bantuan sosial.</h2>";
            chart = new Chart(ctx, {
                type: 'bar', // Tipe chart batang
                data: {
                    labels: labels, // Label RW
                    datasets: [{
                        label: 'Total',
                        data: totalData,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna biru
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kepala Keluarga Berdasarkan RW'
                        }
                    }
                }
            });

            // Menampilkan tabel yang relevan sesuai dengan jenis chart yang dipilih
            tableContainer.style.display = 'block';

            // Menyisipkan baris tabel ke dalam tabel
            document.getElementById('table-body').innerHTML = tableRows.join('');
        } else if (type === 'landingpages') {
            $(document).ready(function() {
                $("#table-container")
                    .hide(); // Pastikan tabel tersembunyi saat halaman pertama kali dimuat

                $("#toggleTable").click(function() {
                    $("#table-container").show(); // Efek muncul / menghilang

                });

            });
            dataKepalaKeluarga.forEach(function(item) {
                labels.push(item.rw);

                layakData.push(item.layak);
                tidakLayakData.push(item.tidak_layak)
                totalData.push(item.total);
            });
            let nomorUrut = 1;
            kepala_keluarga.forEach(function(item) {
                tableRows.push(
                    `<tr><td>${nomorUrut++}</td>
                        <td>${item.nama }</td>
                        <td>${item.rw }</td>
                        <td>${item.penghasilan }</td>
                        <td>${item.status_bangunan }</td>
                        <td>${item.jumlah_kendaraan }</td>
                        <td>${item.jumlah_tanggungan }</td>
                        <td>${item.keterangan }</td>
                    </tr>`
                );
                layak += item.layak;
                tidakLayak += item.tidak_layak;
            });
            description.innerHTML =
                "<h2>Diagram batang ini menampilkan perbandingan yang layak dan tidak layak dari keseluruhan jumlah kepala keluarga di setiap RW.</h2>";
            chart = new Chart(ctx, {
                type: 'bar', // Tipe chart batang
                data: {
                    labels: labels, // Label RW
                    datasets: [{
                            label: 'Total',
                            data: totalData,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna biru
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Layak',
                            data: layakData,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Warna hijau
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Tidak Layak',
                            data: tidakLayakData,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna merah
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kepala Keluarga Berdasarkan RW'
                        }
                    }
                }
            });

            // Menampilkan tabel yang relevan sesuai dengan jenis chart yang dipilih
            tableContainer.style.display = 'block';

            // Menyisipkan baris tabel ke dalam tabel
            document.getElementById('table-body').innerHTML = tableRows.join('');
        }


        // Buat diagram batang baru dengan data yang sesuai

    }
</script>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
