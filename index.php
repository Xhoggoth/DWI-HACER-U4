<?php 
    require_once('db/db_connection.php');
?>
<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario de citas</title>
    <!-- Styles CDN  -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                        <a class="nav-link text-center" aria-current="page" href="#" style="padding-left: 60px;"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  style="padding-top: 55px;">
                            Contactar para una cita
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="http://wa.me/528443834647?text=¡Hola!%20quisiera%20agendar%20una%20cita" target="_blank">WhatsApp <i class="bi bi-whatsapp" style="color: #27cf54; font-size: 1.5rem;"></i></a></li>
                            <li><a class="dropdown-item" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to=christianmsaucedoj@gmail.com&su=Solicitud para agendar una cita&body=¡Hola! quisiera agendar una cita" target="_blank">Correo <i class="bi bi-envelope-at-fill" style="color: #fff705; font-size: 1.5rem;"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div>
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