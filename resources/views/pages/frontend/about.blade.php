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

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
            </div>

            <ul class="faq-list accordion" data-aos="fade-up">

                <li>
                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq1">Non consectetur a erat nam
                        at lectus
                        urna duis? <i class="bx bx-chevron-down icon-show"></i><i
                            class="bx bx-x icon-close"></i></a>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non
                            curabitur
                            gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq2" class="collapsed">Feugiat scelerisque varius
                        morbi enim
                        nunc faucibus a pellentesque? <i class="bx bx-chevron-down icon-show"></i><i
                            class="bx bx-x icon-close"></i></a>
                    <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                            velit laoreet id
                            donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est
                            pellentesque elit
                            ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq3" class="collapsed">Dolor sit amet consectetur
                        adipiscing
                        elit pellentesque habitant morbi? <i class="bx bx-chevron-down icon-show"></i><i
                            class="bx bx-x icon-close"></i></a>
                    <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                            pulvinar elementum
                            integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque
                            eu tincidunt.
                            Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed
                            odio morbi quis
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq4" class="collapsed">Ac odio tempor orci
                        dapibus. Aliquam
                        eleifend mi in nulla? <i class="bx bx-chevron-down icon-show"></i><i
                            class="bx bx-x icon-close"></i></a>
                    <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                            velit laoreet id
                            donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est
                            pellentesque elit
                            ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq5" class="collapsed">Tempus quam pellentesque
                        nec nam
                        aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i
                            class="bx bx-x icon-close"></i></a>
                    <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est
                            ante in. Nunc
                            vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum
                            est. Purus
                            gravida quis blandit turpis cursus in
                        </p>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" data-bs-target="#faq6" class="collapsed">Tortor vitae purus
                        faucibus ornare.
                        Varius vel pharetra vel turpis nunc eget lorem dolor? <i
                            class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
                    <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo
                            integer malesuada
                            nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed.
                            Ut venenatis
                            tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas
                            egestas
                            fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
                        </p>
                    </div>
                </li>

            </ul>

        </div>
    </section><!-- End Frequently Asked Questions Section -->
@endsection
