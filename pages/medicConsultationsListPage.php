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
            <div class="col-3"><strong>CNP</strong></div>
            <div class="col-1"></div>
        </div>
    <?php } ?>
    <?php foreach ($medicConsultationsArray as $value) { ?>
        <div class="row mt-2 border-top">
            <div class="col-2"><?php echo $value->getConsultationDate(); ?></div>
            <div class="col-1"><?php echo $value->getConsultationInterval(); ?></div>
            <div class="col-4"><?php echo $value->getLabel(); ?></div>
            <div class="col-3"><?php echo $value->getCnp(); ?></div>
            <div class="col-1">
                <a class="btn btn-outline-secondary mt-2" href="addConsultationFilePage.php?id=<?php echo $value->getIdConsultation(); ?>"><i class="bi bi-clipboard2-pulse"></i></a>
            </div>
            <div class="col-1">
                <form action="generateConsultationPDF.php" method="post">
                    <input type="hidden" name="date" value=" <?php echo $value->getConsultationDate(); ?>">
                    <input type="hidden" name="medicName" value="<?php echo $value->getLastNameMedic() . " " . $value->getFirstNameMedic(); ?>">
                    <input type="hidden" name="specialization" value="<?php echo $value->getSpecialization(); ?>">
                    <input type="hidden" name="pacientName" value="<?php echo $value->getLabel(); ?>">
                    <input type="hidden" name="cnp" value="<?php echo $value->getCnp(); ?>">
                    <input type="hidden" name="diagnostic" value="<?php echo $value->getDiagnostic(); ?>">
                    <input type="hidden" name="recomendedTreatment" value="<?php echo $value->getRecomendedTreatment(); ?>">
                    <input type="hidden" name="recomendedAnalyses" value="<?php echo $value->getRecomendedAnalyses(); ?>">
                    <button class="btn btn-outline-secondary mt-2"><i class="bi bi-download"></i></button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>