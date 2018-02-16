var slideIndex = 0;

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1}
    x[slideIndex-1].style.display = "block";
    setTimeout(carousel, 2000); // Change image every 2 seconds
}

  if (window.location.href == 'http://localhost:8888/siteBanqueLaravel/public/') {
    if (window.matchMedia("(max-width: 1024px)").matches) {
      $(document).ready(function(){
        $(".mySlides").hide();
      });
    }
    else {
      $(document).ready(function(){
        carousel();
      });
    }
  }
