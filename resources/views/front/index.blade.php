<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Demo</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <style>
    html {
      font-family: 'arial';
    }
    header {
      margin-bottom: 40px;
    }
    .slide {
      /* font-size: 50px; */
      text-align: center;
      border: 1px solid black;
      margin-bottom: 20px;
    }
    .fake-col-wrapper {
      display: flex;
      flex-direction: column;
    }
    .owl-nav button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: #000;
      color: #fff;
      border: none;
      padding: 10px 10px;
      z-index: 1000;
      font-size: 120px !important;
    }
    .owl-nav button.owl-prev {
      left: 0;
    }
    .owl-nav button.owl-next {
      right: 0;
    }

    button.owl-next {
      background: none !important;
      color: black !important;
    }

    button.owl-prev {
      background: none !important;
      color: black !important;
    }
    

    /* product item  */
    .product-image {
      max-width: 100%;
      height: auto;
    }
    .product-info {
      border: 1px solid #ffc107;
      padding: 10px;
      background-color: #fff3cd;
    }
    .product-header, .product-footer {
      background-color: #ffc107;
      color: #000;
      padding: 2px;
      text-align: center;
    }
    .product-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .product-footer {
      display: flex;
      justify-content: space-around;
      align-items: center;
    }
    .product-footer div {
      display: flex;
      align-items: center;
    }
    .product-footer img {
      margin-right: 2px;
    }

    .product-image {
        transition: transform 0.3s ease;
    }

    .slide:hover .product-image {
        transform: scale(1.02);
        border-radius: 5px;
    }

  </style>
</head>
<body>
 
  <div class="content">
    <section>
        <div class="container pb-5">
            <div class="row">
              <div class="col-md-12 text-center">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                  <div class="container-fluid">
                      <a class="navbar-brand" href="{{ route('index') }}">Ecommerce Demo</a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                                  <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="#">Shop</a>
                              </li>
                          </ul>
                          <div class="d-flex">
                              @guest
                                  <a href="{{ route('register') }}" class="btn btn-success" type="submit">Register</a>
                                  <a href="{{ route('login') }}" class="btn btn-primary ms-3" type="submit">Login</a>
                              @else
                                  <a href="{{ route('account.dashboard') }}" class="btn btn-primary" type="submit">Dashboard</a>
                                  <form action="{{ route('logout') }}" method="POST" class="ms-3">
                                      @csrf
                                      <button class="btn btn-danger" type="submit">Logout</button>
                                  </form>
                              @endguest
                          </div>
                      </div>
                  </div>
              </nav>              
              </div>
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme p-2">
                      @foreach($products as $key => $product)
                          @include('front.include.product_item')
                      @endforeach
                      </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function() {
      var el = $('.owl-carousel');
      var carousel;
      var carouselOptions = {
        margin: 20,
        nav: true,
        dots: true,
        slideBy: 'page',
        autoplay: true,
        autoplayTimeout: 10000,
        responsive: {
          0: {
            items: 1,
            rows: 2
          },
          768: {
            items: 2,
            rows: 3
          },
          991: {
            items: 3,
            rows: 2
          }
        }
      };

      var viewport = function() {
        var width;
        if (carouselOptions.responsiveBaseElement && carouselOptions.responsiveBaseElement !== window) {
          width = $(carouselOptions.responsiveBaseElement).width();
        } else if (window.innerWidth) {
          width = window.innerWidth;
        } else if (document.documentElement && document.documentElement.clientWidth) {
          width = document.documentElement.clientWidth;
        } else {
          console.warn('Can not detect viewport width.');
        }
        return width;
      };

      var severalRows = false;
      var orderedBreakpoints = [];
      for (var breakpoint in carouselOptions.responsive) {
        if (carouselOptions.responsive[breakpoint].rows > 1) {
          severalRows = true;
        }
        orderedBreakpoints.push(parseInt(breakpoint));
      }

      if (severalRows) {
        orderedBreakpoints.sort(function (a, b) {
          return b - a;
        });
        var slides = el.find('[data-slide-index]');
        var slidesNb = slides.length;
        if (slidesNb > 0) {
          var rowsNb;
          var previousRowsNb = undefined;
          var colsNb;
          var previousColsNb = undefined;

          var updateRowsColsNb = function () {
            var width = viewport();
            for (var i = 0; i < orderedBreakpoints.length; i++) {
              var breakpoint = orderedBreakpoints[i];
              if (width >= breakpoint || i == (orderedBreakpoints.length - 1)) {
                var breakpointSettings = carouselOptions.responsive['' + breakpoint];
                rowsNb = breakpointSettings.rows;
                colsNb = breakpointSettings.items;
                break;
              }
            }
          };

          var updateCarousel = function () {
            updateRowsColsNb();

            if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
              var reInit = false;
              if (carousel) {
                carousel.trigger('destroy.owl.carousel');
                carousel = undefined;
                slides = el.find('[data-slide-index]').detach().appendTo(el);
                el.find('.fake-col-wrapper').remove();
                reInit = true;
              }

              var perPage = rowsNb * colsNb;
              var pageIndex = Math.floor(slidesNb / perPage);
              var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));

              var count = 0;
              for (var i = 0; i < fakeColsNb; i++) {
                var fakeCol = $('<div class="fake-col-wrapper"></div>').appendTo(el);
                for (var j = 0; j < rowsNb; j++) {
                  var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
                  if (index < slidesNb) {
                    slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
                  }
                  count++;
                }
              }

              previousRowsNb = rowsNb;
              previousColsNb = colsNb;

              if (reInit) {
                carousel = el.owlCarousel(carouselOptions);
              }
            }
          };

          $(window).on('resize', updateCarousel);

          updateCarousel();
        }
      }

      carousel = el.owlCarousel(carouselOptions);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTime() {
            document.querySelectorAll('.product-footer .bg-light[data-created-at]').forEach(function(el) {
                const createdAt = new Date(el.getAttribute('data-created-at'));
                const now = new Date();
                const diff = now - createdAt;
    
                const hours = Math.floor(diff / 1000 / 60 / 60);
                const minutes = Math.floor((diff / 1000 / 60) % 60);
                const seconds = Math.floor((diff / 1000) % 60);
    
                el.querySelector('.time-elapsed').textContent = `${hours}h : ${minutes}m : ${seconds}s ago`;
            });
        }
    
        setInterval(updateTime, 1000);
        updateTime();
    });
    </script>
</body>
</html>
