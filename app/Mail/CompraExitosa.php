<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompraExitosa extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $orderDetails;
    public $appUrl;
    public $cupones;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderDetails,$cupones)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->appUrl = config('app.url');
        $this->cupones = $cupones;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@efiposdelivery.com.es')
            ->subject('Confirmación de Compra')
            ->view('emails.compra_exitosa')
            ->with(
                [
                        'orderNumber' => $this->order->id,
                        'orderItems' => $this->orderDetails,
                        'customerName' => $this->order->name,
                        'totalPaid' => $this->order->total_pagado,
                        'deliveryAddress' => $this->order->direccion,
                        'appUrl' => $this->appUrl, 
                        'cupones' => $this->cupones,
                        ]
            );
    }
}