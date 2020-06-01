<?php
include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
global $db;
$link = $db->_Settings();
$config = array();
foreach ($link as $key => $row) {
    $config[$key] = $row;
}
?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-settings"></i>
                </span> Ayarlar </h3>
        </div>

        <div class="row content">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body content-table">
                        <div class="form-group">
                            <h4 class="card-title"><?php e($config[0]['name']); ?></h4>
                            <textarea id="configHak" class="form-control wysiwgArea" rows="11"
                                      data-id="<?php e($config[0]['Id']); ?>"><?php e($config[0]['value']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-gradient-success mr-2 btnConfigHak" style="float: right">
                            Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php include "$_SERVER[DOCUMENT_ROOT]/partials/_footer.php" ?>
    </div>
</div>
