<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería Online - Contacto</title>
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
        }
        
        .contact-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .btn-send {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            width: 100%;
        }
        
        .info-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 20px;
        }
        
        .footer {
            background: #1a202c;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
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
                        <a class="nav-link" href="autores.php">
                            <i class="fas fa-users"></i> Autores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contacto.php">
                            <i class="fas fa-envelope"></i> Contacto
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card contact-card p-4">
                    <h2><i class="fas fa-envelope"></i> Contáctanos</h2>
                    <p>Envíanos tu mensaje y te responderemos pronto</p>
                    
                    <?php if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'ok'): ?>
                        <div class="alert alert-success">✅ ¡Mensaje enviado con éxito!</div>
                    <?php endif; ?>
                    
                    <form action="guardar_contacto.php" method="POST">
                        <div class="mb-3">
                            <label><i class="fas fa-user"></i> Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label><i class="fas fa-envelope"></i> Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label><i class="fas fa-tag"></i> Asunto</label>
                            <input type="text" name="asunto" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label><i class="fas fa-comment"></i> Mensaje</label>
                            <textarea name="comentario" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn-send">
                            <i class="fas fa-paper-plane"></i> Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card info-card p-4">
                    <h3><i class="fas fa-info-circle"></i> Información</h3>
                    <hr>
                    <p><i class="fas fa-phone"></i> <strong>Teléfono:</strong> (809) 555-6789</p>
                    <p><i class="fas fa-envelope"></i> <strong>Email:</strong> hola@libreria.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Dirección:</strong> Av. Libertador 123, Santo Domingo</p>
                    <p><i class="fas fa-clock"></i> <strong>Horario:</strong> Lun-Vie 9am-6pm</p>
                    <hr>
                    <div class="text-center">
                        <i class="fab fa-facebook fa-2x mx-2"></i>
                        <i class="fab fa-instagram fa-2x mx-2"></i>
                        <i class="fab fa-twitter fa-2x mx-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Librería Online - Todos los derechos reservados</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>