@extends('template.base')

@section('content')
<body>

    <section class="container forms">
        <div class="form signup">
            <div class="form-content">
                <header>Signup</header>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="field input-field">
                        <input name="name" id="name" type="text" placeholder="Name" class="input" autocomplete="name">
                        @error('name')
                        <div class="invalid-feedback" role="alert">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        </div>
                        @enderror
                    </div>
                    <div class="field input-field">
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"  autocomplete="email">
                        @error('email')
                        <div class="invalid-feedback" role="alert">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        </div>
                        @enderror
                    </div>

                    <div class="field input-field">
                        <input name="password" id="password" type="password" placeholder="Create password" class="password" autocomplete="new-password">
                        @error('password')
                        <div class="invalid-feedback" role="alert">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        </div>
                        @enderror
                    </div>

                    <div class="field input-field">
                        <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm password" class="password" autocomplete="new-password">
                        <i class='bx bx-hide eye-icon'></i>
                        @error('password')
                        <div class="invalid-feedback" role="alert">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        </div>
                        @enderror
                    </div>
                    <div class="field input-field">
                        <input name="no_telp" id="no_telp" type="number" placeholder="No Telp">
                        @error('no_telp')
                        <div class="invalid-feedback" role="alert">
                            @if ($errors->has('no_telp'))
                            <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                        @endif
                        </div>
                        @enderror
                    </div>
                    <div class="field textarea-field">
                        <textarea name="address" id="address"  placeholder="Address"></textarea>
                        @error('address')
                        <div class="invalid-feedback" role="alert">
                            @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                        </div>
                        @enderror
                    </div>
                    <div class="field button-field">
                        <button type="submit">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                <div class="form-link">
            <span>Already have an account? <a href="/login" class="link login-link">Login</a></span>
        </div>
    </div>

    <div class="line"></div>

    <div class="media-options">
        <a href="#" class="field facebook">
            <i class='bx bxl-facebook facebook-icon'></i>
            <span>Login with Facebook</span>
        </a>
    </div>

    <div class="media-options">
        <a href="{{route('google.login')}}" class="field google">
            <img src="storage/img/google-logo-9808.png" alt="" class="google-img" draggable="false">
            <span>Login with Google</span>
        </a>
    </div>

</div>
</section>
</body>
<script>
    const forms = document.querySelector(".forms"),
    pwShowHide = document.querySelectorAll(".eye-icon"),
    links = document.querySelectorAll(".link");

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
