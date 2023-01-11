<?php include '../uc/medicConsultationsList/medicConsultationsListController.php';
$pageTitle = 'Programarile mele';
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
            <?php if ($errMsg != null) { ?>
                <div class='text-danger'>
                    <?php echo $errMsg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (sizeof($medicConsultationsArray)) { ?>
        <div class="row mt-2">
            <div class="col-2"><strong>Data</strong></div>
            <div class="col-1"><strong>Ora</strong></div>
            <div class="col-4"><strong>Pacient</strong></div>
            <div class="col-4"><strong>CNP</strong></div>
            <div class="col-1"></div>
        </div>
    <?php } ?>
    <?php foreach ($medicConsultationsArray as $value) { ?>
        <div class="row mt-2 border-top">
            <div class="col-2"><?php echo $value->getConsultationDate(); ?></div>
            <div class="col-1"><?php echo $value->getConsultationInterval(); ?></div>
            <div class="col-4"><?php echo $value->getLabel(); ?></div>
            <div class="col-4"><?php echo $value->getCnp(); ?></div>
            <div class="col-1">
                <a class="btn btn-outline-secondary mt-2" href="addConsultationFilePage.php?id=<?php echo $value->getIdConsultation(); ?>"><i class="bi bi-clipboard2-pulse"></i></a>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>