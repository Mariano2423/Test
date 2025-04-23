<!DOCTYPE html>
<html>

<head>
    <title>Escuela en Casa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="/G1_SC-502_JN_Proyecto/public/css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="/G1_SC-502_JN_Proyecto/public/js/scripts.js"></script>

</head>

<body>
<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="alert alert-success text-center" role="alert">
        <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
<?php endif; ?>

    <!-- Contenedor de Inicio de Sesión -->
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-body-custom text-white text-center">
                        <h2>Autenticación</h2>
                    </div>
                    <div class="card-body">

                        <!-- Mostrar mensaje de error si existe -->
                        <?php if (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                            <div class="alert alert-danger text-center">
                                <strong>Error:</strong> <?php echo htmlspecialchars($_GET['msg']); ?>
                            </div>
                        <?php endif; ?>

                        <form id="login-form" action="./app/controller/usuarioController.php" method="POST">
                            <div class="form-group row my-3">
                                <label class="col-md-7 my-auto" for="login-username">
                                    Usuario:
                                </label>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" id="login-username" name="login-username"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <label class="col-md-7 my-auto" for="login-password">
                                    Contraseña:
                                </label>
                                <div class="col-md-7">
                                    <input class="form-control" type="password" id="login-password"
                                        name="login-password" required>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="inicio">
                            <div class="card-footer text-center">
                                <a href="#" id="show-register" class="btn bg-body-custom text-white">
                                    Registro
                                </a>
                                <button class="btn bg-body-custom text-white" type="submit">
                                    Ingresar
                                </button>
                                <button class="btn bg-body-custom text-white" type="reset">
                                    Limpiar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para Registro de Usuario -->
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card-header bg-body-custom text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Registro de Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="register-form" action="./app/controller/usuarioController.php" method="POST">
                        <div class="form-group">
                            <label for="new-username">Usuario:</label>
                            <input type="text" class="form-control" id="new-username" name="new-username" required>
                        </div>

                        <div class="form-group">
                            <label for="new-password">Contraseña:</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-nombre">Nombre:</label>
                            <input type="text" class="form-control" id="new-nombre" name="new-nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="new-cedula">Cédula:</label>
                            <input type="text" class="form-control" id="new-cedula" name="new-cedula" required>
                        </div>
                        <div class="form-group">
                            <label for="new-fecha">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="new-fecha" name="new-fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="new-telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="new-telefono" name="new-telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="new-encargado">Encargado:</label>
                            <input type="text" class="form-control" id="new-encargado" name="new-encargado" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="escuela">Escuela:</label>
                            <select id="escuela" name="escuela" class="form-select" required>
                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/G1_SC-502_JN_Proyecto/app/controller/escuelaController.php';
                                get_escuelas();
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="grado">Grado:</label>
                            <select id="grado" name="grado" class="form-select" required>
                                <option value="Primero">Primero</option>
                                <option value="Segundo">Segundo</option>
                                <option value="Tercero">Tercero</option>
                                <option value="Cuarto">Cuarto</option>
                                <option value="Quinto">Quinto</option>
                                <option value="Sexto">Sexto</option>
                            </select>
                        </div>

                        <input type="hidden" name="action" value="registro">
                        <div class="card-footer text-center">
                            <button class="btn bg-body-custom text-white" type="submit">Registrarse</button>
                            <button class="btn bg-body-custom text-white" type="reset">Limpiar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>