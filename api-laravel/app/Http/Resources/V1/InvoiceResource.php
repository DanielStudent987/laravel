<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    private array $types = ['C' => 'cartao', 'B' => 'boleto', 'P' => 'pix'];

    //formata o retorno em "json"
    public function toArray(Request $request): array
    {   
        $paid = $this->paid;
        return [
            'user' => [
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName
            ],
            'type' => $this->types[$this->type],
            'value' => 'R$ '.number_format($this->value, 2, ',', '.', ),
            'paid' => $paid ? 'pago' : 'nao pago;'
        ];
    }
}
