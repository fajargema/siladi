@extends('layouts.frontend')

@section('content')

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">

        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-8 entries">
                <!-- ======= Lapor Section ======= -->
                <section id="tabs" class="tabs">
                    <div class="container" data-aos="fade-up">

                    <ul class="nav nav-tabs row d-flex">
                        <li class="nav-item col-3">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                            <h4 class="d-lg-block"><strong>Semua</strong></h4>
                        </a>
                        </li>
                        <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                            <h4 class="d-lg-block"><strong>Belum</strong></h4>
                        </a>
                        </li>
                        <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                            <h4 class="d-lg-block"><strong>Proses</strong></h4>
                        </a>
                        </li>
                        <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                            <h4 class="d-lg-block"><strong>Selesai</strong></h4>
                        </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                        <div class="row">
                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                @foreach ($report as $item)
                                <article class="entry">

                                <h2 class="entry-title">
                                    <a href="{{ route('details', $item->slug) }}">{{ $item->title }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                        <a href="{{ route('details', $item->slug) }}">
                                            {{ $item->user->name }}
                                        </a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('details', $item->slug) }}"><time
                                            datetime="{{ $fdate }}">{{ $fdate }}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-upc-scan"></i>
                                        <a href="{{ route('details', $item->slug) }}">
                                            {{ $item->kode }}
                                        </a>
                                    </li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        {!! Str::limit($item->description, 70, '...'); !!}
                                    </p>
                                    <div class="read-more">
                                        <form class="inline-block mb-2" action="{{ route('delete-pen', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                    Hapus
                                            </button>
                                        </form>
                                        <a href="{{ route('edit-pen', $item->id) }}">Edit</a>
                                        <a href="{{ route('details', $item->slug) }}">Detail</a>
                                    </div>
                                </div>

                                </article>
                                @endforeach

                                <div class="blog-pagination">
                                <ul class="justify-content-center">
                                    {{ $report->onEachSide(5)->links() }}
                                </ul>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="tab-pane" id="tab-2">
                        <div class="row">
                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                @foreach ($wait as $item)
                                <article class="entry">

                                <!-- <div class="entry-img">
                                    <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                </div> -->

                                <h2 class="entry-title">
                                    <a href="{{ route('details', $item->slug) }}">{{ $item->title }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                        <a href="{{ route('details', $item->slug) }}">
                                            {{ $item->user->name }}
                                        </a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('details', $item->slug) }}"><time
                                            datetime="{{ $fdate }}">{{ $fdate }}</time></a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-upc-scan"></i>
                                        <a href="{{ route('details', $item->slug) }}">
                                            {{ $item->kode }}
                                        </a>
                                    </li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        {!! Str::limit($item->description, 70, '...'); !!}
                                    </p>
                                    <div class="read-more">
                                        <form class="inline-block mb-2" action="{{ route('delete-pen', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                    Hapus
                                            </button>
                                        </form>
                                        <a href="{{ route('edit-pen', $item->id) }}">Edit</a>
                                        <a href="{{ route('details', $item->slug) }}">Detail</a>
                                    </div>
                                </div>

                                </article>
                                @endforeach

                                <div class="blog-pagination">
                                <ul class="justify-content-center">
                                    {{ $report->onEachSide(5)->links() }}
                                </ul>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="tab-pane" id="tab-3">
                            <div class="row">
                                <div class="container" data-aos="fade-up" data-aos-delay="100">
                                    @foreach ($process as $item)
                                    <article class="entry">

                                    <!-- <div class="entry-img">
                                        <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                    </div> -->

                                    <h2 class="entry-title">
                                        <a href="{{ route('details', $item->slug) }}">{{ $item->title }}</a>
                                    </h2>

                                    <div class="entry-meta">
                                        <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                            <a href="{{ route('details', $item->slug) }}">
                                                {{ $item->user->name }}
                                            </a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('details', $item->slug) }}"><time
                                                datetime="{{ $fdate }}">{{ $fdate }}</time></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-upc-scan"></i>
                                            <a href="{{ route('details', $item->slug) }}">
                                                {{ $item->kode }}
                                            </a>
                                        </li>
                                        </ul>
                                    </div>

                                    <div class="entry-content">
                                        <p>
                                            {!! Str::limit($item->description, 70, '...'); !!}
                                        </p>
                                        <div class="read-more">
                                            <form class="inline-block mb-2" action="{{ route('delete-pen', $item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                        Hapus
                                                </button>
                                            </form>
                                            <a href="{{ route('edit-pen', $item->id) }}">Edit</a>
                                            <a href="{{ route('details', $item->slug) }}">Detail</a>
                                        </div>
                                    </div>

                                    </article>
                                    @endforeach

                                    <div class="blog-pagination">
                                    <ul class="justify-content-center">
                                        {{ $report->onEachSide(5)->links() }}
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-4">
                            <div class="row">
                                <div class="container" data-aos="fade-up" data-aos-delay="100">
                                    @foreach ($done as $item)
                                    <article class="entry">

                                    <!-- <div class="entry-img">
                                        <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                    </div> -->

                                    <h2 class="entry-title">
                                        <a href="{{ route('details', $item->slug) }}">{{ $item->title }}</a>
                                    </h2>

                                    <div class="entry-meta">
                                        <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                            <a href="{{ route('details', $item->slug) }}">
                                                {{ $item->user->name }}
                                            </a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('details', $item->slug) }}"><time
                                                datetime="{{ $fdate }}">{{ $fdate }}</time></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-upc-scan"></i>
                                            <a href="{{ route('details', $item->slug) }}">
                                                {{ $item->kode }}
                                            </a>
                                        </li>
                                        </ul>
                                    </div>

                                    <div class="entry-content">
                                        <p>
                                            {!! Str::limit($item->description, 70, '...'); !!}
                                        </p>
                                        <div class="read-more">
                                            <form class="inline-block mb-2" action="{{ route('delete-pen', $item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                        Hapus
                                                </button>
                                            </form>
                                            <a href="{{ route('edit-pen', $item->id) }}">Edit</a>
                                            <a href="{{ route('details', $item->slug) }}">Detail</a>
                                        </div>
                                    </div>

                                    </article>
                                    @endforeach

                                    <div class="blog-pagination">
                                    <ul class="justify-content-center">
                                        {{ $report->onEachSide(5)->links() }}
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>
                </section><!-- End Lapor Section -->

            </div><!-- End blog entries list -->

            <div class="col-lg-4 mt-5">

              <div class="sidebar">

                <h3 class="sidebar-title">Search</h3>
                <div class="sidebar-item search-form">
                  <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="search">
                    <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
                </div><!-- End sidebar search formn-->

                <h3 class="sidebar-title">Categories</h3>
                <div class="sidebar-item categories">
                  <ul>
                    @foreach ($categories as $cat)
                        <li><a href="{{ route('category', $cat->id) }}">{{ $cat->name }}
                             {{-- <span>(25)</span> --}}
                        </a></li>
                    @endforeach
                  </ul>
                </div><!-- End sidebar categories-->

                <h3 class="sidebar-title">Recent Posts</h3>
                <div class="sidebar-item recent-posts">

                  @foreach ($recent as $item)
                  <div class="post-item">
                    <h4><a href="{{ route('details', $item->slug) }}">{{ $item->title }}</a></h4>
                    <time datetime="{{ $fdate }}">{{ $fdate }}</time>
                  </div>
                  @endforeach

                </div>

              </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

          </div>

        </div>
      </section><!-- End Blog Section -->
@endsection
