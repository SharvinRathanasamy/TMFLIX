var slideIndex = 0,
interval;

function stopAndStart() {
    if (interval) {
        clearInterval(interval)
    }
    interval = setInterval(showSlides, 5000); // Change image every 5 seconds;
}


//showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
  stopAndStart()
}

function currentSlide(n) {
  showSlides(slideIndex = n);
  stopAndStart()
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n == undefined) { n = ++slideIndex;}
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length;}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }

  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

stopAndStart();


