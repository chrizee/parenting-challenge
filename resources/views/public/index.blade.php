@extends('public.layouts.app')

@section('content')

    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                <li style="background-image: url({{ asset('/storage/images/slide_1.jpg') }});">
                    <div class="container">
                        <div class="col-md-12 text-center js-fullheight fh5co-property-brief slider-text">
                            <div class="fh5co-property-brief-inner">
                                <div class="fh5co-box">

                                    <h3><a href="#">Villa In Hialeah, Dade County</a></h3>
                                    <div class="price-status">
                                        <span class="price">$540,000 <a href="#" class="tag">For Sale</a></span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>

                                    <p class="fh5co-property-specification">
                                        <span><strong>3500</strong> Sq Ft</span>  <span><strong>3</strong> Beds</span>  <span><strong>3.5</strong> Baths</span>  <span><strong>2</strong> Garages</span>
                                    </p>

                                    <p><a href="#" class="btn btn-primary">Learn more</a></p>


                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ asset('/storage/images/slide_2.jpg') }});">
                    <div class="container">
                        <div class="col-md-12 text-center js-fullheight fh5co-property-brief slider-text">
                            <div class="fh5co-property-brief-inner">
                                <div class="fh5co-box">
                                    <h3><a href="#">15 Apartments Of Type B</a></h3>
                                    <div class="price-status">
                                        <span class="price">$2,200<span class="per">/Month</span> <a href="#" class="tag">For Rent</a></span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>
                                    <p class="fh5co-property-specification">
                                        <span><strong>3500</strong> Sq Ft</span>  <span><strong>3</strong> Beds</span>  <span><strong>3.5</strong> Baths</span>  <span><strong>2</strong> Garages</span>
                                    </p>
                                    <p><a href="#" class="btn btn-primary">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ asset('/storage/images/slide_3.jpg') }});">
                    <div class="container">
                        <div class="col-md-12 text-center js-fullheight fh5co-property-brief slider-text">
                            <div class="fh5co-property-brief-inner">
                                <div class="fh5co-box">
                                    <h3><a href="#">401 Biscayne Boulevard, Miami</a></h3>
                                    <div class="price-status">
                                        <span class="price">$1,540,000 <a href="#" class="tag">For Sale</a></span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>
                                    <p class="fh5co-property-specification">
                                        <span><strong>3500</strong> Sq Ft</span>  <span><strong>3</strong> Beds</span>  <span><strong>3.5</strong> Baths</span>  <span><strong>2</strong> Garages</span>
                                    </p>
                                    <p><a href="#" class="btn btn-primary">Learn more</a></p>


                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </aside>
    <div id="best-deal">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2>We are Offering the Best Real Estate Deals</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
                <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">


                    <div class="fh5co-property">
                        <figure>
                            <img src="{{ asset('/storage/images/slide_3.jpg') }}" alt="Free Website Templates FreeHTML5.co" class="img-responsive">
                            <a href="#" class="tag">For Sale</a>
                        </figure>
                        <div class="fh5co-property-innter">
                            <h3><a href="#">Villa In Hialeah, Dade County</a></h3>
                            <div class="price-status">
                                <span class="price">$540,000 </span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>
                        </div>
                        <p class="fh5co-property-specification">
                            <span><strong>3500</strong> Sq Ft</span>  <span><strong>3</strong> Beds</span>  <span><strong>3.5</strong> Baths</span>  <span><strong>2</strong> Garages</span>
                        </p>
                    </div>


                </div>
                <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">

                    <div class="fh5co-property">
                        <figure>
                            <img src="{{ asset('/storage/images/slide_2.jpg') }}" alt="Free Website Templates FreeHTML5.co" class="img-responsive">
                            <a href="#" class="tag">For Rent</a>
                        </figure>
                        <div class="fh5co-property-innter">
                            <h3><a href="#">15 Apartments Of Type B</a></h3>
                            <div class="price-status">
                                <span class="price">$2,000<span class="per">/month</span> </span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>
                        </div>
                        <p class="fh5co-property-specification">
                            <span><strong>3500</strong> Sq Ft</span>  <span><strong>3</strong> Beds</span>  <span><strong>3.5</strong> Baths</span>  <span><strong>2</strong> Garages</span>
                        </p>
                    </div>

                </div>
                <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">

                    <div class="fh5co-property">
                        <figure>
                            <img src="{{ asset('/storage/images/slide_1.jpg') }}" alt="Free Website Templates FreeHTML5.co" class="img-responsive">
                            <a href="#" class="tag">For Sale</a>
                        </figure>
                        <div class="fh5co-property-innter">
                            <h3><a href="#">401 Biscayne Boulevard, Miami</a></h3>
                            <div class="price-status">
                                <span class="price">$1,540,000</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>
                        </div>
                        <p class="fh5co-property-specification">
                            <span><strong>3500</strong> Sq Ft</span>  <span><strong>3</strong> Beds</span>  <span><strong>3.5</strong> Baths</span>  <span><strong>2</strong> Garages</span>
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <div class="fh5co-section-with-image">

        <img src="{{ asset('/storage/images/image_1.jpg') }}" alt="" class="img-responsive">
        <div class="fh5co-box animate-box">
            <h2>Security, Comfort, &amp; Convenience</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta magni amet atque doloremque velit unde adipisci omnis hic quaerat.</p>
            <p><a href="#" class="btn btn-primary btn-outline with-arrow">Get started <i class="icon-arrow-right"></i></a></p>
        </div>

    </div>

    <div id="fh5co-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2>Happy Clients</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">
                    <blockquote>
                        <p>&ldquo; She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of. &rdquo;</p>
                        <p><span class="fh5co-author"><cite>Jason Davidson</cite></span><i class="icon twitter-color icon-twitter pull-right"></i></p>

                    </blockquote>
                </div>
                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">
                    <blockquote>
                        <p>&ldquo; Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. She had a last view back on the skyline of her hometown Bookmarksgrove, the headline of. &rdquo;</p>
                        <p><span class="fh5co-author"><cite>Kyle Smith</cite></span><i class="icon googleplus-color icon-google-plus pull-right"></i></p>
                    </blockquote>
                </div>
                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">

                    <blockquote>
                        <p>&ldquo; The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. S	he had a last view back on the skyline of her hometown Bookmarksgrove. &rdquo;</p>
                        <p><span class="fh5co-author"><cite>Rick Cook</cite></span><i class="icon facebook-color icon-facebook pull-right"></i></p>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>


    <div id="fh5co-agents">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading white animate-box" data-animate-effect="fadeIn">
                    <h2>Our Trusted Agents</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">

                    <div class="fh5co-agent">
                        <figure>
                            <img src="{{ asset('/storage/images/testimonial_person2.jpg') }}" alt="Free Website Template by FreeHTML5.co">
                        </figure>
                        <h3>John Doe</h3>
                        <p>Veniam laudantium rem odio quod, beatae voluptates natus animi fugiat provident voluptatibus. Debitis assumenda, possimus ducimus omnis.</p>
                        <p><a href="#" class="btn btn-primary btn-outline">Contact Me</a></p>
                    </div>

                </div>
                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-agent">
                        <figure>
                            <img src="{{ asset('/storage/images/testimonial_person3.jpg') }}" alt="Free Website Template by FreeHTML5.co">
                        </figure>
                        <h3>John Doe</h3>
                        <p>Veniam laudantium rem odio quod, beatae voluptates natus animi fugiat provident voluptatibus. Debitis assumenda, possimus ducimus omnis.</p>
                        <p><a href="#" class="btn btn-primary btn-outline">Contact Me</a></p>
                    </div>
                </div>
                <div class="col-md-4 text-center item-block animate-box" data-animate-effect="fadeIn">
                    <div class="fh5co-agent">
                        <figure>
                            <img src="{{ asset('/storage/images/testimonial_person4.jpg') }}" alt="Free Website Template by FreeHTML5.co">
                        </figure>
                        <h3>John Doe</h3>
                        <p>Veniam laudantium rem odio quod, beatae voluptates natus animi fugiat provident voluptatibus. Debitis assumenda, possimus ducimus omnis.</p>
                        <p><a href="#" class="btn btn-primary btn-outline">Contact Me</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="fh5co-blog">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading animate-box" data-animate-effect="fadeIn">
                    <h2>Latest <em>from</em> Blog</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 animate-box" data-animate-effect="fadeIn">
                    <a class="fh5co-entry" href="#">
                        <figure>
                            <img src="{{ asset('/storage/images/slide_4.jpg') }}" alt="Free Website Template, Free HTML5 Bootstrap Template" class="img-responsive">
                        </figure>
                        <div class="fh5co-copy">
                            <h3>We Create Awesome Free Templates</h3>
                            <span class="fh5co-date">June 8, 2016</span>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 animate-box" data-animate-effect="fadeIn">
                    <a class="fh5co-entry" href="#">
                        <figure>
                            <img src="{{ asset('/storage/images/slide_5.jpg') }}" alt="Free Website Template, Free HTML5 Bootstrap Template" class="img-responsive">
                        </figure>
                        <div class="fh5co-copy">
                            <h3>Handcrafted Using CSS3 &amp; HTML5</h3>
                            <span class="fh5co-date">June 8, 2016</span>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 animate-box" data-animate-effect="fadeIn">
                    <a class="fh5co-entry" href="#">
                        <figure>
                            <img src="{{ asset('/storage/images/slide_6.jpg') }}" alt="Free Website Template, Free HTML5 Bootstrap Template" class="img-responsive">
                        </figure>
                        <div class="fh5co-copy">
                            <h3>We Try To Update The Site Everyday</h3>
                            <span class="fh5co-date">June 8, 2016</span>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-12 text-center animate-box" data-animate-effect="fadeIn">
                    <p><a href="#" class="btn btn-primary btn-outline with-arrow">View More Posts <i class="icon-arrow-right"></i></a></p>
                </div>
            </div>
        </div>
    </div>

@endsection

