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
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

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


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Add new course</h5> 
                   
                    </div>
                    <div class="card-body ">
                        <form action="{{route('add-store-newcourse')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Course Name -->
                            <div class="mb-3 d-flex align-items-start gap-3">
                                <div>
                                    <label class="form-label text-danger fw-bold ">Course Name</label>
                                    <input type="text" class="form-control" name="course" />
                                    @error('course')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                        
                                <!-- Days + Price Input + Add button -->
                                <div class="mb-3 col-md-6 col-lg-6 col-12">
                                    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
                                    <!-- <label for="image " class="form-label">
                                        Days and Price </label><span class="required">*</span> -->

                                    <div class="row">
                                        <div class="col-lg-4 col-6 col-md-5"><label for="image "
                                                class="form-label">
                                                Days </label><span class="required">*</span></div>
                                        <div class="col-lg-4 col-6 col-md-5 "><label for="image "
                                                class="form-label ">
                                                Price </label><span class="required">*</span></div>

                                    </div>

                                    <div id="req_input" class="datainputs">

                                        <div class="row mb-3">
                                            <div class="col-md-5 col-6 col-lg-4">
                                                <input name="days[]" id="days" placeholder="Enter Days"
                                                    class="form-control" type="number" min="1">
                                                @error('days.*')
                                                <div class="text-danger"> The Days field is
                                                    required.</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5 col-6 col-lg-4">
                                                <input name="price[]" id="price"
                                                    placeholder="Enter Price" class="form-control"
                                                    type="text">
                                                @error('price.*')
                                                <div class="text-danger">The Price field is
                                                    required.</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-1 text-center  text-lg-end">
                                                <a href="#" id="addmore"
                                                    class="add_input btn btn-primary    mt-2 mt-lg-0 ">Add
                                                </a>

                                               
                                            
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                           
                                <script>
                                $(document).ready(function() {
                                    // Add more input rows
                                    $("#addmore").click(function(e) {
                                        e
                                            .preventDefault(); // Prevent default action of link
                                        $("#req_input").append(
                                            '<div class="row mb-3">' +
                                            '<div class="col-md-4 col-6 col-lg-4 ">' +
                                            '<input name="days[]" id="days" placeholder="Enter Days" class="form-control" type="number">' +
                                            '</div>' +
                                            '<div class="col-md-4 col-6 col-lg-4">' +
                                            '<input name="price[]" id="price" placeholder="Enter Price" class="form-control" type="text">' +
                                            '</div>' +
                                            '<div class="col-md-1 col-lg-1 text-center  text-lg-end">' +
                                            '<input type="button" class="inputRemove btn btn-danger mt-2 mt-lg-0 " value="Remove" />' +
                                            '</div>' +
                                            '</div>'
                                        );
                                    });

                                    // Remove individual row
                                    $('body').on('click', '.inputRemove', function() {
                                        $(this).closest('.row').remove();
                                    });

                                    // Remove all rows
                                    $("#removeall").click(function(e) {
                                        e
                                            .preventDefault(); // Prevent default action of link
                                        $("#req_input")
                                            .empty(); // Clears all rows within #req_input
                                    });
                                });
                                </script>
                        
                        
                    </div>
                   <button type="submit" class="btn btn-primary">Send</button>
                  </div>
                </div>
            
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
           

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    @include('Admin/common/footer-links')

  </body>
</html>