<!DOCTYPE html><html><head><meta charset="utf-8"/>

  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <!-- Site Metas -->
  <meta name="keywords" content=""/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>

  <title>{{ config('app.name', 'K UI') }}</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css"/>

  <!-- bootstrap core css -->
  {{-- <link rel="stylesheet" type="text/css" href="ZCL-system\resources\css\bootstrap.css"/> --}}

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&amp;display=swap" rel="stylesheet"/>
  
  <!-- Custom styles for this template -->
  {{-- <link href="resources/css/style.css" rel="stylesheet"/> --}}
  <!-- responsive style -->
  {{-- <link href="resources/css/responsive.css" rel="stylesheet"/> --}}

  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.css" />
  
  @vite(['resources/css/landpage/css/style.css', 'resources/css/landpage/css/fullcalendar.css','resources/css/landpage/css/responsive.css', 'resources/css/landpage/css/bootstrap.css', 'resources/js/landpage/js/bootstrap.js'])
  
  {{-- <script type="text/javascript" src="resources/js/landpage/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="resources/js/landpage/js/bootstrap.js"></script> --}}
  
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
              <a class="navbar-brand" href="#">
                <img width="50" class="mx-2" alt="Seal of Zamboanga City" src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Seal_of_Zamboanga_City.png">
                <span>
                  LibServ
                </span>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex  flex-column flex-lg-row align-items-center">
                  <ul class="navbar-nav  ">
                    @if (Route::has('login'))
                      @auth
                        <li class="nav-item">
                          <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                         
                      @else
                        <li class="nav-item active">
                          <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>

                          @if (Route::has('register'))
                              <li class="nav-item active">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                              </li>
                          @endif


                      @endauth
                    @endif

                    @if (Route::has('librarian.login'))
                      @auth('librarians')
                        <li class="nav-item">
                          <a href="{{ route('head_librarian.dashboard') }}" class="nav-link">Librarian Dashboard</a>
                        </li>
                         
                      @else
                        <li class="nav-item active">
                          <a href="{{ route('librarian.login') }}" class="nav-link">Librarian Log in</a>
                        </li>

                          {{-- @if (Route::has('register'))
                              <li class="nav-item active">
                                <a href="{{ route('librarian.register') }}" class="nav-link">Librarian Register</a>
                              </li>
                          @endif --}}


                      @endauth
                    @endif
                    
                    
                                      
                  </ul>
                                   
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- end header section -->

    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-lg-5 col-md-6">
                  <div class="slider_detail-box">
                    <h1>
                      Zamboanga <br/>
                      City <br/>
                      Library
                    </h1>
                    <p>
                      ZCL is a Public Library that provides free access to 
                      <br>
                      information,     
                      connects people with information.
                    </p>
                    <div class="btn-box">
                      @auth
                        <a href="{{ route('dashboard') }}" class="btn-1">
                          <img src="images/search-icon.png" width="22px" height="22px" alt="">
                          Browse Books
                        </a> 

                      @else

                      <a href="{{ route('login') }}" class="btn-1">
                        <img src="images/search-icon.png" width="22px" height="22px" alt="">
                        Browse Books
                      </a>

                      @endauth
                      
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                    <img src="images/slider_4.jpg" alt=""/>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-lg-5 col-md-6">
                  <div class="slider_detail-box">
                    <h1>
                      Zamboanga <br/>
                      City <br/>
                      Library
                    </h1>
                    <p>
                      ZCL is a Public Library that provides free access to 
                      <br> information, 
                      
                      connects people with information.
                    </p>
                    <div class="btn-box">
                      @auth
                        <a href="{{ route('dashboard') }}" class="btn-1">
                          <img src="images/search-icon.png" width="22px" height="22px" alt="">
                          Browse Books
                        </a> 

                      @else

                      <a href="{{ route('login') }}" class="btn-1">
                        <img src="images/search-icon.png" width="22px" height="22px" alt="">
                        Browse Books
                      </a>
                      
                      @endauth
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="slider_img-box">
                    <img src="images/slider_2.jpg" alt=""/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-lg-5 col-md-6">
                  <div class="slider_detail-box">
                    <h1>
                      Zamboanga <br/>
                      City <br/>
                      Library
                    </h1>
                    <p>
                      ZCL is a Public Library that provides free access to 
                      <br>
                      information, 
                      connects people with information.
                    </p>
                    <div class="btn-box">
                      @auth
                        <a href="{{ route('dashboard') }}" class="btn-1">
                          <img src="images/search-icon.png" width="22px" height="22px" alt="">
                          Browse Books
                        </a> 

                      @else

                      <a href="{{ route('login') }}" class="btn-1">
                        <img src="images/search-icon.png" width="22px" height="22px" alt="">
                        Browse Books
                      </a>
                      
                      @endauth
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                    <img src="images/slider_3.jpg" alt=""/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-container">
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- welcome section -->
  <section class="welcome_section layout_padding">
    <div class="container">
      <div class="custom_heading-container">
        <h2>
          Welcome To Zamboanga City Library (Library Services)
        </h2>
      </div>
      <div class="layout_padding2">
        <div class="img-box">
          <img src="images/welcome.png" alt=""/>
        </div>
        <div class="detail-box">
          <p>
            Zamboanga City Library (ZCL) is the city’s public library located at R.T. Lim Boulevard. It
            provides free access to books and information available to people that are interested. Zamboanga
            City Library also offers services and activities. With the various services offered by ZCL, it is
            recognized as the top public city library in the Philippines by The Asia Foundation in 2021
            (Candido, 2022). ZCL also accepts book donations, proving that the facility is filled with a wide
            variety of books that also can be borrowed by everyone.
          </p>
          <div>
            
            <a href="https://www.facebook.com/Zamboangacitylibrary" target="_blank">
              <img src="images/fb.png" width="22px" height="22px" alt="">
              Visit FB page
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- end welcome section -->

  <!-- service section -->

  <section class="service_section">
    <div class="container">
      <div class="custom_heading-container">
        <h2>
          ZCL LibServ offers the following services:
        </h2>
      </div>
      <div class="service_container layout_padding2">
        <div class="service_box">
          <div class="img-box">
            <img src="images/ss-1.jpg" alt=""/>
          </div>
          <div class="detail-box">
            <h4>
              Online <br/>
              Catalog
            </h4>
            <p>
              users can easily find specific books and gather their
              important details without the need to personally go to the library. It will also serve as an indicator
              if a specific book is available for borrowing.
            </p>
          </div>
        </div>
        <div class="service_box">
          <div class="img-box">
            <img src="images/ss-2.jpg" alt=""/>
          </div>
          <div class="detail-box">
            <h4>
              Borrowing <br/>
              System
            </h4>
            <p>
              Users can also borrow books with ease just by filling
              up a form using the borrowing system.
            </p>
          </div>
        </div>
        {{-- <div class="service_box">
          <div class="img-box">
            <img src="images/s-3.jpg" alt=""/>
          </div>
          <div class="detail-box">
            <h4>
              Financial <br/>
              Planning
            </h4>
            <p>
              have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even
              slightly believable. If you are
            </p>
          </div>
        </div> --}}
      </div>
    </div>
  </section>

  <!-- end service section -->


  <!--news and announcements section -->
  <section class="news_ann_section layout_padding">
    <div class="container">
      <div class="custom_heading-container">
        <h2>
          News and Announcements
        </h2>
      </div>
      <div class="layout_padding2">
        <div class="img-box">
          <img src="images/problem.jpg" alt=""/>
        </div>
        <div class="detail-box">
          <p>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in
            some form, by injected humour, or randomised words which don&#39;t look even slightly believable. I
          </p>
          <div>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- end news and announcements section -->

  <!--event calendar section -->
  <section class="event_section layout_padding">
    <div class="container">
      <div class="custom_heading-container">
        <h2>
          Event Calendar
        </h2>
      </div>
      <div class="layout_padding2">
        <div class="detail-box">
          <div id="calendar"></div>
        </div>
      </div>

    </div>
  </section>
  <!-- end event calendar section -->
  
  

  <!-- client section -->
  <section class="client_section layout_padding">
    <div class="container">
      <h2>
        What Our Clients Says
      </h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="client_container layout_padding2">
              <div class="client_text">
                <p>
                  psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna
                  aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                  commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                </p>
              </div>
              <div class="detail-box">
                <div class="img-box">
                  <img src="images/client.png" alt=""/>
                </div>
                <div class="name">
                  <h5>
                    Joans Mark
                  </h5>
                  <p>
                    cal
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding2">
              <div class="client_text">
                <p>
                  psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna
                  aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                  commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                </p>
              </div>
              <div class="detail-box">
                <div class="img-box">
                  <img src="images/client.png" alt=""/>
                </div>
                <div class="name">
                  <h5>
                    Joans Mark
                  </h5>
                  <p>
                    cal
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding2">
              <div class="client_text">
                <p>
                  psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna
                  aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                  commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                </p>
              </div>
              <div class="detail-box">
                <div class="img-box">
                  <img src="images/client.png" alt=""/>
                </div>
                <div class="name">
                  <h5>
                    Joans Mark
                  </h5>
                  <p>
                    cal
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>
  </section>
  <!-- end client section -->

  <div class="footer_bg">
    <section class="container-fluid footer_section">
      <p>
        © All Rights Reserved 2022-2023
      </p>
    </section>
    <!-- footer section -->
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/fullcalendar.min.js"></script>
  
  
  <script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            timeZone: 'Asia/Manila',
            views: {
                listDay: { buttonText: 'list day' },
                listWeek: { buttonText: 'list week' },
                listMonth: { buttonText: 'list month' }
            },
            events:'/fetch/events',
            header:{
                left:'prev,next,today',
                center:'title',
                right:'month,agendaWeek,agendaDay,listWeek,listMonth'
            },
          });
    });
</script>

</body>
</html>