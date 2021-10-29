@extends('layouts.frontend')

@section('content')
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog mt-5">
        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-8 entries">

                <form action="{{ route('update-pen', $report->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="users_id" value="{{ Auth::user()->id  }}">
                    <input type="hidden" name="types_id" value="{{ $report->types_id }}">
                    <input type="hidden" name="attachment" value="{{ $report->attachment }}">

                    <div class="mb-3">
                      <label for="title" class="form-label">Judul Laporan</label>
                      <input type="text" class="form-control" name="title" value="{{ $report->title }}">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Isi Laporan</label>
                        <textarea class="form-control" name="description" cols="10" rows="10" placeholder="Ketik Isi Laporan Anda">{{ $report->description }}</textarea>
                    </div>

                    @if ($report->date !== null)
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal Kejadian</label>
                            <input type="date" class="form-control" name="date" value="{{ $report->date }}">
                        </div>
                    @endif

                    <div class="mb-3">
                      <label for="location" class="form-label">Lokasi Kejadian</label>
                      <input type="text" class="form-control" name="location" value="{{ $report->location }}">
                    </div>

                    <div class="mb-3">
                        <label for="categories_id" class="form-label">Kategori Laporan</label>
                        <select name="categories_id" class="form-control">
                            <option disabled>-----Edit Kategori-----</option>
                            @foreach($category as $v)
                                <option value="{{ $v->id }}" @if($report->categories_id === $v->id) selected="selected" @endif>{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="radio" value="2" name="privacy"> Anonim
                        <input type="radio" value="3" name="privacy"> Rahasia

                        <button type="submit" class="btn btn-danger float-end">Simpan Perubahan</button>
                    </div>

                  </form>

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

              <div class="sidebar">

                <h3 class="sidebar-title">Search</h3>

                <h3 class="sidebar-title">Categories</h3>

                <h3 class="sidebar-title">Recent Posts</h3>

              </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

          </div>

        </div>
      </section><!-- End Blog Section -->
@endsection
