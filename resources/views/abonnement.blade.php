@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">Abonnement</h2>

    <div class="row">

      <div class="col-12 col-sm-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">@if(\Illuminate\Support\Facades\Auth::user()->activeSub()) Aktivt @else
                Inaktivt @endif</h3>
            <pre class="card-text"><?php print_r($_POST); ?></pre>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <form action="/abonnement/subscribe" method="post">
              <h3 class="page-header">Betalingsoplysninger</h3>

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
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="countrySelect"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Land
                      </button>
                      <div class="dropdown-menu" aria-labelledby="countrySelect">
                        <a class="dropdown-item" href="#">Denmark</a>
                      </div>
                    </div>
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
                  <input type="checkbox" name="accepth" class="filled-in" id="accepth">
                  <label for="accepth">
                    Jeg accepter <a href="https://castme.dk/handelsbetingelser/"
                                    target="blank">handelsbetingelserne.</a>
                  </label>

                  <input type="hidden" name="amount" value="100">
                  <input type="submit" class="btn btn-primary" value="Subscribe">
                  {{ csrf_field() }}
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>
  </main>
@endsection
