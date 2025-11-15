<?php
include 'includes/libros.php';

$id = $_GET['id'] ?? null;
$libroSeleccionado;

foreach ($libros as $libro) {
    if ($libro['id'] == $id) {
        $libroSeleccionado = $libro;
        break;
    }
}

$file = 'data/reservas.json';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $formData = [
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email'],
        'titulo' => $_POST['titulo'],
        'autor' => $_POST['autor'],
        'copias' => $_POST['copias'],
        'formato' => $_POST['formato'],
        'mienbro' => $_POST['mienbro'],
        'mensaje' => $_POST['mensaje']
    ];

    $formData['id'] = uniqid('reserva_', true);
    if(file_exists($file)){
        $dataArray = json_decode(file_get_contents($file), true);
    }else{
        $dataArray = [];
    }
    $duplicado = false;
    foreach ($dataArray as $reserva) {
        if ($reserva['titulo'] == $formData['titulo'] && $reserva['autor'] == $formData['autor']) {
          
            $duplicado = true;
            break;
        }
    }

  
    if (!$duplicado) {
        $dataArray[] = $formData;
        file_put_contents($file, json_encode($dataArray, JSON_PRETTY_PRINT));
    } else {
       
        echo "Ya existe una reserva con este título y autor.";
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title><?= $libroSeleccionado['titulo'] ?></title>
    <link rel="stylesheet" href="assets/CSS/globals.css" />
    <link rel="stylesheet" href="assets/CSS/styleguide.css" />
    <link rel="stylesheet" href="assets/CSS/style.css" />
    <link rel="stylesheet" href="assets/CSS/styleLibro.css" />
    <link rel="stylesheet" href="assets/CSS/styleFormulario.css" />
</head>
<body>
<div class="header">
        <div class="logo">
            <div class="component"><img class="element-removebg-preview" src="assets/img/logo.webp" /></div>
        </div>
        <div class="navbar">
            <a href="#home"><div class="text-wrapper">Home</div></a>
            <div class="text-wrapper">Categorias</div>
            <div class="text-wrapper">Administrador</div>
            <a href="reservas.php" ><div class="text-wrapper">Reservas</div></a>
            <a href="#contacto" t><div class="text-wrapper">Contacto</div></a>
            <div class="input-buscar">
                <div class="input">
                    <input type="text" class="input-placeholder" placeholder="Buscar un libro" />
                    
                    <button class="button-icons">
                        <img class="icons" src="assets/img/icons.webp" />
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="info-libro">
        <div class="contenedor">
            <div class="info-texto">
                <div class="genero"><?= $libroSeleccionado['genero'] ?></div>
                <div class="titulo"><?= $libroSeleccionado['titulo'] ?></div>
                <div class="descripcion"><?= $libroSeleccionado['descripcion'] ?></div>
                <div class="sinopsis">
                    <div class="texto-sinopsis"><?= $libroSeleccionado['sinopsis'] ?></div>
                   
                </div>
                <div class="botones">
                    <a class="button" onclick="abrirFormulario()">
                        <div class="primary-button">Reserva aquí</div>
                        <img class="icons1" alt="" src="/assets//img/right.webp">
                    </a>
                    <div id="contenido" style="z-index: 1000;">
                    <div id="formulario-reserva">
                        <div id="contenido-ventana">
                            <h2 class="tituloFormulario">Formulario Reserva de Libro</h2>
                            <form method="POST">
                                <div class="form">
                                <div class="wraperLabels">
                                    <div class="wraper">
                                    <label for="nombre" class="label">Nombre </label>
                                    <input class="input-form" type="text" id="nombre" name="nombre" placeholder="Jhon" required>
                                    </div>
                                    <div class="wraper">
                                    <label for="apellidos" class="label">Apellidos</label>
                                    <input class="input-form" type="text" id="apellidos" name="apellidos" placeholder="Doe" required>
                                    </div>
                                </div>
                                <div class="wraperLabels">
                                    <div class="wraper">
                                    <label for="telefono" class="label">Télefono (opcional)</label>
                                    <input class="input-form" type="text" id="telefono" name="telefono" placeholder="658 458 958">
                                    </div>
                                    <div class="wraper">
                                    <label for="email" class="label">Email </label>
                                    <input class="input-form" type="email" id="email" name="email" placeholder="jhon@gmail.com" required>
                                    </div>
                                </div>
                                <div class="wraperLabels">
                                    <div class="wraper">
                                    <label for="titulo" class="label">Titulo del Libro</label>
                                    <input class="input-form" type="text" id="titulo" name="titulo" value="<?php echo $libroSeleccionado['titulo'] ?>">
                                    </div>
                                    <div class="wraper">
                                    <label for="autor" class="label">Autor del Libro </label>
                                    <input class="input-form" type="text" id="autor" name="autor" value="<?php echo $libroSeleccionado['autor'] ?>">
                                    </div>
                                </div>
                                <div class="wraperLabels">
                                    <div class="wraper">
                                    <label for="copias" class="label">Número de Copias</label>
                                    <input class="input-form" type="number" id="copias" name="copias" placeholder="3" required max="6" min="1">
                                    </div>
                                    <div class="wraper">
                                    <label for="formato" class="label">Formato</label>
                                    <select name="formato" id="formato" class="input-form" required>
                                        <option value="E-book">E-Book</option>
                                        <option value="Audio Libro">Audio Libro</option>
                                        <option value="Físico">Físico</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="wraper">
                                    <label for="mienbro" class="label">¿Eres mienbro de la biblioteca?</label>
                                    <select name="mienbro" id="mienbro" class="input-form" required>
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="wraper">
                                    <label for="mensaje" class="label">
                                    Comentario o Solicitud Especial
                                    </label>
                                    <textarea class="mensaje" name="mensaje" id="mensaje" placeholder="Mensaje aqui..."></textarea>
                                </div>
                                <button type="submit" id="enviar">Enviar</button>
                                </div>
                            
                            </form>
                            <button id="cerrarVentana" onclick="cerrarVentana1()">Cerrar</button>
                            </div>


                        </div>
                    </div>
                    <a class="button1" href="/reservas.php">
                        <div class="primary-button">Cancelar Reserva</div>
                        <img class="icons1" alt="" src="/assets/img/x.webp">
                    </a>
                    </div>
                </div>
            <div class="imagen-libro">
                <img class="img" alt="" src="<?= $libroSeleccionado['imagen'] ?>">
                <div class="shadow"></div>
            </div>
        </div>
    </div>
    <script src="assets/js/javaScript.js"></script>
</body>
</html>
