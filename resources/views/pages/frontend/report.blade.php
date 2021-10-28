@extends('layouts.frontend')

@section('content')
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog mt-5">
        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-8 entries">

              @foreach ($reports as $item)
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
                            @if ($item->privacy == 1)
                                {{ $item->user->name }}
                            @elseif ($item->privacy == 2)
                                {{ $result = substr($item->user->name, 0, 1) . preg_replace('/[^@]/', '*', substr($item->user->name, 1)) }}
                            @endif
                        </a>
                    </li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('details', $item->slug) }}"><time
                          datetime="{{ $fdate }}">{{ $fdate }}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i>
                        <a href="{{ route('details', $item->slug) }}">
                            {{ $total }} Comments
                        </a>
                    </li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    {{ $item->description }}
                  </p>
                  <div class="read-more">
                    <a href="{{ route('details', $item->slug) }}">Read More</a>
                  </div>
                </div>

              </article>
              @endforeach

              <div class="blog-pagination">
                <ul class="justify-content-center">
                    {{ $reports->onEachSide(5)->links() }}
                </ul>
              </div>

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

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
                        <li><a href="#">{{ $cat->name }}
                             {{-- <span>(25)</span> --}}
                        </a></li>
                    @endforeach
                  </ul>
                </div><!-- End sidebar categories-->

                <h3 class="sidebar-title">Recent Posts</h3>
                <div class="sidebar-item recent-posts">

                  @foreach ($reports as $item)
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
