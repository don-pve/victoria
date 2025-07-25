<section id="portfolio" class="portfolio section">
  <div class="container section-title" data-aos="fade-up">
    <h2>More From Our Blogs</h2>
    <p>Dive deeper into our collection of fishing insights, tips, and stories across Victoria. There's always more to explore from our blog archive.</p>
  </div>

  <div class="container">
    <div class="row">
      @php
        $recent_blogs = $data['recent_blogs'];
      @endphp
      @foreach($recent_blogs as $blog)
        <div class="col-lg-12">
          <div class="blog-wrapper mb-5" onclick="">
            <div class="row">
              <div class="col-lg-3">
                <img
                  loading="lazy"
                  alt="{{ $blog->blog_title }}"
                  src="{{ asset('img/blog-images/' . $blog->blog_img) }}"
                  data-src="{{ asset('img/blog-images/' . $blog->blog_img) }}"
                  class="img-responsive wp-post-image lzl lozad lazy-blur w-100"
                >
              </div>
              <div class="col-lg-9">
                <div class="time-wrapper">
                  <small>
                    <time datetime="{{ \Carbon\Carbon::parse($blog->blog_created_at)->format('Y-m-d') }}">
                      {{ \Carbon\Carbon::parse($blog->blog_created_at)->format('d M, Y') }}
                    </time>
                  </small>
                  <a href="{{ url('blog/' . $blog->id ?? '#') }}" class="blog-title">
                    {{ $blog->blog_title }}
                  </a>
                  <p class="blog-text w-75">{{ $blog->blog_sub_description }}</p>
                </div>
                <a href="{{ url('blog/' . $blog->id ?? '#') }}" class="btn btn-info blog-readmore" style="background-color:#5d57f4; color:#fff;">Read More!</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>