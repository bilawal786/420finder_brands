@include("partials/head")

<div id="app">
  @include("partials/top-nav")

  <div class="content-wrapper">
    <div class="content-sidebar">
      @include('partials/business-sidebar')
    </div>
      <img src="{{asset('images/mobile-view.jpg')}}" style="display: none" class="mobile-view">

      <div class="content-main dashboard-content bg-light">

       @yield('content')

    </div>
</div>
</div>

@include("partials/footer")
