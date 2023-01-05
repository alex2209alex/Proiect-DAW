<?php include '../uc/addConsultationFile/addConsultationFileController.php'; ?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Fisa de consultatie</h5>
    <div class="row mt-2">
        <div class="col-12">
            <?php if ($errMsg != null) { ?>
                <div class='text-danger'>
                    <?php echo $errMsg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <form action="/pages/addConsultationFilePage.php?id=<?php echo $idConultation ?>" method="post" novalidate>
        <div class="row mt-2">
            <div class="col-12">
                <label for="pacientName" class="form-label">Nume pacient</label>
                <input type="text" class="form-control" id="pacientName" autocomplete="false" name="pacientName"
                       value="<?php echo $consultationFile->getPacientName() ?>" readonly>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="cnp" class="form-label">CNP pacient</label>
                <input type="text" class="form-control" id="cnp" autocomplete="false" name="cnp"
                       value="<?php echo $consultationFile->getCnp() ?>" readonly>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="medicName" class="form-label">Nume medic</label>
                <input type="text" class="form-control" id="medicName" autocomplete="false" name="medicName"
                       value="<?php echo $consultationFile->getMedicName() ?>" readonly>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="diagnostic" class="form-label">Diagnostic</label>
                <input type="text" class="form-control" id="diagnostic" autocomplete="false" name="diagnostic">
                <?php if ($errDiagnosticMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errDiagnosticMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="recomendedAnalyses" class="form-label">Analize recomandate</label>
                <input type="text" class="form-control" id="recomendedAnalyses" autocomplete="false" name="recomendedAnalyses">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <label for="recomendedTreatement" class="form-label">Tratament recomandat</label>
                <input type="text" class="form-control" id="recomendedTreatement" autocomplete="false" name="recomendedTreatement">
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-12">
                <input type="submit" name="submit" value="Salveaza">
            </div>
        </div>
    </form>
</div>
</body>
</html>
