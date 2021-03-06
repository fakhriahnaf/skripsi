@extends('layouts.default')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Informasi Barang</h4>
                </div>
                @csrf
                <div class="card-body card-block">
                    @foreach ($items as $item)

                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Barang ID</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$item->barang_id}}</p>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Kode Barang</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$item->KodeBarang}}</p>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Nama Barang</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$item->NamaBarang}}</p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Satuan Barang</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$item->SatuanBarang}}</p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Tanggal Pembelian</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">{{$item->TanggalPembelian}}</p>
                        </div>
                    </div>

                    
                    @endforeach
                    <div>
                        QR Code
                        <div id="qrcode"></div>
                    </div>
                    <p></p>
                    <p></p>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-secondary btn-sm">Print Qr Code</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="/qrcode.min.js"></script>
    <script type="text/javascript">
        new QRCode(document.getElementById("qrcode"), "{{$id}}");

        console.log(@json($items))
    </script>
@endsection