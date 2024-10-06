<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" /> <!-- Add your favicon link here -->
    {{-- <link rel="stylesheet" href="assets/css/login.css"> --}}

  </head>
  <body>
@include('homepage.homenav.homenav')

    <section class="hero_section">
      <img class="hero_section_img  " src="assets/img/home/hero-removebg-preview.png" alt="" />
      <div class="hero_text">
        <h1>Discover the Brilliance of Nature</h1>
        <p>
          Explore our exclusive collection of rare and exquisite gemstones, each
          telling its own unique story.
        </p>
        <a  href={{route('login')}} class="call_to_actione">Join Us</a>
      </div>
    </section>

    <section class="category_section">
      <div>
        <h1 class="category_heading">Our Category</h1>
      </div>
    </section>
    <section class="All_category">
      <div class="category_card">
        <h3 class="category_name">frvbvfnkm</h3>
        <img src="assets/img/home/hero_section.jpeg" alt="" class="category_img" />
        <a class="category_link" href="">more details</a>
      </div>
      <div class="category_card">
        <h3 class="category_name">frvbvfnkm</h3>
        <img src="assets/img/home/hero_section.jpeg" alt="" class="category_img" />
        <a class="category_link" href="">more details</a>
      </div>
      <div class="category_card">
        <h3 class="category_name">frvbvfnkm</h3>
        <img src="assets/img/home/hero_section.jpeg" alt="" class="category_img" />
        <a class="category_link" href="">more details</a>
      </div>
    </section>
    <div class="container">
      <div class="text-section">
          <h2>Buy Gemstones Online</h2>
          <h1>Precious Stones, Semi-Precious Stones, Astrological Stones or Rashi Ratna.</h1>
        </div>
      <section class="image-section">
 
          <div class="item">
              <p>Adorn Perfection</p>
              <h3>PENDANTS</h3>
              <img src="assets/img/home/PENDANTS.jpg" class="category_img" alt="Pendants">
          </div>
          <div class="item">
              <p>Embrace Preciousness</p>
              <h3>BRACELETS</h3>
              <img src="assets/img/home/BRACELETS.jpg" class="category_img" alt="Bracelets">
          </div>
      </section>
  </div>

    <script src="assets/js/homepage.js"></script>
  </body>
</html>
