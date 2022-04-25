<?php

namespace App\Http\Livewire;

use App\Cart\Contracts\CartInterface;
use Livewire\Component;

class CartItem extends Component
{
    public $variation;
    public $quantity;

    public function mount()
    {
        $this->quantity = $this->variation->pivot->quantity;
    }

    public function updatedQuantity($quantity)
    {
        app(CartInterface::class)->changeQuantity($this->variation, $quantity);

        $this->emit('cart.update');

        $this->dispatchBrowserEvent('notification', [
            'body' => 'Quantity updated'
        ]);
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
