<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Owl Carousel Multiple Rows</title>
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
      font-size: 50px !important;
    }
    .owl-nav button.owl-prev {
      left: 0;
    }
    .owl-nav button.owl-next {
      right: 0;
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

  </style>
</head>
<body>
  <header>
    <b>Note:</b> The whole logic is done in javascript, but be sure to add <b>data-slide-index="0..n"</b> attributes to your slides HTML, as it is needed. ⚠
  </header>
  <div class="content">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme p-3">
                        @for($i = 0; $i <= 20; $i++)
                        <div class="slide" data-slide-index="{{ $i }}">
                            <div class="product-info">
                                <div class="product-header">
                                  <div class="bg-light rounded p-2 m-1">
                                    <img src="{{ asset('front_resources/img/seller.png') }}" style="width: 50px; height: 50px;">
                                    {{-- <span>Seller Name</span> --}}
                                  </div>
                                  <div class="bg-light rounded m-1">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                          <tr>
                                            <td colspan="2">T-shirt</td>
                                          </tr>
                                          <tr>
                                            <td>Min Order: 1pcs</td>
                                            <td>Sl No: 121</td>
                                          </tr>
                                        </tbody>
                                    </table>
                                  </div>
                                  <div class="bg-light rounded p-2 m-1">
                                    <img src="{{ asset('front_resources/img/customer-review.png') }}" style="width: 50px; height: 50px;">
                                  </div>
                                </div>
                                <div class="text-center">
                                  <img src="https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Product Image" class="product-image">
                                </div>
                                <div class="product-footer">
                                  <div class="bg-light rounded p-2 m-1">
                                    <img src="{{ asset('front_resources/img/clock.png') }}"  style="width: 20px; height: 20px;">
                                    <span style="font-size: 14px;">33:05m ago</span>
                                  </div>
                                  <div class="bg-light rounded p-2 m-1">
                                    <img src="{{ asset('front_resources/img/map.png') }}" style="width: 20px; height: 20px;">
                                    <span>Dhaka</span>
                                  </div>
                                  <div class="bg-light rounded p-2 m-1">
                                    <img src="{{ asset('front_resources/img/reward.png') }}" style="width: 20px; height: 20px;">
                                    <span>Original</span>
                                  </div>
                                </div>
                            </div>
                            @endfor
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
        autoplayTimeout: 10000, // 10 seconds
        responsive: {
          0: {
            items: 1,
            rows: 2 // custom option not used by Owl Carousel, but used by the algorithm below
          },
          768: {
            items: 2,
            rows: 3 // custom option not used by Owl Carousel, but used by the algorithm below
          },
          991: {
            items: 3,
            rows: 2 // custom option not used by Owl Carousel, but used by the algorithm below
          }
        }
      };

      // Taken from Owl Carousel so we calculate width the same way
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

      // Custom logic is active if carousel is set up to have more than one row for some given window width
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

          // Calculates number of rows and cols based on current window width
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

            // Carousel is recalculated if and only if a change in number of columns/rows is requested
            if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
              var reInit = false;
              if (carousel) {
                // Destroy existing carousel if any, and set html markup back to its initial state
                carousel.trigger('destroy.owl.carousel');
                carousel = undefined;
                slides = el.find('[data-slide-index]').detach().appendTo(el);
                el.find('.fake-col-wrapper').remove();
                reInit = true;
              }

              // This is the only real 'smart' part of the algorithm

              // First calculate the number of needed columns for the whole carousel
              var perPage = rowsNb * colsNb;
              var pageIndex = Math.floor(slidesNb / perPage);
              var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));

              // Then populate with needed html markup
              var count = 0;
              for (var i = 0; i < fakeColsNb; i++) {
                // For each column, create a new wrapper div
                var fakeCol = $('<div class="fake-col-wrapper"></div>').appendTo(el);
                for (var j = 0; j < rowsNb; j++) {
                  // For each row in said column, calculate which slide should be present
                  var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
                  if (index < slidesNb) {
                    // If said slide exists, move it under wrapper div
                    slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
                  }
                  count++;
                }
              }
              // end of 'smart' part

              previousRowsNb = rowsNb;
              previousColsNb = colsNb;

              if (reInit) {
                // re-init carousel with new markup
                carousel = el.owlCarousel(carouselOptions);
              }
            }
          };

          // Trigger possible update when window size changes
          $(window).on('resize', updateCarousel);

          // We need to execute the algorithm once before first init in any case
          updateCarousel();
        }
      }

      // init
      carousel = el.owlCarousel(carouselOptions);
    });
  </script>
</body>
</html>
