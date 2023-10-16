@extends('layout')
@section('additional')
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

@section('container')
<div class="event-schedule-area-two bg-color pad100">   
  <div class="container">
      <div class="dropup position-absolute bottom-0 end-0 rounded-circle m-5">
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="#">...</a>
            </li>
          </ul>
        </div> 
      <div class="row">
          <div class="col-lg-12">
              <div class="section-title text-center">
                  <div class="title-text">
                      <h2>SecureVault</h2>
                  </div>
                  <p>
                      Here are your files<br />
                      Don't worry about the security! just Worry about your future LOL!
                  </p>
              </div>
          </div>
          <!-- /.col end-->
      </div><br>
      <div style="text-align: center">
          <form action="/upload" method="GET">
            <div class="btn btn-success btn-rounded">
                <input class="form-label text-white m-1" type="submit" value="Upload"/>
            </div>
          </form>
      </div>
      <br>
      <!-- row end-->
      <div class="row">
          <div class="col-lg-12">
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade active show" id="home" role="tabpanel">
                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th class="text-center" scope="col">Upload Date</th>
                                      <th scope="col">Type</th>
                                      <th scope="col">Filename</th>
                                      <th scope="col">Download</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @if($files)
                                  @foreach ($files as $file)
                                  <tr class="inner-box">
                                      <th scope="row">
                                          <div class="event-date">
                                              <p>{{ $file->created_at->format('Y-m-d') }}</p>
                                          </div>
                                      </th>
                                      <td>
                                          <div class="event-img">
                                            @if($file->file_extension == 'mp4')
                                            <img src="{{ asset('storage/img/mp4.png') }}"
                                            alt="example placeholder" style="width: 100px;" id=" alt="" />
                                            @elseif($file->file_extension == 'pdf')
                                            <img src="{{ asset('storage/img/pdf.png') }}"
                                            alt="example placeholder" style="width: 100px;" id=" alt="" />
                                            @elseif($file->file_extension == 'png' || $file->file_extension == 'jpg' || $file->file_extension == 'jpeg')
                                            <img src="{{ asset('storage/img/png.png') }}"
                                            alt="example placeholder" style="width: 100px;" id=" alt="" />
                                            @else
                                            <img src="{{ asset('storage/img/file.png') }}"
                                            alt="example placeholder" style="width: 100px;" id=" alt="" />
                                            @endif
                                          </div>
                                      </td>
                                      <td>
                                          <div class="event-wrap">
                                              <h3>{{$file->filename}}</h3>
                                          </div>
                                      </td>
                                      <td>
                                        <a href="{{ route('download_page', ['id' => $file->id]) }}" style="color:blue;">Download</a>
                                      </td>
                                  </tr>
                                  @endforeach
                                @endif
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /col end-->
      </div>
      <!-- /row end-->
  </div>
</div>
@endsection

@section('script')
<script>
    const buttons = document.querySelectorAll('.download-button');

    /*
    buttons.forEach(function(button) {
        let attr = button.getAttribute('data-value');

        buttons[i].addEventListener('click', function() {            // Wrap the click handler in a function to create a closure
            const value = attr;
            console.log(value);
            const userInput = prompt('Enter the key:');
            if (userInput !== null) {
                // Redirect to the controller with the value and user input as query parameters
                window.location.href = "/download?value=" + value + "&input=" + encodeURIComponent(userInput);
            }
        });
    });
    */
</script>
@endsection