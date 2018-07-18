@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">Profiloplysninger</h2>

    <input id="input-b1" name="input-b1" type="file" class="file">

    <div class="card-heading">
      <i class="material-icons">arrow_back</i> Profile Settings
    </div>
    <div class="card profile-card">
      <form method="POST">
        <div class="card-body">

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="username" class="text-muted">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Name yourself">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="username" class="text-muted">First name</label>
                <input type="text" class="form-control" id="username" placeholder="John/Jane">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="username" class="text-muted">Last name</label>
                <input type="text" class="form-control" id="username" placeholder="Doe">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="email" class="text-muted">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
              </div>
            </div>
          </div>

        </div>

      <button class="card-footer btn btn-primary" type="submit">
        Save Changes
      </button>
      </form>
      
    </div>

  </main>
@endsection