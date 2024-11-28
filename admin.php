<?php 
    require_once('db/db_connection.php');
    session_start();
    if (empty($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar citas</title>
    <!-- Styles CDN  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Styles CSS-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <!-- Icon -->
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <!-- Scripts CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Scripts JS -->
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="./js/script.js"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-2 mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link text-center" aria-current="page" href="#" style="margin-right: 530px;"></a>
                    </li>
                    <li class="nav-item">
                        <img src="./img/logo.png" alt="" height="100px" width="250px">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" aria-current="page" href="#" style="padding-left: 220px;"></a>
                    </li>
                </ul>
                <a href="logout.php">
                    <button class="btn btn-danger" type="button"><b>Cerrar Sesión</b></button>
                </a>
            </div>
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title text-center" style="font-size: 2rem;"><b>Calendario de Citas</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Cita:</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="employee" class="control-label">Empleado:</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="employee" id="employee" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Descripción:</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Inicio de la Cita:</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">Fin de la Cita:</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-check"></i> Guardar</button>
                            <button class="btn btn-danger border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-trash"></i> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Detalles de la Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Cita:</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Empleado:</dt>
                            <dd id="employee" class=""></dd>
                            <dt class="text-muted">Descripción:</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Inicio:</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Fin:</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id=""><b>Editar</b></button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id=""><b>Eliminar</b></button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal"><b>Cerrar</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

<?php 
$schedules = $conn->query("SELECT * FROM `work_schedule_table`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
</html>