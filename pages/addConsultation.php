<?php include '../uc/addConsultation/addConsultationController.php';
$pageTitle = 'Adaugare consultatie';
?>
<!doctype html>
<html lang="en">
<?php include '../templates/head.php'; ?>
<body>
<?php include '../templates/menu.php'; ?>
<div class="container-fluid">
    <h5>Adauga programare</h5>
    <div class="row mt-2">
        <div class="col-12">
            <?php if ($errMsg != null) { ?>
                <div class='text-danger'>
                    <?php echo $errMsg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <form action="/pages/addConsultation.php" method="post" novalidate>
        <input type="hidden" name="csfrToken" value="<?php echo $_SESSION["csfrToken"] ?>">
        <div class="row mt-2">
            <div class="col-12">
                <label for="consultationDate" class="form-label">Data programarii</label>
                <input type="date" class="form-control" id="consultationDate" autocomplete="false" name="consultationDate"
                       value="<?php echo $consultationDate ?>">
                <?php if ($errConsultationDateMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errConsultationDateMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="coll-12">
                <label for="idInterval" class="form-label">Ora programarii</label>
                <select name="idInterval" id="idInterval" class="form-select">
                    <option value=""></option>
                    <?php foreach ($intervalsArray as $value) { ?>
                        <option value="<?php echo $value->getId(); ?>" <?php if($idInterval == $value->getId()) { ?> selected <?php } ?>><?php echo $value->getLabel(); ?></option>
                    <?php } ?>
                </select>
                <?php if ($errIdIntervalMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errIdIntervalMsg; ?>
                    </div>
                <?php } ?>
                <label for="idMedic" class="form-label">Doctor</label>
                <select name="idMedic" id="idMedic" class="form-select">
                    <option value=""></option>
                    <?php foreach ($medicsArray as $value) { ?>
                        <option value="<?php echo $value->getId(); ?>" <?php if($idMedic == $value->getId()) { ?> selected <?php } ?>><?php echo $value->getLabel(); ?></option>
                    <?php } ?>
                </select>
                <?php if ($errIdMedicMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errIdMedicMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <p>Pe emailul introdus veti primi o confirmare ca programarea a fost facuta</p>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Adauga programare</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>