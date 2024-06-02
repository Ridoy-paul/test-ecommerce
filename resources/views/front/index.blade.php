<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Owl Carousel Multiple Rows</title>
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
      font-size: 50px;
      text-align: center;
      border: 1px solid black;
      margin-bottom: 20px;
    }
    .fake-col-wrapper {
      display: flex;
      flex-direction: column;
    }
  </style>
</head>
<body>
  <header>
    'Simple' example of how to achieve a <b>truly responsive multiple rows</b> carousel using Owl Carousel. <a href="https://stackoverflow.com/a/64356269/2500651">Corresponding Stack Overflow post</a>. Feel free to use this code if you need it. 👾<br/><br/>
    ✅ Tested & working with <b>any number of columns and rows, and any breakpoints</b>. Also with loop: true/false, slideBy: 1/n/'page', etc...<br/>
    ✅ Implementation is as efficient as possible, meaning <b>the carousel is recalculated only if absolutely necessary</b>. I haven't noticed any kind of stuttering or visual artifacts.<br/>
    ✅ For readability and simplicity purposes, setting the desired number of rows for a given window width is done the exact same way as the native number of items, in the carousel options object. 'items' here acts as the number of columns visible at a time.<br/><br/>
    <b>Note:</b> The whole logic is done in javascript, but be sure to add <b>data-slide-index="0..n"</b> attributes to your slides HTML, as it is needed. ⚠
  </header>
  <div class="owl-carousel owl-theme">
    <div class="slide" data-slide-index="0">1</div>
    <div class="slide" data-slide-index="1">2</div>
    <div class="slide" data-slide-index="2">3</div>
    <div class="slide" data-slide-index="3">4</div>
    <div class="slide" data-slide-index="4">5</div>
    <div class="slide" data-slide-index="5">6</div>
    <div class="slide" data-slide-index="6">7</div>
    <div class="slide" data-slide-index="7">8</div>
    <div class="slide" data-slide-index="8">9</div>
    <div class="slide" data-slide-index="9">10</div>
    <div class="slide" data-slide-index="10">11</div>
    <div class="slide" data-slide-index="11">12</div>
    <div class="slide" data-slide-index="12">7</div>
    <div class="slide" data-slide-index="13">8</div>
    <div class="slide" data-slide-index="14">9</div>
    <div class="slide" data-slide-index="15">10</div>
    <div class="slide" data-slide-index="16">11</div>
    <div class="slide" data-slide-index="17">12</div>
  </div>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Owl Carousel JS -->
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
