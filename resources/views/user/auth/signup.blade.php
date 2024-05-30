<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Male Fashion - Register</title>
    <link rel="stylesheet" href="/user/css/form.css" />
  </head>
  <body>
    <div class="container">
      <div class="box form-box">
        <header>Sign Up</header>
        <form action="{{route('signup.submit')}}" method="post">
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
            <label >Email</label>
            <input type="text" name="Email" required />
          </div>
          <div class="field input">
            <label >FullName</label>
            <input type="text" name="Fullname" required />
          </div>

          <div class="field input">
            <label>Address</label>
            <input type="text" name="Address" required />
          </div>
          <div class="field input">
            <label>Phone</label>
            <input type="number" name="Phone" required />
          </div>
          <div class="field input">
            <label >Password</label>
            <input
              type="password"
              name="Password"
              required
            />
          </div>

          <div class="field">
            <input
              type="submit"
              class="btn"
              name="submit"
              value="Register"
              required
            />
          </div>
          <div class="links">
            Already a member? <a href="{{ route('login') }}">Login</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
