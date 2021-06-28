@extends('layouts.default')
@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Daftar QR</h4>
                </div>
                <div class="card-body--">
                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr> 
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr> 
                                    <td>{{$item->KodeBarang}}</td>
                                    <td>{{$item->NamaBarang}}</td>
                                    <td>{{$item->JenisBarang}}</td>   
                                    <td>
                                        <a href="{{ route('qr.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('qr.print', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        {{-- <a href="#" class="btn btn-info btn-sm">
                                            <i class="fa fa-picture-o"></i>
                                        </a> --}}
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="#" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td></td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center p-5">Data tidak tersedia</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection