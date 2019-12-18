<div class="container">
    <form method="POST" action="/login" id="login-form">
        {{ csrf_field()  }}

        <input type="text" name="username" placeholder="{{ __('Username') }}" value="{{ old('username') }}" required>
        <span class="validation-username-error"></span>
        <br>
        <input type="password" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}" required>
        <span class="validation-password-error"></span>
        <br>
        <button type="submit">{{ __('Login') }}</button>
    </form>
</div>

