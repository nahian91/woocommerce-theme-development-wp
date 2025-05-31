<?php 

/*
    Template Name: Contact Page
*/
get_header();

?>

    <!-- Breadcumb -->
    <div class="breadcumb-area bg-image text-center">
        <div class="container">
            <div class="row">
                <div class="co-lg-12">
                    <div class="banner-content">
                        <h1 class="title">Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcumb -->

    <div class="map-contact-area section-gap2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-left-area-main-wrapper">
                        <div class="location-single-card">
                            <div class="icon">
                                <i class="fa-light fa-location-dot"></i>
                            </div>
                            <div class="information">
                                <h3 class="title">Berlin Germany Store <br><br>259 Daniel Road, FKT 2589 Berlin, Germany.</h3>
                            </div>
                        </div>
                        <div class="location-single-card">
                            <div class="icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="information">
                                <h3 class="title">+856 (76) 259 6328</h3>
                            </div>
                        </div>
                        <div class="location-single-card">
                            <div class="icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="information">
                                <h3 class="title">info@ekomart.com</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pl--50 pl_sm--5 pl_md--5">
                    <div class="contact-form-wrapper-1">
                        <h3 class="title mb--50">Fill Up The Form If You Have Any Question</h3>
                        <form action="#" class="contact-form-1">
                            <div class="contact-form-wrapper--half-area">
                                <div class="single">
                                    <input type="text" placeholder="name*">
                                </div>
                                <div class="single">
                                    <input type="text" placeholder="Email*">
                                </div>
                            </div>
                            <div class="single-select">
                                <select>
                                    <option data-display="Subject*">All Categories</option>
                                    <option value="1">Some option</option>
                                    <option value="2">Another option</option>
                                    <option value="3" disabled>A disabled option</option>
                                    <option value="4">Potato</option>
                                </select>
                            </div>
                            <textarea name="message" placeholder="Write Message Here"></textarea>
                            <button class="main-btn btn-primary mt--20">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer();?>