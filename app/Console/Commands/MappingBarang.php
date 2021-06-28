<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Qr;

class MappingBarang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapping:barang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command untuk mapping barang.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $this->info("Mulai menjalankan mapping barang...");

        $client = new Client();
        $url = "http://ipromise.dev.ipb.ac.id/api/apibarang";

        $this->info("Melakukan request ke alamat " . $url);
        $response = $client->request('GET', $url);

        $responseBody = json_decode($response->getBody());
        
        if(is_array($responseBody)) {
            
            foreach ($responseBody as $index => $value) {
                $qr = Qr::where('KodeBarang', $value->KodeBarang)->first();
                if($qr) {
                    $this->info("KodeBarang " . $value->KodeBarang . " sudah memiliki qr dengan id " . $qr->id);
                } else {
                    $qr = Qr::whereNull("KodeBarang")->first();
                    // $array = json_decode(json_encode($qr), true);
                    if($qr == null) continue;
                    
                    $qr->fill([
                        'KodeBarang' => $qr->KodeBarang,
                        'NamaBarang' => $qr->NamaBarang,
                        'JenisBarang' => $qr->JenisBarang,
                        'TanggalPembelian' => $qr->TanggalPembelian,
                        'SatuanUnit' => $qr->SatuanUnit,
                    ])->save();

                    $this->info("KodeBarang " . $value->KodeBarang . " dibuat baru dengan qr id " . $qr->id);
                }
            }
        }

    }
}
