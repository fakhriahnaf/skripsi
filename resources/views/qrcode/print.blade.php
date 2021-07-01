<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $item->NamaBarang}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            font-size: 8px;
        }
    </style>
</head>
<body>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <img src="data:image/svg;base64, {!! $qrcode !!}">
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">Property Of IPB</span></div>
                            <div class="stat-heading">{{ $item->KodeBarang}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    window.addEventListener("load", window.print());
</script>
</html>
