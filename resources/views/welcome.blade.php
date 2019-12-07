<!DOCTYPE html>
<html lang="en">
  <head>
    <title>LCG Logistics</title>
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

  

    <div class="site-blocks-cover overlay" style="background-image: url(public/images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            

            <h1 class="text-white font-weight-light mb-5 text-uppercase font-weight-bold">Land Connect Group</h1>
            <h5 style="margin-top: -5%;color: white ">Logistics Network</h5>

          </div>
        </div>
      </div>
    </div>  

    <div class="container">
      <div class="row align-items-center no-gutters align-items-stretch overlap-section">
        <div class="col-md-4">
          <div class="feature-1 pricing h-100 text-center">
            <div class="icon">
              <span class="icon-dollar"></span>
            </div>
            <h2 class="my-4 heading">Best Prices</h2>
            <p><b>LCG</b> is offering best quotes from all other leading Logistic companies. <br>Feel free to contact and get your best quote NOW! </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="free-quote bg-dark h-100">
            <h2 class="my-4 heading  text-center">Get Free Quote</h2>
            <form method="post">
              <div class="form-group">
                <label for="fq_name">Name</label>
                <input type="text" class="form-control btn-block" id="fq_name" name="fq_name" placeholder="Enter Name">
              </div>
              <div class="form-group mb-4">
                <label for="fq_email">Email</label>
                <input type="text" class="form-control btn-block" id="fq_email" name="fq_email" placeholder="Enter Email">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary text-white py-2 px-4 btn-block" value="Get Quote">  
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-3 pricing h-100 text-center">
            <div class="icon">
              <span class="icon-phone"></span>
            </div>
            <h2 class="my-4 heading">24/7 Support</h2>
            <p>Customer satisfaction is our first priority. We offer 24/7 customer support. <br> Our representatives are always eagerly entertaines all customer queries.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="mb-0 text-primary">What LCG Offers</h2>
          </div>
        </div>
       
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-frontal-truck"></span></div>
              <div>
                <h3>Ground Shipping</h3>
                <p><b>LCG</b> is offering best quotes from all other leading Logistic companies. 
                    Feel free to contact and get your best quote NOW!</p>
                
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  

    <div class="site-section block-13">
      <!-- <div class="container"></div> -->


      <div class="owl-carousel nonloop-block-13">
        <div>
          <a href="#" class="unit-1 text-center">
            <img src="public/images/img_1.jpg" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Storage</h3>
              <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
            </div>
          </a>
        </div>

        <div>
          <a href="#" class="unit-1 text-center">
            <img src="public/images/img_3.jpg" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Cargo Transports</h3>
              <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
            </div>
          </a>
        </div>

        <div>
          <a href="#" class="unit-1 text-center">
            <img src="public/images/img_5.jpg" alt="Image" class="img-fluid">
            <div class="unit-1-text">
              <h3 class="unit-1-heading">Ware Housing</h3>
              <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
            </div>
          </a>
        </div>


      </div>
    </div>


    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">More Services</h2>
            <p class="color-black-opacity-5">We Offer The Following Services</p>
          </div>
        </div>
        <div class="row align-items-stretch">
          
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-frontal-truck"></span></div>
              <div>
                <h3>Ground Shipping</h3>
                <p><b>LCG</b> is offering best quotes from all other leading Logistic companies. 
                  Feel free to contact and get your best quote NOW!</p>
               
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-barn"></span></div>
              <div>
                <h3>Warehousing</h3>
                <p>In the feild of warehouse <b>LCG</b> is providing you full visibility of stalk inventry movements and vast custumized to reduce the time needed to replenish stalk level.</p></p>
                
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-platform"></span></div>
              <div>
                <h3>Storage</h3>
                <p>For your ease <b>LCG</b> is offering best quotes for storage from all other leading Logistic companies. 
                  Feel free to contact and get your best quote. LCG renders modren,end -end suply chain with a dedicated inventry system to comfertable the cyclical nature of ever changing fassion landscape</p>
                
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-car"></span></div>
              <div>
                <h3>Delivery Van</h3>
                <p>We strive to extend standard services across vast distances and through rough terrain
                  all across Pakistan. Our motivated staff and expertise in the industry always keep us on schedule.</p></p>
                
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="site-blocks-cover overlay inner-page-cover" style="background-image: url(public/images/hero_bg_2.jpg); background-attachment: fixed;">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-7" data-aos="fade-up" data-aos-delay="400">
            <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-single-big mb-4 d-inline-block popup-vimeo"><span class="icon-play"></span></a>
            <h2 class="text-white font-weight-light mb-5 h1">View Our Services By Watching This Short Video</h2>
            
          </div>
        </div>
      </div>
    </div>  
    
    <div class="site-section border-bottom">
      <div class="container">

        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Testimonials</h2>
          </div>
        </div>

        <div class="slide-one-item home-slider owl-carousel">
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="public/images/person_3.jpg" alt="Image" class="img-fluid mb-3">
                <p>Muaz Qazi</p>
              </figure>
              <blockquote>
                <p>&ldquo;<b>LCG</b>, the most dynamic public sector transportation oraganization has a proud history of offering innovative and customized solutions specifically designed to address the business needs of valued customers.The diverse and wide ranging services offered by <b>LCG</b> safe movement of cargo to any destination, management of state-of-the-art Dry Ports & Border Terminals and Express Freight Train Service..&rdquo;</p>
              </blockquote>
            </div>
          </div>
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="public/images/person_2.jpg" alt="Image" class="img-fluid mb-3">
                <p>Qazi Asim Sana</p>
              </figure>
              <blockquote>
                <p>&ldquo;Professionalism and quality services being rendered by <b>LCG</b> for over past four decades has made <b>LCG</b> the most credible name in the Logistics and Construction sectors of Pakistan. Keeping pace with latest technological advancements and introduction of new trends in the fields have contributed a great deal to remarkable growth and success of the organization.&rdquo;</p>
              </blockquote>
            </div>
          </div>

          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="public/images/person_4.jpg" alt="Image" class="img-fluid mb-3">
                <p>Ahsan Qazi</p>
              </figure>
              <blockquote>
                <p>&ldquo;<b>LCG</b>, the most dynamic public sector transportation oraganization has a proud history of offering innovative and customized solutions specifically designed to address the business needs of valued customers.The diverse and wide ranging services offered by <b>LCG</b> safe movement of cargo to any destination, management of state-of-the-art Dry Ports & Border Terminals and Express Freight Train Service.&rdquo;</p>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section border-top">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <h2 class="mb-5 text-black">Try Our Services!</h2>
        
          </div>
        </div>
      </div>
    </div>
    
    @include('main_layout.footer')
  </body>
</html>