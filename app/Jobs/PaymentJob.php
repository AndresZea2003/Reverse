<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $fila1;
    protected string $fila2;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $fila1, string $fila2)
    {
        $this->fila1 = $fila1;
        $this->fila2 = $fila2;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dump('Casilla 1 '. $this->fila1 . ', Casilla 2 '. $this->fila2);
    }
}
