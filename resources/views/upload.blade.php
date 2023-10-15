@extends('layout')
@section('additional')
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

@section('container')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                @if(session('success'))
                echo $request;
                @else
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Upload File</h3>
              <form  id="registrationForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="mb-4 d-flex justify-content-center">
                        <img src="{{ asset('storage/img/file.png') }}" style="width: 300px;" id="previewImage" />
                    </div>
                    <div class="mb-4 d-flex justify-content-center">
                        <p id="file-title"></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                            <input type="file" name="file" accept=".jpg, .jpeg, .png, .pdf, .mp4" class="form-control d-none" id="customFile1" onchange="previewFile(event);"/>
                        </div>
                    </div><br>
                        <p>Select Encryption Type: </p>
                         <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                              AES
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                              RC4
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              DES
                            </label>
                          </div>                       
                </div><br>
                <input type="text" id="key" name="key" class="form-control form-control-lg" placeholder="Encryption Key"/><br>
                <div class="d-flex justify-content-center">
                  <div class="btn btn-primary btn-rounded">
                      <input class="form-label text-white m-1" type="submit" value="Submit"/>
                  </div>
              </div>
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})

@endsection

@section('script')
<script>
  // Function to preview the selected image
  function previewFile(event) {
          // Get the file input element
      var fileInput = document.getElementById("customFile1");

      // Get the selected file
      var selectedFile = fileInput.files[0];

      // Get the filename
      var filename = selectedFile.name;
      let h2 = document.getElementById("file-title");
      h2.innerHTML = filename;
  }

  // Automatically close flash messages with the "auto-close" class
  setTimeout(function() {
      document.querySelectorAll('.auto-close').forEach(function(element) {
          element.style.display = 'none'; // Hide the message
      });
  }, 5000); // 5000 milliseconds (5 seconds)
</script>
@endsection