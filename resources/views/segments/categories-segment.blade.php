<section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Categories</h2>
        <p>Dive into topics that match your fishing style and goals.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @php
          $recent_species_blogs = $data['recent_species_blogs'];
          $recent_fishing_calendar_blogs = $data['recent_fishing_calendar_blogs'];
          $recent_tips_blogs = $data['recent_tips_blogs'];
          $recent_gear_blogs = $data['recent_gear_blogs'];
        @endphp
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="portfolio-filters-container" data-aos="fade-up" data-aos-delay="200">
            <ul class="portfolio-filters isotope-filters">
              <li data-filter="*" class="filter-active">All Recent Blogs</li>
              <li data-filter=".filter-species-guide">Species Guide</li>
              <li data-filter=".filter-fishing-calendar">Seasonal Fishing Calendar</li>
              <li data-filter=".filter-tips">Tips & Techniques</li>
              <li data-filter=".filter-gear-reviews">Gear Reviews</li>
            </ul>
          </div>

          <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

            {{-- For species guide category --}}
            @isset($recent_species_blogs)
              @foreach($recent_species_blogs as $recent_species)
                <div class="col-lg-6 col-md-6 mt-5 portfolio-item isotope-item filter-{{$recent_species->category_slug}}">
                  <div class="portfolio-card">
                    <div class="portfolio-image">
                      <img src="{{ asset('img/blog-images/' . $recent_species->blog_img) }}" class="img-fluid" alt="" loading="lazy">
                      <div class="portfolio-overlay">
                        <div class="portfolio-actions">
                          {{-- <a href="{{ asset('img/blog-images/' . $recent_species->blog_img) }}" class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a> --}}
                          <a href="portfolio-details.html" class="details-link"><i class="bi bi-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="portfolio-content">
                      <span class="category">{{$recent_species->category_title}}</span>
                      <h3>{{$recent_species->blog_title}}</h3>
                      <p>{{$recent_species->blog_sub_description}}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

            {{-- For calendar guide category --}}
            @isset($recent_fishing_calendar_blogs)
              @foreach($recent_fishing_calendar_blogs as $recent_calendar)
                <div class="col-lg-6 col-md-6 mt-5 portfolio-item isotope-item filter-{{$recent_calendar->category_slug}}">
                  <div class="portfolio-card">
                    <div class="portfolio-image">
                      <img src="{{ asset('img/blog-images/' . $recent_calendar->blog_img) }}" class="img-fluid" alt="" loading="lazy">
                      <div class="portfolio-overlay">
                        <div class="portfolio-actions">
                          {{-- <a href="{{ asset('img/blog-images/' . $recent_calendar->blog_img) }}" class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a> --}}
                          <a href="portfolio-details.html" class="details-link"><i class="bi bi-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="portfolio-content">
                      <span class="category">{{$recent_calendar->category_title}}</span>
                      <h3>{{$recent_calendar->blog_title}}</h3>
                      <p>{{$recent_calendar->blog_sub_description}}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

            {{-- For tips and technique category --}}
            @isset($recent_tips_blogs)
              @foreach($recent_tips_blogs as $recent_tips)
                <div class="col-lg-6 col-md-6 mt-5 portfolio-item isotope-item filter-{{$recent_tips->category_slug}}">
                  <div class="portfolio-card">
                    <div class="portfolio-image">
                      <img src="{{ asset('img/blog-images/' . $recent_tips->blog_img) }}" class="img-fluid" alt="" loading="lazy">
                      <div class="portfolio-overlay">
                        <div class="portfolio-actions">
                          {{-- <a href="{{ asset('img/blog-images/' . $recent_tips->blog_img) }}" class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a> --}}
                          <a href="portfolio-details.html" class="details-link"><i class="bi bi-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="portfolio-content">
                      <span class="category">{{$recent_tips->category_title}}</span>
                      <h3>{{$recent_tips->blog_title}}</h3>
                      <p>{{$recent_tips->blog_sub_description}}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

            {{-- For Gears and reviews category --}}
            @isset($recent_gear_blogs)
              @foreach($recent_gear_blogs as $recent_gear)
                <div class="col-lg-6 col-md-6 mt-5 portfolio-item isotope-item filter-{{$recent_gear->category_slug}}">
                  <div class="portfolio-card">
                    <div class="portfolio-image">
                      <img src="{{ asset('img/blog-images/' . $recent_gear->blog_img) }}" class="img-fluid" alt="" loading="lazy">
                      <div class="portfolio-overlay">
                        <div class="portfolio-actions">
                          {{-- <a href="{{ asset('img/blog-images/' . $recent_gear->blog_img) }}" class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a> --}}
                          <a href="portfolio-details.html" class="details-link"><i class="bi bi-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="portfolio-content">
                      <span class="category">{{$recent_gear->category_title}}</span>
                      <h3>{{$recent_gear->blog_title}}</h3>
                      <p>{{$recent_gear->blog_sub_description}}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->