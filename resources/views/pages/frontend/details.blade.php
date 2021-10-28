@extends('layouts.frontend')

@section('content')
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog mt-5">
        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-8 entries">

              <article class="entry entry-single">

                <h2 class="entry-title">
                  <a href="blog-single.html">{{ $report->title }}</a>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $report->user->name }}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="{{ $fdate }}">{{ $fdate }}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">{{ $total }} Comments</a></li>
                  </ul>
                </div>

                <div class="entry-content">
                  <p>
                    {{ $report->description }}
                  </p>

                </div>

              </article><!-- End blog entry -->

              <div class="blog-comments">

                <h4 class="comments-count">{{ $total }} Comments</h4>

                @foreach ($comment as $com)
                <div id="comment-1" class="comment">
                    <div class="d-flex">
                      <div class="comment-img"><img src="{{ asset('frontend/img/male-100.png') }}" alt="User Image"></div>
                      <div>
                        <h5><a href="">{{ $com->user->name }}</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                        <time datetime="{{ $com->created_at }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $com->created_at }}">{{ Carbon\Carbon::parse($com->created_at)->diffForHumans() }}</time>
                        <p>
                          {{ $com->body }}
                        </p>
                      </div>
                    </div>
                  </div>
                @endforeach

                <div class="reply-form">
                  <h4>Leave a Reply</h4>
                  <form action="{{ route('comment') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="reports_id" value="{{ $report->id }}">
                      <div class="col form-group">
                        <textarea name="body" class="form-control" placeholder="Ketik komen Anda"></textarea>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>

                  </form>

                </div>

              </div><!-- End blog comments -->

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

              <div class="sidebar">

                <h3 class="sidebar-title">Search</h3>
                <div class="sidebar-item search-form">
                  <form action="">
                    <input type="text">
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
      </section><!-- End Blog Single Section -->
@endsection
