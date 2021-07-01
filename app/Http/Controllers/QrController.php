<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qr;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;

use Barryvdh\DomPDF\Facade as PDF;

class QrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Qr::all();
        return view('qrcode.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $barang_id = Http::get('http://ipromise.dev.ipb.ac.id/api/apibarang');
        
        return view('qrcode.create')->with([
            'barang_id' => json_decode($barang_id)
        ]);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Qr::create([
            'barang_id' => $request->input('barang_id'),
            'KodeBarang' => $request->input('kode_barang'),
            'JenisBarang' => $request->input('jenis_barang'),
            'NamaBarang' => $request->input('nama_barang'),
            'TanggalPembelian' => $request->input('tanggal_pembelian'),
            'SatuanBarang' => $request->input('satuan_barang'),
        ]);

        return redirect()->route('qr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Qr::find([$id]);
        return view('qrcode.show', compact('items','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function print($id)
    {
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->generate($id));
        $qr = Qr::find([$id]);
        $pdf = PDF::loadView('qrcode.print', [
            'item' => $qr[0],
            'qrcode' => $qrcode
          ])->setPaper('a8', 'landscape');
        
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
