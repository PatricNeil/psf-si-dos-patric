<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Cuadrados Tattoo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #121212;
            color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #000;
        }
        .navbar-brand {
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
        header {
            background: url('https://source.unsplash.com/1600x600/?tattoo,studio') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }
        header::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }
        header .content {
            position: relative;
            z-index: 2;
        }
        .icon-feature {
            font-size: 3rem;
            color: #e91e63;
            transition: transform 0.3s;
        }
        .icon-feature:hover {
            transform: scale(1.1);
        }
        footer {
            background-color: #000;
            color: #ccc;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Cuadrados Tattoo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right"></i> Reservar Cita
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="content">
            <h1 class="display-3 fw-bold">Bienvenido a Cuadrados Tattoo</h1>
            <p class="lead">Arte en tu piel con pasión, estilo y profesionalismo.</p>
            <a href="{{ route('login') }}" class="btn btn-danger btn-lg mt-3">
                <i class="bi bi-ink"></i> Reserva tu tatuaje
            </a>
        </div>
    </header>

    <section class="container py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="bi bi-brush icon-feature"></i>
                <h4 class="mt-3">Diseños Personalizados</h4>
                <p>Diseñamos tatuajes únicos que reflejan tu historia y personalidad.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bi bi-shield-check icon-feature"></i>
                <h4 class="mt-3">Higiene Profesional</h4>
                <p>Ambiente seguro y esterilizado cumpliendo las normas sanitarias.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="bi bi-camera icon-feature"></i>
                <h4 class="mt-3">Portafolio Artístico</h4>
                <p>Explora nuestros trabajos anteriores y encuentra inspiración.</p>
            </div>
        </div>
    </section>

    <footer class="text-center py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Cuadrados Tattoo - Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
