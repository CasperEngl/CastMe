@extends('layouts.master')
@section('content')
<form action="{{ route('user.subscription.swap') }}" method="POST" id="payment-form">
<form action="{{ route('user.subscription') }}" method="POST" id="payment-form">
  <div class="card">
    <div class="card-body">
      <h2 class="page-header">{{ ucfirst(__('subscription')) }}</h2>

      <!--
 /PHASES INTEGRATION AREA START
 -->

      <button class="card-footer btn btn-castme" type="submit">
      {{ ucfirst(__('subscribe start')) }}
    </button>

    <button class="card-footer btn btn-castme" type="submit">
      {{ ucfirst(__('subscribe end')) }}
    </button>

    <section class="mt-4 mb-0">

<h2 class="text-center">Abonnements detaljer</h2>
   <p class="text-center">
     Dit abonnement slutter d. XX.XX.XXXX
   </p>
</section>

        </div>
    </div>
</div>


<!--
 /PHASES INTEGRATION AREA END
 -->

<!--
 /STRIPE HIDE START
 -->
<div class="display-none">
  <div class="card">
    <div class="card-body">
      <h2 class="page-header">{{ ucfirst(__('subscription')) }}</h2>


      <script src="https://js.stripe.com/v3/"></script>
      
      <div class="row">
        <div class="col-sm-4">
          <ul class="pagination">
            <li class="page-item w-100 d-flex justify-content-center">
              <label for="month-2" class="page-link w-100 text-center">2 {{ __('months') }} - 179 DKK</label>
            </li>
            <li class="page-item w-100 d-flex justify-content-center">
              <label for="month-3" class="page-link w-100 text-center">3 {{ __('months') }} - 279 DKK</label>
            </li>
            <li class="page-item w-100 d-flex justify-content-center">
              <label for="month-6" class="page-link w-100 text-center">6 {{ __('months') }} - 449 DKK</label>
            </li>
            <div class="display-none">
              <input type="radio" name="months" value="2_months" id="month-2">
              <input type="radio" name="months" value="3_months" id="month-3">
              <input type="radio" name="months" value="6_months" id="month-6">
            </div>
          </ul>
        </div>
      
        <div class="col-sm-8">
          
          <!--
            INDSÆT KREDITKORT INFORMATIONER TIL BRUG AF ABONNEMENT
          -->
          <div class="form-group">
            <label for="ccNumber">{{ sentence(__('credit card number')) }}</label>
            <input type="tel" name="ccNumber" placeholder="{{ sentence('enter your credit card number') }}" class="form-control" id="ccNumber">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-auto">
                <label for="ccExpiration">{{ sentence(__('expiration date')) }}</label>
                <input type="tel" name="ccExpiration" placeholder="{{ sentence('date of card expiration') }}" class="form-control" id="ccExpiration">
              </div>
              <div class="col-auto">
                <label for="ccCVV">{{ __('CVV') }}</label>
                <input type="tel" name="ccCVV" placeholder="{{ sentence('security numbers') }}" class="form-control" id="ccCVV">
              </div>
            </div>
          </div>
          <!--
            /SLUT BRUGERENS KREDIT INFORMATIONER
          -->
      
          <!--
            BRUGEREN SKAL ACCEPTERE ABONNEMENTSBETINGELSER
          -->
          <input type="checkbox" name="accepth" id="accepth">
          <label for="accepth">{{ ucfirst(__('i accept the')) }} <a href="https://castme.dk/abonnementsbetingelser/" target="blank">{{
                    __('subscription conditions') }}</a></label>
        </div>
      </div>

    </div>

    <button class="card-footer btn btn-castme" type="submit">
      {{ ucfirst(__('subscribe')) }}
    </button>
  </div>
  

  @csrf
  @method('POST')
</form>

@endsection

<!--
 /SLUT STRIPE HIDE
 -->
 </div> 
