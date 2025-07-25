<!-- Featured Posts Section -->
    <section id="featured-posts" class="featured-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Fishing Spots</h2>
        <div>Discover some of the best fishing locations across Victoria—from bustling bays and quiet estuaries to inland lakes and urban rivers. Each spot offers unique species, techniques, and local tips to help you make the most of your time on the water.</div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="blog-posts-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 800,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 3,
              "spaceBetween": 30,
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 20
                },
                "768": {
                  "slidesPerView": 2,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 30
                }
              }
            }
          </script>

          @php
            $fishing_spots = $data['fishing_spots'];
          @endphp
          
          <div class="swiper-wrapper">
            @isset($fishing_spots)
              @foreach($fishing_spots as $spots)
                <div class="swiper-slide">
                  <div class="blog-post-item">
                    <img src="{{ asset('img/fishing-spots-images/'. $spots->spot_img) }}" alt="Fishing Spot Image">
                    <div class="blog-post-content">
                      {{-- <div class="post-meta">
                        <span><i class="bi bi-person"></i> Julia Parker</span>
                        <span><i class="bi bi-clock"></i> Jan 15, 2025</span>
                        <span><i class="bi bi-chat-dots"></i> 6 Comments</span>
                      </div> --}}
                      <h2><a href="#">{{$spots->fishing_spot}}</a></h2>
                      <p>{{$spots->fishing_description}}</p>
                      <a href="#" class="read-more">View Fishing Spot <i class="bi bi-arrow-right"></i></a>
                    </div>
                  </div>
                </div><!-- End slide item -->
              @endforeach
            @endif
          </div>

        </div>

      </div>

    </section><!-- /Featured Posts Section -->