<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Male Fashion - Login</title>
    <link rel="stylesheet" href="/user/css/form.css" />
  </head>
  <body>
      <div class="container">
          <div class="box form-box">
              <header>Login</header>
              
        <form  action="{{route('login.submit')}}" method="post"> 
            @csrf
            @if(session('error'))
                  <div style = "
                  background-color: red;
                  border-color: #f5c6cb;
                  color: white;
                  padding: 10px;
                  border-radius: 5px;
                  text-align: center;"
                  >
                      {{ session('error') }}
                  </div>
            @endif
          <div class="field input">
            <label for="email">Email</label>
            <input
              type="text"
              name="email"
              required
            />
          </div>

          <div class="field input">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              required
            />
          </div>

          <div class="field">
            <input
              type="submit"
              class="btn"
            />
          </div>
          <div class="links">
            Don't have account? <a href="{{ route('signup') }}">Sign Up Now</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
