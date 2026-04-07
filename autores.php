<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$sql = "SELECT a.*, COUNT(ta.id_titulo) as cantidad_libros
        FROM autores a
        LEFT JOIN titulo_autor ta ON a.id_autor = ta.id_autor
        GROUP BY a.id_autor
        ORDER BY a.apellido";

$stmt = $db->prepare($sql);
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Online - Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
            border-radius: 0 0 30px 30px;
            margin-bottom: 40px;
        }
        
        .autor-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
            background: white;
        }
        
        .autor-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .autor-icon {
            font-size: 3rem;
            color: #667eea;
        }
        
        .footer {
            background: #1a202c;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        .badge-books {
            background: #667eea;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-book-open"></i> Librería Online
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-book"></i> Libros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="autores.php">
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

    <div class="hero-section">
        <div class="container">
            <h1><i class="fas fa-users"></i> Nuestros Autores</h1>
            <p>Conoce a los escritores que hacen posible estos libros</p>
            <div class="counter">
                <i class="fas fa-database"></i> <?php echo count($autores); ?> autores registrados
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php foreach($autores as $autor): ?>
            <div class="col-md-4 mb-4">
                <div class="autor-card card h-100">
                    <div class="card-body text-center">
                        <div class="autor-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h4><?php echo htmlspecialchars($autor['nombre'] . ' ' . $autor['apellido']); ?></h4>
                        <p class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> <?php echo $autor['ciudad'] . ', ' . $autor['pais']; ?>
                        </p>
                        <div class="badge-books">
                            <i class="fas fa-book"></i> <?php echo $autor['cantidad_libros']; ?> libros escritos
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <p>&copy; 2025 Librería Online - Todos los derechos reservados</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>