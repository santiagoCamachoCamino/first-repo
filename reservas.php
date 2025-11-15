<?php
include 'Includes/libros.php';

$file = file_get_contents('data/reservas.json');

$datos = json_decode($file,true);

$imgLibro='';

$mensaje='';

$idLibroEliminar='';





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/globals.css" />
    <link rel="stylesheet" href="assets/css/styleguide.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/styleReservas.css" />
    <title>Reservas</title>
</head>
<body>
<!-- Header -->
    <div class="header">
            <div class="logo">
                <div class="component"><img class="element-removebg-preview" src="assets/img/logo.webp" /></div>
            </div>
            <div class="navbar">
                <a href="index.php"><div class="text-wrapper">Home</div></a>
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
        <div id="contenido"></div>
<!-- Lista de Reservas -->
    <div class="reservas">
       
        <div class="titulo-reservas">Tus libros Reservados</div>
        <?php if($datos == null){
            $mensaje = 'No hay reservas registradas';
            echo "<div class='mensaje-reservas'> $mensaje </div>";
            }
        ?>
        <?php foreach($datos as $reserva): ?>
            <?php
            $imgLibro = '';
            foreach($libros as $libro):
                if($libro['titulo'] == $reserva['titulo']) {
                    $imgLibro = $libro['imagen2']; 
                    break; 
                }
            endforeach;
            ?>
            <?php $idLibroEliminar=$reserva['id']?>
            <div class="contenedor-reserva">
                <div class="contenedor-libro-informacion">
                    <img class="img-reserva" src="<?php echo $imgLibro; ?>" alt="Imagen del libro" class="img-libro"> 
                    <div class="wraper-informacion">
                            <div class="wraper-fila">
                                <div class="wraper-columna">
                                    <p class="caption">Titulo </p>
                                    <p class="info"><?php echo $reserva['titulo']; ?></p> 
                                </div>
                                <div class="wraper-columna">
                                    <p class="caption">Formato </p>
                                    <p class="info"><?php echo $reserva['formato']; ?></p>
                                </div>
                            </div>
                            <div class="wraper-fila">
                                <div class="wraper-columna">
                                    <p class="caption">Autor</p>
                                    <p class="info"><?php echo $reserva['autor']; ?></p> 
                                </div>
                                <div class="wraper-columna">
                                    <p class="caption">Nº Copias</p>
                                    <p class="info"><?php echo $reserva['copias']; ?></p> 
                                </div>
                            </div>
                        </div>
                </div>
                <a class="img-reserva-contenedor" title="Cancelar Reservar" onclick="cancelarReserva()">
                    <img src="assets\img\red cancel icon.webp" alt="" class="img-x">
                </a>
            </div>
            <div id="cancelar-reserva">
                
                <div id="contenedor-cancelar">
                <span class="close" id="closeBtn" onclick="cerrarVentana()">&times;</span>
                    <form method="POST">
                        <div class="form">
                            <label for="cancelar" class="label">¿Deseas cancelar esta reserva?</label>
                            <div class="contenedor-envios">
                                <input type="hidden" id="idReserva" value="<?php echo $idLibroEliminar; ?>">
                                <button type="submit" id="enviar" onclick="confirmarCancelacion()">Confirmar
                                </button>
                            </div>
                        </div>
                    
                    </form>
                    <div class="mensaje-reservas"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
   
    <script src="assets/js/javaScript.js"></script>
</body>
</html>