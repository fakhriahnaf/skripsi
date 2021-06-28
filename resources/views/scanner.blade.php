<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="https://hmtiudinus.org/img/favicon.png?v1" type="image/x-icon" />
    <link rel="shortcut icon" href="https://hmtiudinus.org/img/favicon.png?v1" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> --}}
    <title>SPOT IT Admin Panel</title>

    <style>
      body{
        background-color: #fffef1;
        background-image: linear-gradient(rgba(0, 0, 0, 0) 1px, transparent 2px),
        linear-gradient(90deg, rgba(0, 0, 0, 0) 2px, transparent 1px),
        linear-gradient(rgba(0, 0, 0, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 0, 0, .1) 1px, transparent 1px);
        background-size: 100px 100px, 100px 100px, 30px 30px, 30px 30px;
        background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row  justify-content-center align-items-center mt-5" style="min-height: 80vh;">
          <div class="col-sm-6 mx-auto">
            <div class="embed-responsive embed-responsive-16by9">
              <video id="preview" class="embed-responsive-item"></video>
            </div>
          </div>
        </div>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        
        <script>
            M.AutoInit()
        </script>
    <script>

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
  
      scanner.addListener('scan', function (content) {
  
        console.log(content);
       
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
          $.ajax({
              type: "POST",
              url : "{{url('/qr-absent')}}",
              // url : "{{url('/check')}}/"+code,
              data: {content: content},
                  success: function(data) {
                    if (content != null){
                      $(location).attr('href', "{{url('/admin/QRScanner/absent')}}/"+content);
  
                    }else{
                      console.log('error');
                    }
                  }
              })
      });
  
      Instascan.Camera.getCameras().then(function (cameras) {
  
        if (cameras.length > 0) {
  
          scanner.start(cameras[0]);
  
        } else {
  
          console.error('No cameras found.');
  
        }
  
      }).catch(function (e) {
  
        console.error(e);
  
      });
  
    </script>


    @if (Session::has('status') && Session::get('status') == 'invalid')
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Ups!',
            text: 'Anda sudah melakukan aksi ini!',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    @elseif (Session::has('status') && Session::get('status') == 'success')
    <script>
        Swal.fire({
        icon: 'success',
        title: 'Yeay!',
        html: '{{ Session::get('id') }} <br> {{ Session::get('name') }}'
        })
    </script>
    @endif
  </body>
</html>


{{-- @include('layouts.default')
@section('content')
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="jquery.min.js" ><script/>
<script src="instascan.min.js" ><script/>

<body>
<div class='container'>
<div class="row justify-content-center mt-5">
<div class="col-md-5">
<div class="card-header bg-transparant mb-0"><h5 class="text-center"><span class="font-weight-bold text-primary">Scan</span></h5></div>
<div class='card-body'>

<video id='preview' width="300" height="300"></video>
<div class="form-group">
<input type="text" class='form-control'/>
</div>
</div>
</div>
</div>
</div>
</body>

<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        //console.log(content);
        $("#qrcode").val(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
</script>
@endsection

 --}}
