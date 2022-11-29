<?php include '../uc/addProgramation/addProgramationController.php';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Programarile mele</h5>
    <div class="row mt-2">
        <div class="col-12">
            <a class="btn btn-primary" href="addProgramation.php">Adauga programare</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-2"><strong>Data</strong></div>
        <div class="col-1"><strong>Ora</strong></div>
        <div class="col-5"><strong>Medic</strong></div>
        <div class="col-4"><strong>Specialitate</strong></div>
    </div>
    <div class="row mt-2 border-top">
        <div class="col-2">10.09.2023</div>
        <div class="col-1">11:30</div>
        <div class="col-5">Popescu Vasile</div>
        <div class="col-4">Medicina interna</div>
    </div>
    <div class="row mt-2 border-top">
        <div class="col-2">10.09.2023</div>
        <div class="col-1">11:30</div>
        <div class="col-5">Popa Ion</div>
        <div class="col-4">Chirurgie</div>
    </div>
</div>
</body>
</html>