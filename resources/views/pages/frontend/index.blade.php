@extends('layouts.frontend')

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <div class="row">
            <div class="text-center">
            <h1>Layanan Aspirasi dan Pengaduan Online Rakyat</h1>
            <h2>Sampaikan laporan Anda langsung kepada instansi pemerintah berwenang</h2>
            </div>
        </div>
        </div>

    </section><!-- End Hero -->

    <!-- ======= Statistik Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-3 col-md-6">
              <div class="count-box">
                <i class="bi bi-emoji-smile"></i>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
              <div class="count-box">
                <i class="bi bi-journal-richtext"></i>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="bi bi-headset"></i>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="bi bi-people"></i>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Statistik Section -->

      <!-- ======= Lapor Section ======= -->
      <section id="tabs" class="tabs">
        <div class="container" data-aos="fade-up">

          <ul class="nav nav-tabs row d-flex">
            <li class="nav-item col-4">
              <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                <i class="ri-gps-line"></i>
                <h4 class="d-none d-lg-block">PENGADUAN</h4>
              </a>
            </li>
            <li class="nav-item col-4">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                <i class="ri-body-scan-line"></i>
                <h4 class="d-none d-lg-block">ASPIRASI</h4>
              </a>
            </li>
            <li class="nav-item col-4">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                <i class="ri-sun-line"></i>
                <h4 class="d-none d-lg-block">PERMINTAAN INFORMASI</h4>
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
              <div class="row">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                  <div class="card">

                    <div class="card-body">
                      <h3 class="title card-title text-center">Sampaikan Laporan Anda</h3>
                      <hr>
                      <form action="{{ route('simpanPen') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::check() ? Auth::user()->id : 0  }}">
                        <input type="hidden" name="types_id" value="{{ 1 }}">

                        <div class="mb-3">
                          <label for="title" class="form-label">Judul Laporan</label>
                          <input type="text" class="form-control" name="title" placeholder="Ketik Judul Laporan Anda">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Isi Laporan</label>
                            <textarea class="form-control" name="description" cols="10" rows="10" placeholder="Ketik Isi Laporan Anda"></textarea>
                          </div>

                        <div class="mb-3">
                          <label for="date" class="form-label">Tanggal Kejadian</label>
                          <input type="date" class="form-control" name="date">
                        </div>

                        <div class="mb-3">
                          <label for="location" class="form-label">Lokasi Kejadian</label>
                          <input type="text" class="form-control" name="location" placeholder="Ketik Lokasi Kejadian">
                        </div>

                        <div class="mb-3">
                            <label for="categories_id" class="form-label">Kategori Laporan</label>
                            <select name="categories_id" class="form-control">
                                <option>-----Pilih Kategori Pengaduan Anda-----</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="attachment" class="form-label">Upload Lampiran</label>
                            <p><i>*Boleh dikosongkan</i></p>
                            <input type="file" class="form-control" name="attachment">
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="privacy" value="1">
                            <input type="radio" value="2" name="privacy"> Anonim
                            <input type="radio" value="3" name="privacy"> Rahasia

                            <button type="submit" class="btn btn-danger float-end">Lapor!</button>
                        </div>

                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-2">
              <div class="row">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                  <div class="card">

                    <div class="card-body">
                      <h3 class="title card-title text-center">Sampaikan Laporan Anda</h3>
                      <hr>
                      <form action="{{ route('simpanAsp') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::check() ? Auth::user()->id : 0  }}">
                        <input type="hidden" name="types_id" value="{{ 2 }}">

                        <div class="mb-3">
                          <label for="title" class="form-label">Judul Laporan</label>
                          <input type="text" class="form-control" name="title" placeholder="Ketik Judul Laporan Anda">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Isi Laporan</label>
                            <textarea class="form-control" name="description" cols="10" rows="10" placeholder="Ketik Isi Laporan Anda"></textarea>
                          </div>

                        <div class="mb-3">
                          <label for="location" class="form-label">Asal Pelapor</label>
                          <input type="text" class="form-control" name="location" placeholder="Ketik Asal Pelapor">
                        </div>

                        <div class="mb-3">
                            <label for="categories_id" class="form-label">Kategori Laporan</label>
                            <select name="categories_id" class="form-control">
                                <option>-----Pilih Kategori Pengaduan Anda-----</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="attachment" class="form-label">Upload Lampiran</label>
                            <p><i>*Boleh dikosongkan</i></p>
                            <input type="file" class="form-control" name="attachment">
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="privacy" value="1">
                            <input type="radio" value="2" name="privacy"> Anonim
                            <input type="radio" value="3" name="privacy"> Rahasia

                            <button type="submit" class="btn btn-danger float-end">Lapor!</button>
                        </div>

                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-3">
              <div class="row">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                  <div class="card">

                    <div class="card-body">
                      <h3 class="title card-title text-center">Sampaikan Laporan Anda</h3>
                      <hr>
                      <form action="{{ route('simpanInf') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::check() ? Auth::user()->id : 0  }}">
                        <input type="hidden" name="types_id" value="{{ 3 }}">

                        <div class="mb-3">
                          <label for="title" class="form-label">Judul Laporan</label>
                          <input type="text" class="form-control" name="title" placeholder="Ketik Judul Laporan Anda">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Isi Laporan</label>
                            <textarea class="form-control" name="description" cols="10" rows="10" placeholder="Ketik Isi Laporan Anda"></textarea>
                          </div>

                        <div class="mb-3">
                          <label for="location" class="form-label">Asal Pelapor</label>
                          <input type="text" class="form-control" name="location" placeholder="Ketik Asal Pelapor">
                        </div>

                        <div class="mb-3">
                            <label for="categories_id" class="form-label">Kategori Laporan</label>
                            <select name="categories_id" class="form-control">
                                <option>-----Pilih Kategori Pengaduan Anda-----</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="attachment" class="form-label">Upload Lampiran</label>
                            <p><i>*Boleh dikosongkan</i></p>
                            <input type="file" class="form-control" name="attachment">
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="privacy" value="1">
                            <input type="radio" value="2" name="privacy"> Anonim
                            <input type="radio" value="3" name="privacy"> Rahasia

                            <button type="submit" class="btn btn-danger float-end">Lapor!</button>
                        </div>

                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section><!-- End Lapor Section -->
@endsection
