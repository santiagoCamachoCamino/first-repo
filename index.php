<?php
include 'includes/libros.php';

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
    <title>Biblioteca Digital</title>
    <link rel="stylesheet" href="assets/css/globals.css" />
    <link rel="stylesheet" href="assets/css/styleguide.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/styleFormulario.css">
   
</head>

<body>
<!-- Header -->
    <div class="header">
        <div class="logo">
            <div class="component"><img class="element-removebg-preview" src="assets/img/logo.webp" /></div>
        </div>
        <div class="navbar">
            <a href="#home"><div class="text-wrapper">Home</div></a>
            <div class="text-wrapper">Categorias</div>
            <div class="text-wrapper">Administrador</div>
            <a href="#contacto" ><div class="text-wrapper">Contacto</div></a>
            <a href="reservas.php" ><div class="text-wrapper">Reservas</div></a>
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
<!-- Home Inicio -->
    <div id="home" class="inicio-pagina">
        <?php $libro1 = $libros[rand(0, 9)]; ?>

        <div class="frame">
            <div class="texto-inicio">
                <div class="text-wrapper" id="titulo"><?= $libro1['titulo'] ?></div>
                <div style="display: none;" id="autor"><?= $libro1['autor'] ?></div>
                <p class="div"><?= $libro1['descripcion'] ?></p>
                <button class="button" id="abrirVentana" onclick="abrirFormulario()">
                    <div class="primary-button">RESERVA AHORA</div>
                    <img class="icons" src="assets/img/Icons_flecha_derecha.webp" />
                </button>
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
                                    <input class="input-form" type="text" id="titulo" name="titulo" value="<?php echo $libro1['titulo'] ?>">
                                    </div>
                                    <div class="wraper">
                                    <label for="autor" class="label">Autor del Libro </label>
                                    <input class="input-form" type="text" id="autor" name="autor" value="<?php echo $libro1['autor'] ?>">
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
                
            </div>
            <div class="image-wrapper">
                <a href="libro.php?id=<?= $libro1['id'] ?>" target="_blank" class="imagen-inicio">
                        <img class="image" src="<?= $libro1['imagen'] ?>" alt="<?= $libro1['titulo'] ?>" />
                        <div class="shadow"></div>
                </a>
            </div>
           
        </div>
    </div>
<!-- Novedades -->
    <div class="section-novedades">
        <div class="texto">
            <div class="text-wrapper">NOVEDADES</div>
            <p class="estos-libros-son-los">
                Estos libros son los mas reservados este mes<br />
                ¡No te los pierdas!
            </p>
        </div>
        <div class="slider">
                <div class="card-libros">
                    <?php foreach ($libros as $libro): ?>
                        <div class="libro-card">
                            <div class="image-wrapper">
                                <a href="libro.php?id=<?= $libro['id'] ?>" target="_blank" class="imagen-inicio2">
                                    <img class="image" src="<?= $libro['imagen'] ?>" />
                                    <div class="shadow"></div>
                                </a>
                            </div>
                            <div class="frame">
                                <div class="div"><?= $libro['genero'] ?></div>
                                <p class="p"><?= $libro['titulo'] ?></p>
                                <p class="text-wrapper-2">
                                    <?= $libro['descripcionCorta'] ?>
                                </p>
                            </div>
                            <div class="frame-2">
                                <img class="img" src="<?= $libro['fotoAutor'] ?>" />
                                <div class="text-wrapper-3"><?= $libro['autor'] ?></div>
                            </div>
                            <div class="button-wrapper">
                                <a class="button" href="libro.php?id=<?= $libro['id'] ?>" target="_blank">
                                    <div class="primary-button">Más info</div>
                                    <img class="icons" src="assets/img/Icons_flecha_abajo.png" />
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

        </div>
    </div>
<!-- Recomendadciones -->
    <div class="slider-libros">
        <div class="texto"><p class="text-wrapper">¿Un Dragón?... ¡eso si es Fantansia!</p></div>
        <div class="libros">
                <?php foreach ($libros as $libro): ?>
                    <a class="frame" href="libro.php?id=<?= $libro['id'] ?>" target="_blank">
                        <img  class="hardcover-catalog" src="<?= $libro['imagen2'] ?>" />
                        <div class="caption">
                            <div class="titulo"> <?= $libro['titulo'] ?> </div>
                            <div class="autor"> <?= $libro['autor'] ?> </div>
			            </div>
                    </a>
                    
                   
                <?php endforeach; ?>
              
            </div>
    </div>
    <div class="slider-libros">
        <div class="texto"><p class="text-wrapper">Crecimiento Personal... ¿o como era?</p></div>
        <div class="libros">
                <?php foreach ($libros as $libro): ?>
                    <a class="frame" href="libro.php?id=<?= $libro['id'] ?>" target="_blank">
                        <img  class="hardcover-catalog" src="<?= $libro['imagen2'] ?>" />
                        <div class="caption">
                            <div class="titulo"> <?= $libro['titulo'] ?> </div>
                            <div class="autor"> <?= $libro['autor'] ?> </div>
			            </div>
                    </a>
                    
                   
                <?php endforeach; ?>
              
            </div>
    </div>
<!-- Seccion contacto -->

    <div id="contacto" class="section-contacto">
        <div class="contenedor">
            <div class="contenedor-imagen"><img class="input-label" src="assets\img\cat lying on books.webp" /></div>
            <div class="get-it-touch-wrapper">
            <div class="get-it-touch">
            <div class="texto"><div class="text-wrapper">Contáctanos</div></div>
            <div class="formulario">
                <div class="nombre-emial">
                <div class="label-nombre">
                <div class="input-label"><div class="input-label-large">Nombre</div></div>
                <div class="input"><input class="input input-placeholder" placeholder="Jonh Doe" type="text" /></div>
            </div>
            <div class="label-nombre">
            <div class="input-label"><div class="input-label-large">Email</div></div>
            <div class="input"><input class="input-placeholder" placeholder="jhondoe@gmail.com" type="text" /></div>
            </div>
            </div>
            <div class="telefono-empresa">
                <div class="div">
                <div class="input-label"><div class="input-label-large">Télefono</div></div>
                <div class="input">
                <input class="input-placeholder" placeholder="+34 66666666" type="text" />
            </div>
            </div>
                <div class="div">
                <div class="input-label"><div class="input-label-large">Empresa</div></div>
                <div class="input"><input class="input-placeholder" placeholder="facebook" type="text" /></div>
            </div>
            </div>
                <div class="mensaje-contacto">
                <div class="input-label-large-wrapper"><div class="input-label-large">Mensaje</div></div>
                <div class="div-wrapper"><textarea name="" id="" class="input-placeholder-2" placeholder="Escribe tu mensaje..."></textarea></div>
            </div>
            </div>
                <div class="boton">
                <button class="button"><div class="primary-button">Enviar Mensaje</div></button>
            </div>
            </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="component-1">
            <img class="removebg-preview-1-icon" alt="" src="assets\img\Logo.webp">
        </div>
        <div class="redes-sociales">
            <img class="icons" alt="" src="assets\img\face.webp">
            <img class="icons" alt="" src="assets\img\ig.webp">
            <img class="icons" alt="" src="assets\img\link.webp">
            <img class="icons" alt="" src="assets\img\youtube.webp">
        </div>
    </div>
        <script src="assets/js/javaScript.js"·></script>
       
</body>

</html>