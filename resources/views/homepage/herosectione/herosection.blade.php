 
<section class="hero_section">
    <img class="hero_section_img" src="assets/img/home/hero-removebg-preview.png" alt="" />
    <div class="hero_text">
        <h1>Discover the Brilliance of Nature</h1>
        <p>Explore our exclusive collection of rare and exquisite gemstones, each telling its own unique story.</p>
        @if (!Auth::check())
            <a href="{{ route('login') }}" class="call_to_actione">Join Us</a>
        @endif
    </div>
</section>



