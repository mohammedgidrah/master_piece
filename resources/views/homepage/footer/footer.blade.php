      <footer class="footer_widgets footer_black">
          <div class="container">
              <div class="footer_top">
                  <div class="row justify-content-around">
                      <div class="col-lg-4 col-md-6 col-sm-8">
                          <div class="widgets_container contact_us">
                              <h3>About Ashirwaad</h3>
                              <div class="footer_contact">
                                   <p>Phone : <a href="#">+962 798 199 473</a></p>
                                   <p>Email : <a href="mailto:m7mdgidrah@gmail.com"> m7mdgidrah@gmail.com</a></p>
   
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-sm-4 col-6">
                          <div class="widgets_container widget_menu">
                              <h3>useful links</h3>
                              <div class="footer_menu">
                                  <ul>
                                      <li><a href="#about">About Us</a></li>
                                      <li><a href="#category">category</a></li>
                                      @if (!Auth::check())
                                          <li><a href="{{ route('login') }}">Login</a></li>
                                      @else
                                          @if (Auth::user()->role === 'admin')
                                              <!-- Check if the user is an admin -->
                                              <li><a href="{{ route('dashboard.maindasboard') }}">Dashboard</a></li>
                                              <!-- Admin's Dashboard link -->
                                          @elseif (Auth::user()->role === 'user')
                                              <li><a href="{{ route('userprofile') }}">Profile</a></li>
                                              <!-- Regular user's Profile link -->
                                          @endif
                                      @endif

                                      <li><a href="#contact">Contact</a></li>

                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-2 col-md-6 col-sm-5 col-6">
                          <div class="widgets_container widget_menu">
                              <h3>My Account</h3>
                              <div class="footer_menu">
                                  <ul>
                                      @if (Auth::check() && Auth::user()->role === 'user')
                                          <li><a href="{{ route('userprofile') }}"> Profile</a></li>
                                      @else
                                          <li><a href="{{ route('home') }}">Home</a></li>
                                      @endif

         
                                  </ul>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>


          </div>
      </footer>
