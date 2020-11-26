<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">

        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div style="margin-right: 40px;" class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu mt-1" aria-labelledby="navbarDropdown">
                    
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section>
        <div class="container-fluid ml-3 mr-3 mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">City</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alldata as $alldatas)
                <tr>
                    <th scope="row">{{ $alldatas->id }}</th>
                    <td>{{ $alldatas->username }}</td>
                    <td>{{ $alldatas->email }}</td>
                    <td>{{ $alldatas->dob }}</td>
                    <td>{{ $alldatas->city }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>