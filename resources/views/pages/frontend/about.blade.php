@extends('layouts.frontend')

@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title mt-5" style="margin-bottom: -30px;">
                <h2>Tentang SILADI</h2>
            </div>

            <div class="row no-gutters">
                <div class="content col-xl-5 d-flex align-items-stretch">
                    <div class="content">
                        <p>
                            Pengelolaan pengaduan pelayanan publik di setiap organisasi penyelenggara di Indonesia
                            belum terkelola secara efektif dan terintegrasi. Masing-masing organisasi penyelenggara
                            mengelola pengaduan secara parsial dan tidak terkoordinir dengan baik.
                        </p>
                        <p>
                            Akibatnya terjadi
                            duplikasi penanganan pengaduan, atau bahkan bisa terjadi suatu pengaduan tidak ditangani
                            oleh satupun organisasi penyelenggara, dengan alasan pengaduan bukan kewenangannya.
                        </p>
                        <p>
                            Oleh
                            karena itu, untuk mencapai visi dalam good governance maka perlu untuk mengintegrasikan
                            sistem pengelolaan pengaduan pelayanan publik dalam satu pintu. Tujuannya, masyarakat
                            memiliki satu saluran pengaduan secara Nasional.
                        </p>
                    </div>
                </div>
                <div class="col-xl-7 d-flex align-items-stretch">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <h4>Fitur-fitur yang ada dalam SILADI :</h4>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                <i class="bx bx-receipt"></i>
                                <h4>Anonim</h4>
                                <p>Fitur yang bisa dipilih oleh pelapor yang akan membuat identitas pelapor
                                    tidak akan diketahui oleh pihak terlapor dan masyarakat umum.</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                <i class="bx bx-shield"></i>
                                <h4>Rahasia</h4>
                                <p>Seluruh isi laporan tidak dapat dilihat oleh publik.</p>
                            </div>
                            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                <i class="bx bx-cube-alt"></i>
                                <h4>Tracking ID</h4>
                                <p>Nomor unik yang berguna untuk meninjau proses tindak lanjut laporan yang
                                    disampaikan oleh masyarakat
                                </p>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

@endsection
