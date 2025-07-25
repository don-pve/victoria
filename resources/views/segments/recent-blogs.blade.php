<section id="call-to-action-2" class="call-to-action-2 section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Recent Blogs</h2>
    <p>Catch up on the newest fishing stories, tips, and spotlights from across Victoria...</p>
  </div>
  
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-5 justify-content-center">
      
      {{-- First Blog Highlight --}}
      @php
        $featured_blogs = $data['featured_blogs']; 
      @endphp
      @if($featured_blogs->isNotEmpty())
        @php
          $firstBlog = $featured_blogs->first();
        @endphp
        <div class="col-lg-12">
          <div class="choose-card-2 lazy-bg loaded" style="background-image: url('{{ asset('img/blog-images/' . $firstBlog->blog_img) }}');">
            <div class="text-content">
              <h3 class="blog-title">{{ $firstBlog->blog_title }}</h3>
              <p class="blog-description">{{ $firstBlog->blog_sub_description }}</p>
              <a href="{{ url('blog/' . $firstBlog->id) }}" class="btn btn-info" style="background-color:#5d57f4; color:#fff;">Read More!</a>
            </div>
          </div>
        </div>
      @endif

      {{-- Remaining Blogs --}}
      @foreach($featured_blogs->skip(1) as $blog)
        <div class="col-lg-6">
          <div class="choose-card-2 lazy-bg loaded" style="background-image: url('{{ asset('img/blog-images/' . $blog->blog_img) }}');">
            <div class="text-content">
              <h3 class="blog-title">{{ $blog->blog_title }}</h3>
              <p class="blog-description">{{ $blog->blog_sub_description }}</p>
              <a href="{{ url('blog/' . $blog->id) }}" class="btn btn-light" style="background-color:#5d57f4; color:#fff;">Read More!</a>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>