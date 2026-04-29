<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            {{ config('app.name') }}
        </a>

        <div class="d-flex ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light" type="submit">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>