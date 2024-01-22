<div class="row mb-3">
    <div class="col-12 col-md-10 col-xxl-10">
        <label for="address" class="required">Address</label>
        <input type="text" class="form-control  @if ($errors->has('address')) is-invalid @endif"
               id="address"
               name="address"
               value="{{ $address }}"
               required>
        @if ($errors->has('address'))
            <span class="text-danger">{{ $errors->first('address') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 col-xxl-4 mb-3">
        <label for="city">City</label>
        <input type="text" class="form-control  @if ($errors->has('city')) is-invalid @endif"
               id="city"
               name="city"
               value="{{ $city }}">
        @if ($errors->has('city'))
            <span class="text-danger">{{ $errors->first('city') }}</span>
        @endif
    </div>
    <div class="col-12 col-md-6 col-xxl-4  mb-3">
        <label for="postcode">Postcode</label>
        <input type="text" class="form-control  @if ($errors->has('postcode')) is-invalid @endif"
               id="postcode"
               name="postcode"
               value="{{ $postcode }}">
        @if ($errors->has('postcode'))
            <span class="text-danger">{{ $errors->first('postcode') }}</span>
        @endif
    </div>
    <div class="col-12 col-md-6 col-xxl-4  mb-3">
        <label for="state">State</label>
        <input type="text" class="form-control  @if ($errors->has('state')) is-invalid @endif"
               id="state"
               name="state"
               value="{{ $state }}">
        @if ($errors->has('state'))
            <span class="text-danger">{{ $errors->first('state') }}</span>
        @endif
    </div>
</div>
