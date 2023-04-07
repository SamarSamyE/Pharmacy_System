<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\PatientAddress;
use App\Models\Pharmacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignPharmacy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }


    
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $orders = Order::where('pharmacy_id', Null)->get();

        foreach ($orders as $order) {
                $order->pharmacy_id = Pharmacy::where(
                'area_id', PatientAddress::find($order->patient_address_id)->area_id)
                ->orderby('priority', 'desc')
                ->first()
                ->id;
                $order->status= "Processing";
                $order->save();

    }
}
}
