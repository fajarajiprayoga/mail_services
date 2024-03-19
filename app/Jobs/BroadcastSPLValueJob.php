<?php

namespace App\Jobs;

use App\Mail\BroadcastSPLValue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class BroadcastSPLValueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $username;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $username, $data)
    {
        $this->email = $email;
        $this->username = $username;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('mails.broadcast_spl_value', [
            'data' => $this->data
        ]);

        $pdf->get_canvas()->get_cpdf()->setEncryption('password', '', array());

        if (app()->environment('local')) {
            $pdf_path = "storage/app/public/broadcast_spl_value/alamak.pdf";
        } else {
            //Ubuntu
            $pdf_path = "var/www/html/storage/public/broadcast_spl_value/alamak.pdf";
        }
        
        $pdf->save($pdf_path);

        Mail::to($this->email, $this->username)->send(new BroadcastSPLValue($pdf_path));
    }
}
