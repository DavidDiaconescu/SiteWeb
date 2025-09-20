$(document).ready(function() {
  // Lista cu elemente de tip imagine sau video
  const slides = [
    { type: 'img', src: 'Poza1.jpg' },
    { type: 'img', src: 'Poza2.jpg' },
    { type: 'video', src: 'Video1.mp4' },
    { type: 'img', src: 'Poza3.jpg' },
    { type: 'img', src: 'Poza4.jpg' },
    { type: 'img', src: 'Poza5.jpeg' }
  ];

  let currentIndex = 0;
  let intervalId;

  function createSlideElement(item, topPercent) {
    let element;
    if (item.type === 'img') {
      element = $('<img>')
        .attr('src', item.src)
        .css({ width: '100%', display: 'block' });
    } else if (item.type === 'video') {
      element = $('<video autoplay muted>')
        .attr('src', item.src)
        .attr('playsinline', true)
        .attr('loop', false)
        .prop('autoplay', true)
        .prop('muted', true)
        .css({ width: '100%', display: 'block' });
    }

    return element.css({
      position: 'absolute',
      top: `${topPercent}%`,
      left: 0
    });
  }

  function loadSlides(count) {
    $('#slider').empty();
    for (let i = 0; i < count; i++) {
      let slideIndex = (currentIndex + i) % slides.length;
      let slide = createSlideElement(slides[slideIndex], i * 100);
      $('#slider').append(slide);
    }
  }

  function startSlider() {
    let numSlides = parseInt($('#numImages').val());
    let interval = parseInt($('#interval').val()) * 1000;

    loadSlides(numSlides);
    if (intervalId) clearInterval(intervalId);

    intervalId = setInterval(function() {
      slideNext(numSlides);
    }, interval);
  }

  function slideNext(numSlides) {
    currentIndex = (currentIndex + 1) % slides.length;

    $('#slider').children().first().animate({ top: '-100%' }, 600, function() {
      $(this).remove();
      let newSlideIndex = (currentIndex + numSlides - 1) % slides.length;
      let newSlide = createSlideElement(slides[newSlideIndex], (numSlides - 1) * 100);
      $('#slider').append(newSlide);
    });

    $('#slider').children().not(':first').each(function() {
      $(this).animate({ top: '-=100%' }, 600);
    });
  }

  function slidePrev(numSlides) {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;

    let newSlide = createSlideElement(slides[currentIndex], -100);
    $('#slider').prepend(newSlide);

    $('#slider').children().each(function() {
      $(this).animate({ top: '+=100%' }, 600);
    });

    setTimeout(function() {
      $('#slider').children().last().remove();
    }, 600);
  }

  $('#startSlider').click(function() {
    startSlider();
  });

  $('#next').click(function() {
    let numSlides = parseInt($('#numImages').val());
    clearInterval(intervalId);
    slideNext(numSlides);
    startSlider();
  });

  $('#prev').click(function() {
    let numSlides = parseInt($('#numImages').val());
    clearInterval(intervalId);
    slidePrev(numSlides);
    startSlider();
  });
});
