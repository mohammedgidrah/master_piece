<?php

namespace App\Mail;

use App\Models\Billing;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillingDetailsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $billing;
    public $orderItems;

    /**
     * Create a new message instance.
     *
     * @param  Billing  $billing
     * @param  array  $orderItems
     * @return void
     */
    public function __construct(Billing $billing, $orderItems)
    {
        $this->billing = $billing;
        $this->orderItems = $orderItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.billing_details')
                    ->subject('Your Billing Details')
                    ->with([
                        'billing' => $this->billing,
                        'orderItems' => $this->orderItems,
                    ]);
    }
}
