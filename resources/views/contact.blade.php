
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact LCG</title>
   @include('main_layout.head')
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
   @include('main_layout.header')

  

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(public/images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Contact LCG</h1>
            <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span>Contact</span></p>
          </div>
        </div>
      </div>
    </div>  

    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">

            @if (session()->has('contactus'))
              <h3>{{session()->get('contactus')}}</h3>
              <?php
              ?><script language="javascript">       
            alert("your request submitted");          
            </script><?php
             session()->forget('contactus');

              ?>
            @endif

            <form action="create_contact" class="p-5 bg-white" method="post">
             

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control" name="first_name">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control" name="last_name">
                </div>
              </div>
              @csrf
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">phone</label> 
                  <input type="text" id="email" class="form-control" name="phone">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control" name="subject">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4"><b> Head Office</b><br> Office 09 5th Floor Abrar Center Muslim Town Lahore</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <b>Landline:</b>
              <p class="mb-4"><a href="#">+92-42-37502926</a></p>
              <b>Mobile:</b>
              <p class="mb-4"><a href="#">+92-332-7502926 <br>+92-335-7502926</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">info@lcg.com.pk</a></p>

            </div>

          </div>
        </div>
      </div>
    </div>
    
     @include('main_layout.footer')
  </body>
</html>