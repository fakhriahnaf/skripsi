<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qr;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
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
        // $client = new Client(); //GuzzleHttp\Client
        // $url = "http://ipromise.dev.ipb.ac.id/api/apibarang";


        // $barang_id = $client->request('GET', $url, [
        //     'verify'  => false,
        // ]);

        // $responseBody = json_decode($barang_id->getBody());
        
        // if(is_array($responseBody)) {
            
        //     foreach ($responseBody as $index => $value) {
        //         $qr = Qr::where('KodeBarang', $value->KodeBarang)->first();
        //         if($qr) {
        //             $this->info("KodeBarang " . $value->KodeBarang . " sudah memiliki qr dengan id " . $qr->id);
        //         } else {
        //             $qr = Qr::whereNull("KodeBarang")->first();
        //             // $array = json_decode(json_encode($qr), true);
        //             if($qr == null) continue;
                    
        //             $qr->fill([
        //                 'KodeBarang' => $qr->KodeBarang,
        //                 'NamaBarang' => $qr->NamaBarang,
        //                 'JenisBarang' => $qr->JenisBarang,
        //                 'TanggalPembelian' => $qr->TanggalPembelian,
        //                 'SatuanUnit' => $qr->SatuanUnit,
        //             ])->save();

        //             $this->info("KodeBarang " . $value->KodeBarang . " dibuat baru dengan qr id " . $qr->id);
        //         }
        //     }
        // }
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

        return redirect()->back();
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
        $items = Qr::find([$id]);
        $pdf = PDF::loadView('qrcode.print', [
            'item' => $items[0],
          ])->setPaper('a6', 'portrait');
        $pathfile = 'public' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR;
        Storage::put($pathfile . $items[0]->id . '.pdf', $pdf->output());
        return response()->download(storage_path('app' . DIRECTORY_SEPARATOR . $pathfile), $items[0]->id . '.pdf')->deleteFileAfterSend();
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
