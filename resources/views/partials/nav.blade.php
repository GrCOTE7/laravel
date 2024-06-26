<div class="header">
    <div class="menu">
        <a href="/">Home</a> |
        <a href="/films">Films</a> |
        <a href="/lbc">LBC</a> |
        <a href="/tuto">Tutos</a> |
        <a href="/users">Users</a> |
        <a href="/test">Test</a>
    </div>
    <div class="account">
        @auth
            <span style="text-align:right"><a href="/dashboard">Dashboard <b>{{ auth()->user()->name }}</b></a></span>
        @endauth

        @guest
            <a href="/logLionel">LogLionel</a> |
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        @endguest
    </div>
</div>
<style>
    a {
        text-decoration: none;
    }

    .header {
        display: flex;
        justify-content: space-between;
        /* border:1px solid blue; */
    }
</style>
