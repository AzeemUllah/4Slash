<h1>SIGN UP</h1>



<form method="post" action="{{ route('auth.reg') }}">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username">

    <label for="email">Email: </label>
    <input type="email" name="email" id="email">

    <label for="password">Password: </label>
    <input type="password" name="password" id="password">

    <button type="submit">Register</button>
    <input type="hidden" name="_token" value="{{ Session::token() }}">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>