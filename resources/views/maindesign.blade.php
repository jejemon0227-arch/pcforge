<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="front/images/favicon.png" type="image/x-icon">

    <title>PC FORGE</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <link rel="stylesheet" type="text/css" href="front/css/bootstrap.css" />

    <link href="front/css/style.css" rel="stylesheet" />
    <link href="front/css/responsive.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <style>
        /* Navbar Custom Styles - FIXED */
        .navbar-nav .nav-link {
            color: #000000ff !important;
            padding: 10px 15px !important;
            transition: all 0.3s ease;
            font-size: 16px;
            position: relative;
            display: block;
            text-decoration: none;
        }

        .navbar-nav .nav-link:hover {
            color: #ff4d00 !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #ff4d00 !important;
            font-weight: 500;
        }

        .navbar-nav .nav-item.active .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 15px;
            right: 15px;
            height: 2px;
            background: #ff4d00;
            border-radius: 2px;
        }

        /* Ensure all nav items are visible */
        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .navbar-nav .nav-item {
            margin: 0 5px;
        }

        .navbar-nav .nav-link i {
            margin-right: 5px;
            color: inherit;
        }

        /* User option styles */
        .user-option {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-option a {
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-option a:hover {
            color: #ff4d00;
            transform: translateY(-2px);
        }

        .cart-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4d00;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Navbar container */
        .navbar-collapse {
            justify-content: space-between;
        }

        /* Ensure navbar is properly styled */
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.95) !important;
        }

        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:focus {
            color: #ff4d00 !important;
        }

        /* Responsive Navbar */
        @media (max-width: 991px) {
            .navbar-nav {
                text-align: center;
                padding: 20px 0;
                margin-bottom: 15px;
                width: 100%;
                flex-direction: column;
            }

            .navbar-nav .nav-item {
                margin: 8px 0;
                width: 100%;
            }

            .navbar-nav .nav-link {
                padding: 12px 0 !important;
                display: inline-block;
            }

            .user-option {
                justify-content: center;
                padding-bottom: 20px;
                flex-wrap: wrap;
                gap: 15px;
                width: 100%;
            }

            .navbar-nav .nav-item.active .nav-link::after {
                left: 50%;
                right: 50%;
                transform: translateX(-50%);
                width: 50px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 24px !important;
            }

            .user-option {
                flex-direction: column;
                gap: 10px;
            }

            .user-option a {
                justify-content: center;
            }
        }

        /* Ensure navbar is visible on mobile */
        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .navbar-toggler:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 77, 0, 0.25);
        }

        /* Make sure navbar has proper background */
        .navbar-dark {
            background-color: rgba(26, 26, 26, 0.95) !important;
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <header class="header_section">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <span style="color: #ff4d00;">PC</span> FORGE
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('index') }}">
                                    <i class="fas fa-home me-1"></i> Home
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('shop') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('shop') }}">
                                    <i class="fas fa-shopping-cart me-1"></i> Shop
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('whyus') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('whyus') }}">
                                    <i class="fas fa-star me-1"></i> Why Us
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('contact.form') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('contact.form') }}">
                                    <i class="fas fa-phone me-1"></i> Contact
                                </a>
                            </li>
                        </ul>

                        <div class="user-option">
                            @if(Auth::check())
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Login</span>
                                </a>
                                <a href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Signup</span>
                                </a>
                            @endif

                            <a href="{{ route('cartproducts') }}" class="cart-icon">
                                <i class="fas fa-shopping-bag" style="font-size: 20px;"></i>
                                @if(isset($count) && $count > 0)
                                    <span class="cart-badge">{{ $count }}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <section class="slider_section"
            style="background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%); padding: 100px 0;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="detail-box" style="color: #fff;">
                            <h1 style="font-size: 48px; font-weight: bold; margin-bottom: 30px;">
                                FORGE YOUR <span style="color: #ff4d00;">DOMINANCE</span>
                            </h1>
                            <h2 style="font-size: 32px; margin-bottom: 20px;">
                                Where Elite Performance is Forged
                            </h2>
                            <p style="font-size: 18px; line-height: 1.8; margin-bottom: 30px;">
                                "We don't just build computers—we forge weapons of digital warfare.
                                From beast-mode components to custom rigs built for domination,
                                we craft machines that crush lag, obliterate limits, and annihilate the competition.
                                If you want real performance, this is where champions are made."
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('shop') }}" class="btn btn-primary mr-3"
                                    style="background: #ff4d00; border: none; padding: 12px 30px; font-size: 18px;">
                                    <i class="fas fa-fire"></i> FORGE NOW
                                </a>
                                <a href="{{ route('contact.form') }}" class="btn btn-outline-light"
                                    style="padding: 12px 30px; font-size: 18px;">
                                    <i class="fas fa-bolt"></i> CONSULT FORGE
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="img-box text-center">
                            <img src="front/images/image3.jpeg" alt="PC Forge"
                                style="max-width: 100%; border-radius: 10px; box-shadow: 0 20px 40px rgba(0,0,0,0.5);" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <main>
        <section class="shop_section layout_padding" style="min-height: 500px;">
            <div class="container">
                @yield('index')
                @yield('product_details')
                @yield('all_products')
                @yield('viewcart_products')
                @yield('stripe_view')
                @yield('why_us')
                @yield('contact')

                @hasSection('content')
                    @yield('content')
                @else
                    <div class="text-center py-5">
                        <h2>Welcome to PC FORGE</h2>
                        <p>Your ultimate destination for high-performance gaming rigs and components.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <footer style="background: #1a1a1a; color: #fff; padding: 50px 0; margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 style="color: #ff4d00; margin-bottom: 20px;">PC FORGE</h4>
                    <p>Where elite gaming machines are forged. We build computers that dominate.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h4 style="color: #ff4d00; margin-bottom: 20px;">Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('index') }}" style="color: #fff; text-decoration: none;">Home</a></li>
                        <li><a href="{{ route('shop') }}" style="color: #fff; text-decoration: none;">Shop</a></li>
                        <li><a href="{{ route('whyus') }}" style="color: #fff; text-decoration: none;">Why Choose Us</a>
                        </li>
                        <li><a href="{{ route('contact.form') }}" style="color: #fff; text-decoration: none;">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h4 style="color: #ff4d00; margin-bottom: 20px;">Contact Info</h4>
                    <p><i class="fas fa-map-marker-alt mr-2"></i> Forge Street, Tech District</p>
                    <p><i class="fas fa-phone mr-2"></i> (123) 456-7890</p>
                    <p><i class="fas fa-envelope mr-2"></i> forge@pcforge.com</p>
                </div>
            </div>
            <hr style="background: #444;">
            <div class="text-center mt-4">
                <p style="margin: 0; font-size: 16px; font-weight: bold;">
                    &copy; 2024 <span style="color: #ff4d00;">PC FORGE</span> - Forge Your Dominance
                </p>
            </div>
        </div>
    </footer>

    <script src="front/js/jquery-3.4.1.min.js"></script>
    <script src="front/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="front/js/custom.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');

                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });

        // Navbar fixes
        $(document).ready(function() {
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {
                        window.location.hash = hash;
                    });
                }
            });

            // Fix for mobile navbar closing when clicking a link
            $('.navbar-nav .nav-link').on('click', function() {
                if ($(window).width() < 992) {
                    $('.navbar-collapse').collapse('hide');
                }
            });

            // Force navbar links to be visible
            $('.navbar-nav .nav-link').css({
                'color': '#ffffff',
                'opacity': '1'
            });

            // Debug: Log navbar state
            console.log('Navbar items:', $('.navbar-nav .nav-link').length);
            $('.navbar-nav .nav-link').each(function() {
                console.log('Nav link:', $(this).text(), 'Color:', $(this).css('color'));
            });
        });
    </script>
</body>

</html>