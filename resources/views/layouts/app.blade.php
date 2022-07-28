@include("partials/head")

<div id="app">
  @include("partials/top-nav")

  <div class="content-wrapper">
    <div class="content-sidebar">
      @include('partials/business-sidebar')
    </div>
    <div class="content-main dashboard-content bg-light">

       @yield('content')

    </div>
</div>
</div>

@include("partials/footer")
