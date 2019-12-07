<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li class="active"><a href="about.html">About LCG</a></li>
                  <li><a href="services.html">LCG Services</a></li>
                  <li><a href="contact.html">Contact</a></li>
                   @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

                  
                 </ul>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
          
            </div>
          </div>
          
        </div>
      </div>
    </footer>
  </div>



  <script src="public/js/jquery-3.3.1.min.js"></script>
  <script src="public/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="public/js/jquery-ui.js"></script>
  <script src="public/js/popper.min.js"></script>
  <script src="public/js/bootstrap.min.js"></script>
  <script src="public/js/owl.carousel.min.js"></script>
  <script src="public/js/jquery.stellar.min.js"></script>
  <script src="public/js/jquery.countdown.min.js"></script>
  <script src="public/js/jquery.magnific-popup.min.js"></script>
  <script src="public/js/bootstrap-datepicker.min.js"></script>
  <script src="public/js/aos.js"></script>

  <script src="public/js/main.js"></script>
