<h1>hello</h1>
<form action="{{route('auth.signIn')}}" method="post">
    @csrf
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Sign In</button>
</form>