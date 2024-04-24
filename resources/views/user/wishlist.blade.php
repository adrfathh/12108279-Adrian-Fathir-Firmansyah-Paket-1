<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/img/favicon.png">
  <title>
    Perpustakaan Digital
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-100 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">PerpusDigital</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('user.books')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Books</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('user.wishlist')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Wishlist</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('user.borrowed')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Borrowed</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('user.review')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Review</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('user.history')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">History</span>
          </a>
        </li>
    </div>
    <div class="sidenav-footer mx-3" style="margin-top: 19rem;">
      <a class="btn btn-primary btn-sm mb-0 w-100" href="{{route('logout')}}" type="button">Log Out</a>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
      <table class="table mt-6"  style="text-align: center;">
        <thead>
          <tr>
            <th scope="col">cover</th>
            <th scope="col">Title</th>
            <th scope="col">Publisher</th>
            <th scope="col">Year Publish</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($books as $books)
          @php
            $hasBorrowed = $books->borrow->where('borrow_status', 'Dipinjam')->isNotEmpty();
          @endphp
          @if ($hasBorrowed)
            @if ($books->borrow->where('borrow_status', 'Dipinjam')->first()->user_id != Auth::user()->id)
            @else
              <tr>
                <td><img src="{{ asset('storage/book/z0Ska9SsdgGH2eq1BM2e6cCAzPz2Hwt5feaKq8w6.jpg') }}" style="height: 10rem;"></td>
                <td>{{$books -> title}}</td>
                <td>{{$books -> publisher}}</td>
                <td>{{$books -> year_publish}}</td>
                <td>{{$books -> category}}</td>
                <td class="d-flex flex-column">
                @if ($hasBorrowed)
                  @if ($books->borrow->where('borrow_status', 'Dipinjam')->first()->user_id != Auth::user()->id)
                    <form action="{{ route('user.borrow', $books -> id) }}" method="post">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $books -> id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="borrow_status" value="Dipinjam">
                    <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="return_date" value="-">
                    <button type="submit" class="btn btn-success" style="text-transform: none;">Borrow</button>
                    <!-- <input class="btn btn-success" type="submit" value="Borrow"> -->
                  </form>
                  @else
                  <form action="">
                      <input class="btn btn-danger" type="submit" value="Borrowed" disabled>
                    </form>
                  @endif
                @else
                  <form action="{{ route('user.borrow', $books -> id) }}" method="post">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $books -> id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="borrow_status" value="Dipinjam">
                    <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="return_date" value="-">
                    <button type="submit" class="btn btn-success" style="text-transform: none;">Borrow</button>
                    <!-- <input class="btn btn-success" type="submit" value="Borrow"> -->
                  </form>
                @endif
                  <!-- <a class="btn btn-primary" href="#" role="button">Review</a> -->
                  <form action="{{ route('user.review') }}" method="get">
                    @csrf
                    <input class="btn btn-primary" type="submit" value="Review">
                  </form>
                  <form action="{{ route('user.removeWishlist', $books->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input class="btn btn-danger" type="submit" value="Remove">
                  </form>
                </td>
              </tr>
            @endif
          @else
          <tr>
            <td><img src="{{ asset('storage/book/z0Ska9SsdgGH2eq1BM2e6cCAzPz2Hwt5feaKq8w6.jpg') }}" style="height: 10rem;"></td>
            <td>{{$books -> title}}</td>
            <td>{{$books -> publisher}}</td>
            <td>{{$books -> year_publish}}</td>
            <td>{{$books -> category}}</td>
            <td class="d-flex flex-column">
            @if ($hasBorrowed)
              @if ($books->borrow->where('borrow_status', 'Dipinjam')->first()->user_id != Auth::user()->id)
                <form action="">
                  <input class="btn btn-danger" type="submit" value="Unavailable" disabled>
                </form>
              @else
              <form action="{{ route('user.borrow', $books -> id) }}" method="post">
                @csrf
                <input type="hidden" name="book_id" value="{{ $books -> id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="borrow_status" value="Dipinjam">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="return_date" value="-">
                <button type="submit" class="btn btn-success" style="text-transform: none;">Borrow</button>
                <!-- <input class="btn btn-success" type="submit" value="Borrow"> -->
              </form>
              @endif
            @else
              <form action="{{ route('user.borrow', $books -> id) }}" method="post">
                @csrf
                <input type="hidden" name="book_id" value="{{ $books -> id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="borrow_status" value="Dipinjam">
                <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="return_date" value="-">
                <button type="submit" class="btn btn-success" style="text-transform: none;">Borrow</button>
                <!-- <input class="btn btn-success" type="submit" value="Borrow"> -->
              </form>
            @endif
              <!-- <a class="btn btn-primary" href="#" role="button">Review</a> -->
              <form action="{{ route('user.review') }}" method="get">
                @csrf
                <input class="btn btn-primary" type="submit" value="Review">
              </form>
              <form action="{{ route('user.removeWishlist', $books->id) }}" method="post">
                @csrf
                @method('delete')
                <input class="btn btn-danger" type="submit" value="Remove">
              </form>
            </td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>