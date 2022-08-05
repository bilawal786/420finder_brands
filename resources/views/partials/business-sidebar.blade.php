@if(empty(session('business_id')))
    <script>
        window.location.href = "{{route('login')}}";
    </script>
@endif

<ul id="businesssidebar" class="list-group h-100 bg-dark">
  <li class="list-group-item py-4 border-bottom">
    <a class="text-white"><i class="fas fa-user-circle pe-2" style="font-size: 20px;"></i> Hi, {{ session('business_name') }}</a>
  </li>
  <li class="list-group-item">
    <a href="{{ route('index') }}" class="text-white"><i class="fas fa-chart-line"></i> &nbsp; Dashboard</a>
  </li>

  <li class="list-group-item">
    <a href="{{ route('dashboardbrands') }}" class="text-white"><i class="fas fa-chart-line"></i> &nbsp; Brands</a>
  </li>

  <li class="list-group-item">
    <a href="{{ route('stores') }}" class="text-white"><i class="fas fa-chart-line"></i> &nbsp; Businesses</a>
  </li>

  <li class="list-group-item">
    <a href="{{ route('businessaccountsettings') }}" class="text-white"><i class="fas fa-cog"></i>  Account settings</a>
  </li>
  <li class="list-group-item">
    <a href="{{ route('businesslogout') }}" class="text-white" onclick="return confirm('Are you sure you want to logout?');"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a>
  </li>
</ul>
