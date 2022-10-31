{{--
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3><img src="{{ asset('assets/img/logo.png') }}" alt="" style="width: 200px;"></h3>
            <p class="pt-2">
              A community connecting cannabis consumers, patients, retailers, doctors, and brands <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('index') }}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('deals') }}">Deals</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacypolicy') }}">Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('dispensaries') }}" target="_blank">Dispensaries</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('deliveries') }}">Deliveries</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('desktop-map') }}">Maps</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('brands') }}">Brands</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('products.index') }}">Products</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Legal</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('termsofuse') }}">Terms of Use</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('cookiepolicy') }}">Cookie Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('referalprogram') }}">Referral Program</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-newsletter">
            <div class="bg-dark p-4 shadow" style="border-radius: 15px;background: linear-gradient(to bottom, #f8971c, #000000);">
              <h4 class="text-white">Businesses</h4>
              <div class="d-grid">
                <a href="{{ route('business1') }}" class="text-white pb-2">Get Started</a>
                <a href="{{ route('login') }}" class="text-white pb-2">Login as a Business</a>
                <a href="{{ route('addabusiness') }}" class="text-white pb-2">Add a business</a>
                <a href="https://dispensaries.420finder.net/" target="_blank" class="text-white pb-2">Login as dispensaries</a>
                <a href="{{ route('login') }}" class="text-white pb-2">Login as brands</a>
                <a href="https://deliveries.420finder.net/" target="_blank" class="text-white pb-2">Login as deliveries</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container d-md-flex py-4">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>420finder</span></strong>. All Rights Reserved.
        </div>
        <div class="credits">
          Designed & Developed By <a href="https://www.codecreatives.org/" target="_blank">Code Creatives</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer --> --}}
<!-- <div id="preloader"></div> -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
@yield('star-rating')
@stack('scripts')
<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/toast.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}")
    @endif
    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}")
    @endif
    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}")
    @endif
</script>
<!-- Edit Profile -->
<script type="text/javascript">
    // Business Calls
    $("#updatefirstname").click(function () {
        var first_name = $("#editfirstname").val();
        if (first_name == '') {
            alert('Delivery Address should not be empty.');
        } else {
            $("#updatefirstname").addClass('disabled');
            $("#updatefirstname .spinner-border").css('display', 'inherit');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updatefirstname') }}",
                method: "POST",
                data: {first_name: first_name},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        $("#updatefirstname .spinner-border").css('display', 'none');
                        $("#updatefirstname").removeClass('disabled');
                        toastr.info(response.message);
                        location.reload();
                    } else {
                        $("#updatefirstname").removeClass('disabled');
                        $("#updatefirstname .spinner-border").css('display', 'none');
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    $("#updatelastname").click(function () {
        var last_name = $("#editlastname").val();
        if (last_name == '') {
            alert('Delivery Address should not be empty.');
        } else {
            $("#updatelastname").addClass('disabled');
            $("#updatelastname .spinner-border").css('display', 'inherit');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updatelastname') }}",
                method: "POST",
                data: {last_name: last_name},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        $("#updatelastname .spinner-border").css('display', 'none');
                        $("#updatelastname").removeClass('disabled');
                        toastr.info(response.message);
                        location.reload();
                    } else {
                        $("#updatelastname").removeClass('disabled');
                        $("#updatelastname .spinner-border").css('display', 'none');
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    $("#updatephonenumber").click(function () {
        var phone_number = $("#editphonenumber").val();
        if (phone_number == '') {
            alert('Delivery Address should not be empty.');
        } else {
            $("#updatephonenumber").addClass('disabled');
            $("#updatephonenumber .spinner-border").css('display', 'inherit');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updatephonenumber') }}",
                method: "POST",
                data: {phone_number: phone_number},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        $("#updatephonenumber .spinner-border").css('display', 'none');
                        $("#updatephonenumber").removeClass('disabled');
                        toastr.info(response.message);
                        location.reload();
                    } else {
                        $("#updatephonenumber").removeClass('disabled');
                        $("#updatephonenumber .spinner-border").css('display', 'none');
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    $("#updateaddresslineone").click(function () {
        var address_line_1 = $("#editaddressline1").val();
        if (address_line_1 == '') {
            alert('Address Line 1 should not be empty.');
        } else {
            $("#updateaddresslineone").addClass('disabled');
            $("#updateaddresslineone .spinner-border").css('display', 'inherit');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updateaddresslineone') }}",
                method: "POST",
                data: {address_line_1: address_line_1},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        $("#updateaddresslineone .spinner-border").css('display', 'none');
                        $("#updateaddresslineone").removeClass('disabled');
                        toastr.info(response.message);
                        location.reload();
                    } else {
                        $("#updateaddresslineone").removeClass('disabled');
                        $("#updateaddresslineone .spinner-border").css('display', 'none');
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    $("#updateaddresslinetwo").click(function () {
        var address_line_2 = $("#editaddressline2").val();
        if (address_line_2 == '') {
            alert('Address Line 2 should not be empty.');
        } else {
            $("#updateaddresslinetwo").addClass('disabled');
            $("#updateaddresslinetwo .spinner-border").css('display', 'inherit');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updateaddresslinetwo') }}",
                method: "POST",
                data: {address_line_2: address_line_2},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        $("#updateaddresslinetwo .spinner-border").css('display', 'none');
                        $("#updateaddresslinetwo").removeClass('disabled');
                        toastr.info(response.message);
                        location.reload();
                    } else {
                        $("#updateaddresslinetwo").removeClass('disabled');
                        $("#updateaddresslinetwo .spinner-border").css('display', 'none');
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    $("#updatewebsite").click(function () {
        var website = $("#editwebsite").val();
        if (website == '') {
            alert('Website url should not be empty.');
        } else {
            $("#updatewebsite").addClass('disabled');
            $("#updatewebsite .spinner-border").css('display', 'inherit');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('updatewebsite') }}",
                method: "POST",
                data: {website: website},
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.statuscode == 200) {
                        $("#updatewebsite .spinner-border").css('display', 'none');
                        $("#updatewebsite").removeClass('disabled');
                        toastr.info(response.message);
                        location.reload();
                    } else {
                        $("#updatewebsite").removeClass('disabled');
                        $("#updatewebsite .spinner-border").css('display', 'none');
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
    $(".editfeed").click(function () {
        var feed_id = $(this).attr('rel');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('getfeedsingle') }}",
            method: "POST",
            data: {feed_id: feed_id},
            success: function (data) {
                var response = JSON.parse(data);
                console.log(data);
                if (response.statuscode == 200) {
                    $("#feed_id").val(response.feed_id);
                    $("#feeImage").attr('src', response.image);
                    $("#feedDescription").val(response.description);
                } else {
                    toastr.error('Please try again.');
                }
            }
        });
    });
    $(".categoriespage").click(function () {
        var category_id = $(this).val();
        var maincat = $(this).attr('rel');
        $("#categoryTypes").addClass('loader');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('gettypesubcategories') }}",
            method: "POST",
            data: {category_id: category_id},
            success: function (data) {
                var response = JSON.parse(data);
                // console.log(data);
                if (response.statuscode == 200) {
                    $("#categoryTypes").html(response.data);
                    $("#categoryTypes").removeClass('loader');
                    $(".selectedcats").html('');
                    $(".selectedcats").html(maincat + ', ');
                } else {
                    $("#categoryTypes").removeClass('loader');
                    $("#categoryTypes").html("Something went wrong.");
                }
            }
        });
    });
    // Product Single Page
    $(".galleryImage").click(function () {
        var url = $(this).attr('src');
        $("#productFeatured").attr('src', url);
    });
    // Manage Verifications
    $(".viewrequestedproducts").click(function () {
        var request_id = $(this).attr('rel');
        $("#requestedproducts").modal('show');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('getrequestedproductslist') }}",
            method: "POST",
            data: {request_id: request_id},
            success: function (data) {
                console.log(data);
                $("#reqproducts").html(data);
            }
        });
    });
</script>
{{-- MENU TOGGLE --}}
<script>
    let menuToggleBtn = document.querySelector('.menu-toggle-btn');
    let contentSidebar = document.querySelector('.content-wrapper .content-sidebar');
    let contentMain = document.querySelector('.content-wrapper .content-main');
    let icon = document.querySelector('.menu-toggle-btn i');
    menuToggleBtn.onclick = function () {
        contentSidebar.classList.toggle('active');
        contentMain.classList.toggle('active');
        if (icon.classList.contains('lnr-arrow-left-circle')) {
            icon.classList.remove('lnr-arrow-left-circle');
            icon.classList.add('lnr-arrow-right-circle');
        } else {
            icon.classList.add('lnr-arrow-left-circle');
            icon.classList.remove('lnr-arrow-right-circle');
        }
    }
    if (window.innerWidth < 1025) {
        icon.classList.remove('lnr-arrow-left-circle');
        icon.classList.add('lnr-arrow-right-circle');
    }
    // NAV DROPDOWN
    $(function () {
        $('.dropdown-ul li .drop-btn').on('click', function () {
            $('.dropdown-ul li .items').toggleClass('show');
        });
        $(document).click(function (event) {
            var $target = $(event.target);
            if (!$target.closest('.dropdown-ul li.drop-li').length &&
                $('.dropdown-ul li.drop-li .items').hasClass("show")) {
                $('.dropdown-ul li .items').removeClass('show');
            }
        });
    });
</script>
