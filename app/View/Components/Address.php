<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Component;

class Address extends Component
{

    public string $address;
    public string $state;
    public string $city;
    public string $postcode;

    public ViewErrorBag $errors;

    /**
     * Create a new component instance.
     * @throws ValidationException
     */
    public function __construct(
        ?ViewErrorBag $errors = new ViewErrorBag(),
        ?bool $validate = false,
        ?string $address = '',
        ?string $city = '',
        ?string $postcode = '',
        ?string $state = '',

    )
    {
        $this->errors = $errors;
        if( $validate === true ) {
            $this->validateInput($address, $city, $postcode, $state);
        }
        $this->address = $address;
        $this->city = $city ?? '';
        $this->postcode = $postcode ?? '';
        $this->state = $state ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.address',[
            'address' => $this->address,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'state' => $this->state,
            'errors' => $this->errors
        ]);
    }

    /**
     * @throws ValidationException
     */
    private function validateInput(string $address, ?string $city, ?string $postcode, ?string $state): void
    {
        $validator = Validator::make([
            'address' => $address,
            'city' => $city,
            'postcode' => $postcode,
            'state' => $state,
        ], [
            'address' => 'required|string',
            'city' => 'nullable|string|min:2',
            'postcode' =>  'nullable|regex:/^\d+-?\d+$/',
            'state' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function toJson(): false|string
    {
        return json_encode([
            'address' => $this->address,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'state' => $this->state
        ]);
    }

    public function fromJson(string $json_address): Address
    {
        $address = json_decode($json_address, true);
        $this->address = $address['address'];
        $this->city = $address['city'];
        $this->postcode = $address['postcode'];
        $this->state = $address['state'];
        return $this;
    }

    public function toString(): string
    {
        $return = '';
        $return .= $this->address ? $this->address:null;
        $return .= $this->city ? ', '.$this->city:null;
        $return .= $this->postcode ? ', '.$this->postcode:null;
        $return .= $this->state ? ', '.$this->state:null;
        return  $return;
    }
}
