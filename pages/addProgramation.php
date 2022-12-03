<?php include '../uc/addProgramation/addProgramationController.php'; ?>
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
    <form action="/pages/addProgramation.php" method="post" novalidate>
        <div class="row mt-2">
            <div class="col-12">
                <label for="dataProgramarii" class="form-label">Data programarii</label>
                <input type="date" class="form-control" id="dataProgramarii" autocomplete="false" name="dataProgramarii"
                       value="<?php echo $dataProgramarii ?>">
                <?php if ($errDataProgramariiMsg != null) { ?>
                    <div class='text-danger'>
                        <?php echo $errDataProgramariiMsg; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row mt-2">
            <div class="coll-12">
                <label for="oraProgramarii" class="form-label">Ora programarii</label>
                <select name="oraProgramarii" id="oraProgramarii" class="form-select">
                    <option value=""></option>
                    <?php foreach ($intervalsArray as $value) { ?>
                        <option value="<?php echo $value->getId() ?>"><?php echo $value->getLabel() ?></option>
                    <?php } ?>
                </select>
                <label for="doctor" class="form-label">Doctor</label>
                <select name="doctor" id="doctor" class="form-select">
                    <option value=""></option>
                    <?php foreach ($medicsArray as $value) { ?>
                        <option value="<?php echo $value->getId() ?>"><?php echo $value->getLabel() ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </form>
</div>
</body>
</html>