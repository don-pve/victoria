@extends('layouts.app')
@section('content')
  @include('components.front-header')

  <main class="main">
    @php
      $blog_data = $data['blog_data'];
      $recent_blogs = $data['recent_blogs'];
    @endphp
    <!-- Page Title -->
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">{{ optional($blog_data)->blog_title ?? '' }}</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container" data-aos="fade-up">


        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8" data-aos="fade-up">
            <div class="service-main-image aos-init aos-animate mb-5" data-aos="zoom-in" data-aos-delay="200">
              <img src="{{ asset('img/blog-images/' . $blog_data->blog_img) }}" alt="" class="img-fluid rounded-4">
            </div>
            <div class="portfolio-description">
              <h2>{{ optional($blog_data)->blog_title ?? '' }}</h2>
              <p>
                {{ optional($blog_data)->blog_content ?? '' }}
              </p>

            </div>
          </div>

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="portfolio-info">
              <h3>Recent Blogs </h3>
              <ul>
                @isset($recent_blogs)
                  @foreach($recent_blogs as $blogs)
                    <li><a href="{{ url('/blog').'/'.$blogs->id }}">{{$blogs->blog_title}}</a></li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

  </main>

@endsection
@section('custom-scripts')
@endsection
