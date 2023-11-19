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
                      <h2>Users</h2>
                  </div>
                  <p>
                      You can request to download files from other users here.
                  </p>
              </div>
          </div>
          <!-- /.col end-->
      </div><br>
      {{-- <div style="text-align: center">
          <form action="/upload" method="GET">

            <div class="btn btn-success btn-rounded">
                <input class="form-label text-white m-1" type="submit" value="Upload"/>
            </div>
          </form>
      </div> --}}
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
                                      <th scope="col">Username</th>
                                      <th scope="col">Total Files</th>
                                      <th scope="col">Request</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach (App\Models\User::all() as $user)
                                  <tr class="inner-box">
                                    <td>
                                        <div class="event-wrap">
                                            <h3>{{$user->username}}</h3>
                                        </div>
                                    </td>
                                      <td>
                                          <div class="event-wrap">

                                              <h3>
                                                @if($user->files)
                                                {{ $user->files->count() }}
                                                @else
                                                0
                                                @endif
                                              </h3>
                                          </div>
                                      </td>
                                      <td>
                                        <a href="{{ route('download_page', ['id' => $file->id]) }}" style="color:blue;">Send Request</a>
                                      </td>
                                  </tr>
                                  @endforeach
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