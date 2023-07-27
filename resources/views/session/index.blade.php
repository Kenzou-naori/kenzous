@extends('template.base')
@section('content')

<section class="forms-section">
    <div class="forms">
      <div class="form-wrapper is-active">
        <button type="button" class="switcher switcher-login">
          Login
          <span class="underline"></span>
        </button>
        <form class="form form-login">
          <fieldset>
            <legend>Please, enter your email and password for login.</legend>
            <div class="input-block">
              <label for="login-email">E-mail</label>
              <input name="login-email" id="login-email" type="email" required>
            </div>
            <div class="input-block">
              <label for="login-password">Password</label>
              <input name="login-password" id="login-password" type="password" class="password" required>
              <i class='bx bx-hide eye-icon'></i>
            </div>
          </fieldset>
          <button type="submit" class="btn-login">Login</button>
        </form>
      </div>
      <div class="form-wrapper">
        <button type="button" class="switcher switcher-signup">
          Sign Up
          <span class="underline"></span>
        </button>
        <form class="form form-signup">
          <fieldset>
            <legend>Please, enter your email, password and password confirmation for sign up.</legend>
            <div class="input-block">
              <label for="signup-email">E-mail</label>
              <input name="signup-email" id="signup-email" type="email" required>
            </div>
            <div class="input-block">
              <label for="signup-password">Password</label>
              <input name="signup-password" id="signup-password" type="password" class="password" required>
              <i class='bx bx-hide eye-icon'></i>
            </div>
            <div class="input-block">
              <label for="signup-password-confirm">Confirm password</label>
              <input name="signup-password-confirm" id="signup-password-confirm" type="password" required>
            </div>
          </fieldset>
          <button type="submit" class="btn-signup">Continue</button>
        </form>
      </div>
    </div>
  </section>
  <script>
      pwShowHide = document.querySelectorAll(".eye-icon")
      const switchers = [...document.querySelectorAll('.switcher')]

  switchers.forEach(item => {
      item.addEventListener('click', function() {
          switchers.forEach(item => item.parentElement.classList.remove('is-active'))
          this.parentElement.classList.add('is-active')
      })
  })

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })

    })
})

  </script>
@endsection
