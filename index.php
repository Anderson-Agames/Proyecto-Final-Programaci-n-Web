<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$sql = "SELECT t.id_titulo, t.titulo, t.tipo, t.precio, t.notas,
               GROUP_CONCAT(CONCAT(a.nombre, ' ', a.apellido) SEPARATOR ', ') as autores
        FROM titulos t
        LEFT JOIN titulo_autor ta ON t.id_titulo = ta.id_titulo
        LEFT JOIN autores a ON ta.id_autor = a.id_autor
        GROUP BY t.id_titulo
        ORDER BY t.titulo";

$stmt = $db->prepare($sql);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Online - Catálogo de Libros</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .navbar {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
            border-radius: 0 0 30px 30px;
            margin-bottom: 40px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            background: white;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .card-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.2rem;
            border-left: 4px solid #667eea;
            padding-left: 10px;
        }
        
        .badge-genre {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .price {
            color: #667eea;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .footer {
            background: #1a202c;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: scale(1.05);
            color: white;
        }
        
        .counter {
            background: rgba(255,255,255,0.2);
            display: inline-block;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <!-- Navegacion -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-book-open"></i> Librería Online
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-book"></i> Libros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="autores.php">
                            <i class="fas fa-users"></i> Autores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">
                            <i class="fas fa-envelope"></i> Contacto
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1><i class="fas fa-book-reader"></i> Bienvenidos a nuestra Librería</h1>
            <p>Descubre los mejores libros y autores</p>
            <div class="counter">
                <i class="fas fa-database"></i> <?php echo count($libros); ?> libros disponibles
            </div>
        </div>
    </div>

    <!-- Catalogo de Libros -->
    <div class="container">
        <div class="row">
            <?php foreach($libros as $libro): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="badge-genre">
                                <i class="fas fa-tag"></i> <?php echo $libro['tipo']; ?>
                            </span>
                        </div>
                        <h5 class="card-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-user"></i> 
                            <?php echo $libro['autores'] ? htmlspecialchars($libro['autores']) : 'Autor no registrado'; ?>
                        </p>
                        <div class="price">
                            $<?php echo number_format($libro['precio'], 2); ?>
                        </div>
                        <hr>
                        <button class="btn btn-custom btn-sm w-100" onclick="alert('Agregado al carrito: <?php echo addslashes($libro['titulo']); ?>')">
                            <i class="fas fa-shopping-cart"></i> Comprar
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <p>&copy; 2025 Librería Online - Todos los derechos reservados</p>
            <p>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-whatsapp"></i>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>