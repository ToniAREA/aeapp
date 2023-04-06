<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AreaElectronica</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body style="padding-top: 100px">
    <header>
        <div class="">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand ms-2" href="#"><b>AREA</b>&nbspELECTRONICA</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">

                            <li class="nav-item">
                                <a class="nav-link active" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Testimonials</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                            {{--  <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a> can be active also
                    </li> --}}
                        </ul>
                        <div class="d-flex">
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-outline-success me-2">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-success me-2">Access</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-secondary me-2">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </header>

    <main class="container">
        <div class="bg-light p-5 rounded">
            <h2 class="text-secondary">BESPOKE MARINE ELECTRONICS</h2>
            <p class="lead text-secondary">
                Dedicated to electronics, electricity and computing since 1996, specialized in the naval field.
                Extensive
                experience in mostly private boats, both sailboats and motorboats. Experts in troubleshooting and in
                designing
                customized technological solutions for each case and / or client.
                </p>

                <p class="lead text-secondary">
                     Preferent brands:
                Raymarine, Mastervolt, KVH, Victron, Furuno, Maretron, Fusion, Airmar, etc...
                </p>
               
            
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</body>

</html>
