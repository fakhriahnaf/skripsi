@extends('layouts.default')
@section('content')
<div class="card">
    <div class="card-header">
        <strong>Tambah QR Code Barang</strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('qr.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="barang_id" class="form-control-label">Nama Barang</label>
                
                    <select name="barang_id" id="selectedBarang" data-placeholder="Choose Barang..." tabindex="1" class="standardSelect @error('barang_id') is-invalid @enderror">
                        <option value="" label="default"></option>
                        @foreach ($barang_id as $barang)
                            <option value="{{ $barang->Id }}"> {{$barang->NamaBarang}}</option>
                        @endforeach
                    </select>
                   
                
                {{-- @error('barangs_id') <div class="text-muted">{{ $message }}</div> @enderror --}}
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Kode Barang</label></div>
                <div class="col-12 col-md-9">
                    <input readonly name="kode_barang" class="form-control-static"  id="info-kode-barang" value="Belum dipilih"> 
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Nama Barang</label></div>
                <div class="col-12 col-md-9">
                    <input readonly name="nama_barang" class="form-control-static"  id="info-nama-barang" value="Belum dipilih"> 
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Jenis Barang</label></div>
                <div class="col-12 col-md-9">
                    <input readonly name="jenis_barang" class="form-control-static" id="info-jenis-barang" value="Belum dipilih"> 
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Tanggal Pembelian</label></div>
                <div class="col-12 col-md-9">
                    <input readonly name="tanggal_pembelian" class="fKodeBarangorm-control-static" id="info-tahun-pembelian-barang" value="Belum dipilih"> 
                </div>
            </div>
            <div class="row form-group">
                <div class="col col-md-3"><label class=" form-control-label">Satuan Unit</label></div>
                <div class="col-12 col-md-9">
                    <input readonly name="satuan_barang" class="fKodeBarangorm-control-static" id="info-satuan-barang" value="Belum dipilih"> 
                </div>
            </div>

            <div class="form-grup">
                <button class="btn btn-primary btn-block" type="submit">Tambah Barcode Barang</button>
            </div>
        </form>
    </div>
</div>

{{-- <form action="{{ route('qr.store')}}" method="POST">
@csrf
<button type="submit">Buat</button>
</form> --}}
@endsection

@section('script')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script> --}}


<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="{{ asset("assets/js/lib/chosen/chosen.jquery.min.js") }}"></script>
<script src="{{ asset("assets/js/lib/chosen/chosen.jquery.min.js") }}"></script>



<script>
    var list_barang = @json($barang_id);

    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });

        jQuery('#selectedBarang').change(function () {
            let id = $('#selectedBarang option:selected').val()
            let curr = list_barang.find((v) => v.Id === id)
            let kode_barang = jQuery('#info-kode-barang')
            let nama_barang = jQuery('#info-nama-barang')
            let jenis_barang = jQuery('#info-jenis-barang')
            let tahun_pembelian_barang = jQuery('#info-tahun-pembelian-barang')
            let satuan_barang = jQuery('#info-satuan-barang')
            kode_barang.val(curr.KodeBarang)
            nama_barang.val(curr.NamaBarang)
            jenis_barang.val(curr.JenisBarang)
            tahun_pembelian_barang.val(curr.TanggalPembelian)
            satuan_barang.val(curr.SatuanBarang)
        })
    });
</script>
@endsection