<?php

namespace App\Jobs;
use App\Models\Address;
use App\Models\AddressDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;


class ProcessAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $addresses = Address::all();

        foreach($addresses as $address) {
            
            $status = '000';
            $body   = '';

            try {
                $response = Http::timeout(5)->get($address->description);
                $status   = $response->status();
                $body     = utf8_encode($response->body());
            } catch (\Exception $e) {
                //throw $th;
                $body = $e->getMessage();
            }

            AddressDetail::create([
                'address_id' => $address->id,
                'status'     => $status,
                'body'       => $body
            ]);
        }
    }
}
