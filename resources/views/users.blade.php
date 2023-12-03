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
                                      <th scope="col">Name</th>
                                      <th scope="col">Total Files</th>
                                      <th scope="col">Request</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach (App\Models\User::all() as $user)
                                  @if ($user->id != Auth::id())
                                  <tr class="inner-box">
                                    <td>
                                        <div class="event-wrap">
                                            <h3>{{$user->fullname}}</h3>
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
{{--                                      <td>--}}
{{--                                        --}}{{-- {{$userRequests = App\Models\UserRequest::where('sender_id', $user->id)->orWhere('target_id', $user->id)->get()}} --}}
{{--                                        <div class="event-wrap">--}}
{{--                                            @if (Auth::user()->hasAcceptedRequestFor($user))--}}
{{--                                            <?php--}}
{{--                                            $userRequest = App\Models\UserRequest::where('sender_id', Auth::user()->id)--}}
{{--                                                ->where('target_id', $user->id)--}}
{{--                                                ->where('status', 1)--}}
{{--                                                ->first();--}}
{{--                                        ?>--}}
{{--                                        <h3>{{ $userRequest->key }}</h3>                                            @else--}}
{{--                                            <h3>-</h3>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                      <td>
                                        @if (Auth::user()->hasPendingRequestFor($user))
                                        <span>Pending</span>
                                    @elseif (Auth::user()->hasAcceptedRequestFor($user))
                                        <a href="/view/{{Auth::user()->incomingUserRequest($user)->id}}" style="color:blue;">View Files</a>
                                    @else
                                        <a href="/request/{{$user->id}}" style="color:blue;">Send Request</a>
                                    @endif
                                      </td>
                                  </tr>
                                  @endif
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
