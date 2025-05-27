<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Vertical Layouts - Forms | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
   

    <!-- Fonts -->
  

    @include('Admin/common/header-links')

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('Admin/common/sidebar')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- BACK BUTTON -->
            <div class="mb-3 text-end">
                <a href="{{ asset('admin/newcourse') }}" class="btn btn-outline-primary btn-sm px-3" style="font-size: 14px; border-radius: 6px;">
                    ← Back
                </a>
            </div>

            <!-- Card -->
            <div class="card shadow-sm border-0 rounded-4" style="background-color: #fffdfc;">
                <div class="card-body py-5 px-4">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="60" alt="Icon" class="mb-3">
                        <h1 class="fw-bold" style="color: #6c5ce7;">Course Details</h1>
                        <p class="text-muted">Complete overview of this course's duration and pricing</p>
                    </div>

                    <!-- Course Name -->
                    <div class="mb-4">
                        <h4 class="text-secondary mb-2">Course Name:</h4>
                        <h5 class="fw-semibold" style="color: #2d3436;">{{ $data->course }}</h5>
                    </div>

                    <!-- Table Heading -->
                    <h5 class="fw-bold mb-3" style="color: #6c5ce7;">Course Details (Days & Price)</h5>

                    <!-- Styled Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle shadow-sm" style="background-color: #ffffff; border-radius: 12px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Days</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->Dayprice as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->days }}</td>
                                        <td>₹{{ number_format($item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>



  <!-- <a href="{{asset ('admin/newcourse') }}" class="btn btn-primary mt-4">BACK</a>      -->
  
</div>
    <div> </div>

    @include('Admin/common/footer-links')

  </body>
</html>