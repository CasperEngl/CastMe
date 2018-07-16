@extends('master')
@section('content')
  <main>
    <span class="pageTitle"><i class="material-icons small">create</i> Abonnement</span>
    <div class="col s12"><a class="btn-flat waves-effect" href="/overview"><i
          class="material-icons center">view_comfy</i>Overview</a></div>

    <div class="row">

      <div class="col s12">
        <div class="tile">
          <span class="tile-title" data-title="Abonnement Status"></span>
          <pre><?php print_r($_POST); ?></pre>
          <h1>'Aktivt' : 'Inaktivt'</h1>
        </div>
      </div>

      <div class="col s12">

        <div class="tile">
          <form action="https://payment.quickpay.net" method="post">
            <span class="tile-title" data-title="Betalingsoplysninger"></span>

            <div class="row">
              <div class="col s6">
                <div class="form-group">
                  <label for="fname">Fornavn</label>
                  <input type="text" name="fname" id="fname" class="form-control">
                </div>
              </div>
              <div class="col s6">
                <div class="form-group">
                  <label for="lname">Efternavn</label>
                  <input type="text" name="lname" id="lname" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="form-group">
                  <label for="company">Firma</label>
                  <input type="text" name="company" id="company" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="form-group">
                  <label for="country">Land</label>
                  <select name="country" id="country">
                    <option value="denmark">Danmark</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="form-group">
                  <label for="address1">Vej og husnummer</label>
                  <input type="text" name="address1" id="address1" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="form-group">
                  <label for="address2">Opgang, etage etc.</label>
                  <input type="text" name="address2" id="address2" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s6">
                <div class="form-group">
                  <label for="postalcode">Postnummer</label>
                  <input type="text" name="postalcode" id="postalcode" class="form-control">
                </div>
              </div>
              <div class="col s6">
                <div class="form-group">
                  <label for="city">By</label>
                  <input type="text" name="city" id="city" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="form-group">
                  <label for="phonenumber">Telefonnummer</label>
                  <input type="text" name="phonenumber" id="phonenumber" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="form-group">
                  <label for="email">Email adresse</label>
                  <input type="text" name="email" id="email" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s6">
                <p>
                  <input type="radio" name="product" class="filled-in" id="product1">
                  <label for="product1">
                    2 måneder = 179 kr
                  </label>
                </p>
                <p>
                  <input type="radio" name="product" class="filled-in" id="product2">
                  <label for="product2">
                    3 måneder = 279 kr
                  </label>
                </p>
                <p>
                  <input type="radio" name="product" class="filled-in" id="product3">
                  <label for="product3">
                    6 måneder = 449 kr
                  </label>
                </p>
                <p>
                  <input type="radio" name="product" class="filled-in" id="product4">
                  <label for="product4">
                    12 måneder = 799kr
                  </label>
                </p>
              </div>
              <div class="col s6">
                <p>
                  <input type="checkbox" name="accepth" class="filled-in" id="accepth">
                  <label for="accepth">
                    Jeg accepter <a href="https://castme.dk/handelsbetingelser/"
                                    target="blank">handelsbetingelserne.</a>
                  </label>
                </p>

                </p>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <button class="btn waves-effect waves-light white-text right" type="submit" name="action">
                  Fortsæt til betaling
                </button>
                {{csrf_field()}}
                <input type="hidden" name="payment_methods" value="{{ $params['payment_methods'] }}">
                <input type="hidden" name="version" value="{{ $params['version'] }}">
                <input type="hidden" name="merchant_id" value="{{ $params['merchant_id'] }}">
                <input type="hidden" name="agreement_id" value="{{ $params['agreement_id'] }}">
                <input type="hidden" name="order_id" value="{{ $params['order_id'] }}">
                <input type="hidden" name="amount" value="{{ $params['amount'] }}">
                <input type="hidden" name="currency" value="{{ $params['currency'] }}">
                <input type="hidden" name="type" value="{{ $params['type'] }}">
                <input type="hidden" name="continueurl" value="{{ $params['continueurl'] }}">
                <input type="hidden" name="cancelurl" value="{{ $params['cancelurl'] }}">
                <input type="hidden" name="callbackurl" value="{{ $params['callbackurl'] }}">
                <input type="hidden" name="checksum" value="{{ $params['checksum'] }}">
              </div>
            </div>

        </div>
      </div>

  </main>
@endsection
