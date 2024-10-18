<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/sign_up.css')}}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <main>
            <div class="page">
                <div class="header">
                    <div class="heading"></div>
                    <p>Daftar untuk melihat website ini.</p>
                  <div>
                    <hr>
                    <p>OR</p>
                    <hr>
                  </div>
                </div>
                <div class="container1">
                  <form  method="POST" action="{{ route('register') }}">
                    @csrf
                    <div style="width: 100%; ">
                      <input type="text"id="name" name="name" class="form-control @error('name') is-invalid @enderror"  required autocomplete="name" autofocus placeholder="Name">
                       @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                    <div style="width: 100%; ">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email"  placeholder="Email">
        
                       @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
        
                    <div style="width: 100%; ">        
                       @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                    <div style="width: 100%; ">
                      <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                       @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div style="width: 100%; ">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                </div>
                <div style="width: 100%;">
                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                        <option value="">Pilih Level</option>
                        <option value="maneger" {{ old('level') == 'maneger' ? 'selected' : '' }}>Manager</option>
                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                  
                    @error('level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
        
                    <button style="font-weight:600; font-size:17px !important" type="submit" >Register</button>
                  </form>
                </div>
            </div>
          </main>
        </div>
    </form>
</body>

</html>
