<?php

namespace App\Http\Livewire;

use App\Cart\Contracts\CartInterface;
use App\Models\ShippingType;
use Livewire\Component;

class Checkout extends Component
{
    public $shippingTypes;

    public $shippingTypeId;

    public $accountForm = [
        'email' => ''
    ];

    public $shippingForm = [
        'address' => '',
        'city' => '',
        'postcode' => ''
    ];

    protected $validationAttributes = [
        'accountForm.email' => 'email address',
        'shippingForm.address' => 'shipping address',
        'shippingForm.city' => 'shipping city',
        'shippingForm.postcode' => 'shipping postal code',
    ];

    protected $messages = [
        'accountForm.email.required' => 'Your :attribute is required',
        'accountForm.email.unique' => 'Seems you already have an account. Please sign in to place an order.',
        'shippingForm.address.required' => 'Your :attribute is required',
        'shippingForm.city.required' => 'Your :attribute is required',
        'shippingForm.postcode.required' => 'Your :attribute is required',
    ];

    public function rules()
    {
        return [
            'accountForm.email' => 'required|email|max:255|unique:users,email' . (auth()->user() ? ',' . auth()->user()->id : ''),
            'shippingForm.address' => 'required|max:355',
            'shippingForm.city' => 'required|max:355',
            'shippingForm.postcode' => 'required|max:355',
            'shippingTypeId' => 'required|exists:shipping_types,id'
        ];
    }

    public function checkout()
    {
        $this->validate();
    }

    public function mount()
    {
        $this->shippingTypes = ShippingType::orderBy('price', 'asc')->get();

        $this->shippingTypeId = $this->shippingTypes->first()->id;

        if ($user = auth()->user()) {
            $this->accountForm['email'] = $user->email;
        }
    }

    public function getShippingTypeProperty()
    {
        return $this->shippingTypes->find($this->shippingTypeId);
    }

    public function getTotalProperty(CartInterface $cart)
    {
        return $cart->subtotal() + $this->shippingType->price;
    }

    public function render(CartInterface $cart)
    {
        return view('livewire.checkout', [
            'cart' => $cart
        ]);
    }
}
