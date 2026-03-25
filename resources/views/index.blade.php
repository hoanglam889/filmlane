@include('partials.header')

    <section class="hero">
      <div class="main">
        <div class="content">
          <p>FilmLane</p>
          <h1>By <strong>Lamlyy</strong></h1>
          <div class="meta-wrapper">
            <div class="badge">
              <span>Miễn phí</span>
              <span>HD</span>
            </div>
            <div class="genre">
              <span><a href="">Đầy đủ thể loại, </a> <a href="">không quảng cáo</a></span>
            </div>
            <div class="date-time">
              <span><i class="fa-solid fa-calendar-days"></i> 2026</span>
              <!-- <span><i class="fa-regular fa-clock"></i> 128 min</span> -->
            </div>
          </div>
          <!-- <div class="watch-btn">
            <button><i class="fa-solid fa-play"></i> Watch Now</button>
          </div> -->
        </div>
      </div>
    </section>

    <section class="upcoming-movie">
      <div class="header">
        <div class="subtitle">
          <small>online Streaming</small>
          <h4>Upcoming Movies</h4>
        </div>
        <!-- <div class="buttons">
          <button>Movies</button>
          <button>TV Shows</button>
          <button>Anime</button>
        </div> -->
      </div>
      <div class="movie-card">

        <div class="wrapper">
          <ul class="movie-carousel">

          @foreach ($is_upcomings as $is_upcoming)
            <li class="card">
              <div class="img">
                <a href="{{ url('/movie-detail/' . $is_upcoming->slug) }}"><img src="{{ asset($is_upcoming -> image) }}" alt="" /></a>
              </div>
              <div class="title">
                <a href="{{ url('/movie-detail/'). $is_upcoming->slug}}"><h4>{{  $is_upcoming -> title }}</h4></a>
                <span>{{  $is_upcoming -> year }}</span>
              </div>
              <div class="footer">
                <span>HD</span>
                <div class="time-rating">
                  <span><i class="fa-regular fa-clock"></i> 137 min</span>
                  <span><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
              </div>
            </li>
          @endforeach
            
          </ul>
        </div>
      </div>
    </section>

    <section class="service">
      <div class="main">
        <div class="img">
          <img src="{{ asset('images/service-banner.jpg') }}" alt="" />
        </div>
        <div class="content">
          <small>our services</small>
          <h4>Download Your Shows Watch Offline.</h4>
          <p>
            Lorem ipsum dolor sit amet, consecetur adipiscing elseddo eiusmod
            tempor.There are many variations of passages of lorem Ipsum
            available, but the majority have suffered alteration in some
            injected humour.
          </p>
          <ul class="list">
            <li>
              <div class="service-card">
                <div class="img">
                  <div class="icon">
                    <i class="fa-solid fa-tv"></i>
                  </div>
                </div>
                <div class="service-content">
                  <h5>Enjoy on Your TV</h5>
                  <p>
                    Lorem ipsum dolor sit amet, consecetur adipiscing elit, sed
                    do eiusmod tempor.
                  </p>
                </div>
              </div>
            </li>
            <hr />
            <li>
              <div class="service-card">
                <div class="img">
                  <div class="icon">
                    <i class="fa-solid fa-video"></i>
                  </div>
                </div>
                <div class="service-content">
                  <h5>Watch Everywhere</h5>
                  <p>
                    Lorem ipsum dolor sit amet, consecetur adipiscing elit, sed
                    do eiusmod tempor.
                  </p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="top-movie same">
      <div class="header">
        <small>Trending Movies</small>
        <h4>Trending Movies</h4>
      </div>
      <div class="top-movie-main">
        <div class="buttons">
          <button>movies</button>
          <button>tv shows</button>
          <button>documentry</button>
          <button>sports</button>
        </div>
        <div class="movie-card">
          <ul class="wrapper">

          @foreach ($movie_trendings as $movie_trending) 
            <li class="card">
              <div class="img">
                <a href="{{ url('/movie-detail/' . $movie_trending->slug) }}"><img src="{{ $movie_trending->image }}" alt="" /></a>
              </div>
              <div class="title">
                <a href="{{ url('/movie-detail/' . $movie_trending->slug) }}"><h4>{{ $movie_trending->title }}</h4></a>
                <span>{{ $movie_trending -> year }}</span>
              </div>
              <div class="footer">
                <span>{{ $movie_trending -> resolution }}</span>
                <div class="time-rating">
                  <span><i class="fa-regular fa-clock"></i> 122 min</span>
                  <span><i class="fa-solid fa-star"></i> 7.8</span>
                </div>
              </div>
            </li>
          @endforeach

          </ul>
        </div>
      </div>
    </section>

    <section class="trial">
      <div class="main">
        <div class="content">
          <h4>trial start first 30 days</h4>
          <p>Enter your email to create or restart your membership.</p>
        </div>
        <div class="form">
          <div class="input">
            <input type="email" placeholder="Enter Your Email">
            <button>get started</button>
          </div>
        </div>
      </div>
    </section>

    @include('partials.footer')

    <button class="back-to-top"><i class="fa-solid fa-chevron-up"></i></button>

    <script src="{{ asset('js/script.js')}}"></script>
    <script src="{{ asset('js/navbar.js')}}"></script>
    
  </body>
</html>