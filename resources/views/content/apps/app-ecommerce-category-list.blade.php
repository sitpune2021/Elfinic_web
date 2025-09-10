@extends('layouts/layoutMaster')

@section('title', 'Elfinic Product Category - Apps')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss',
'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/app-ecommerce.scss')
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/quill/katex.js',
'resources/assets/vendor/libs/quill/quill.js'])
@endsection

@section('page-script')
@vite('resources/assets/js/app-ecommerce-category-list.js')


@endsection

@section('content')
<div class="app-ecommerce-category">
  <!-- Category List Table -->
  <div class="card">
    <div class="card-datatable">
      <table class="datatables-category-list table">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th>Categories</th>
            <th>Status</th>
            <!-- <th class="text-nowrap text-sm-end">Total Products &nbsp;</th>
            <th class="text-nowrap text-sm-end">Total Earning</th> -->
            <th class="text-lg-center">Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- Offcanvas to add new customer -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceCategoryList"
    aria-labelledby="offcanvasEcommerceCategoryListLabel">
    <!-- Offcanvas Header -->
    <div class="offcanvas-header py-6">
      <h5 id="offcanvasEcommerceCategoryListLabel" class="offcanvas-title">Add Category</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- Offcanvas Body -->
    <div class="offcanvas-body border-top">
      <form id="categoryForm" action="{{ route('categoryProcess') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="description" id="description">
        <!-- Title -->
        <div class="mb-6 form-control-validation">
          <label class="form-label" for="name">Category name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" />
          <span class="text-danger error-text name_error"></span>
        </div>
        <!-- Slug -->
        <div class="mb-6 form-control-validation">
        <label class="form-label" for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug" />
        <span class="text-danger error-text slug_error"></span>
    </div>
        <!-- Image -->
        <div class="mb-6">
        <label class="form-label" for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image" />
        <span class="text-danger error-text image_error"></span>
    </div>

        <!-- Description -->
        <div class="mb-6">
          <label class="form-label">Description</label>
          <div class="form-control p-0 py-1">
            <div class="comment-editor border-0" id="ecommerce-category-description"></div>
            <div class="comment-toolbar border-0 rounded">
              <div class="d-flex justify-content-end">
                <span class="ql-formats me-0">
                  <button class="ql-bold"></button>
                  <button class="ql-italic"></button>
                  <button class="ql-underline"></button>
                  <button class="ql-list" value="ordered"></button>
                  <button class="ql-list" value="bullet"></button>
                  <button class="ql-link"></button>
                  <button class="ql-image"></button>
                </span>
              </div>
            </div>
          </div>
          <span class="text-danger error-text description_error"></span>
        </div>
        <!-- Status -->
        <div class="mb-6 ecommerce-select2-dropdown">
          <label class="form-label">Select category status</label>
          <select id="ecommerce-category-status" name="status" class="select2 form-select" data-placeholder="Select category status">
            <option value="">Select category status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <span class="text-danger error-text status_error"></span>
        </div>
        <!-- Submit and reset -->
        <div class="mb-6">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Add</button>
          <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Discard</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
<script>
  // Initialize Quill editor after including Quill JS
  var quill = new Quill('#ecommerce-category-description', {
      theme: 'snow',
      modules: {
          toolbar: '.comment-toolbar'
      }
  });

  // Update hidden input on every change
  quill.on('text-change', function() {
    alert("");
      var htmlContent = quill.root.innerHTML; // Get Quill content
      document.getElementById('description').value = htmlContent; // update hidden input
      console.log(htmlContent); // optional: debug in console
      // alert(htmlContent); // optional alert
  });
</script>


@endsection
