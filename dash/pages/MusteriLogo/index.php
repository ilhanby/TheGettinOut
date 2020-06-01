<?php
include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
global $db;
$link = $db->_Customer();

$dizin = "../../assets/images/uploadFile";
$tutucu = opendir($dizin);
while ($dosya = readdir($tutucu)) {
    if (is_file($dizin . "/" . $dosya))
        $resim[] = $dosya;
}
closedir($tutucu);
?>

<style>
    [type="radio"]:checked,
    [type="radio"]:not(:checked) {
        position: absolute;
        left: -9999px;
    }

    [type="radio"]:checked + label,
    [type="radio"]:not(:checked) + label {
        font-size: 18px;
        position: relative;
        padding-left: 48px;
        cursor: pointer;
        line-height: 20px;
        display: inline-block;
        color: #666;
        margin-right: 30px;
    }

    [type="radio"]:checked + label:before,
    [type="radio"]:not(:checked) + label:before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 28px;
        height: 28px;
        border: 1px solid #ddd;
        border-radius: 100%;
        background: #fff;
    }

    [type="radio"]:checked + label:after,
    [type="radio"]:not(:checked) + label:after {
        content: '';
        width: 20px;
        height: 20px;
        background: #F87DA9;
        position: absolute;
        top: 4px;
        left: 4px;
        border-radius: 100%;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    [type="radio"]:not(:checked) + label:after {
        opacity: 0;
        -webkit-transform: scale(0);
        transform: scale(0);
    }

    [type="radio"]:checked + label:after {
        opacity: 1;
        -webkit-transform: scale(1);
        transform: scale(1);
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-account-card-details"></i>
                </span> Müşteri Logoları - ( FOOTER FIELD ) </h3>
            <button type="button" class="btn btn-inverse-primary btn-fw componentAdd">YENİ</button>
        </div>
        <div class="row component">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="javascript:void (0);">
                            <div class="form-group">
                                <input type="hidden" id="logId" value="0">
                                <label for="logName"> Logo Adı ( Opsiyonel )</label>
                                <input type="text" class="form-control" id="logName" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="logImage"> Logo </label>
                                <select class="form-control" id="logImage">
                                    <option value="">Seçiniz...</option>
                                    <?php if (!empty($resim)) {
                                        foreach ($resim as $res) { ?>
                                            <option value="<?php e($res); ?>"><?php e($res); ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> Logo Durumu</label>
                                <hr>
                                <p>
                                    <input type="radio" id="radioAcik" class="logDurum" name="radio-group" value="1">
                                    <label for="radioAcik">Açık</label>
                                    <input type="radio" id="radioKapali" class="logDurum" name="radio-group" value="0">
                                    <label for="radioKapali">Kapalı</label>
                                </p>
                            </div>
                            <div style="float:right;">
                                <button type="submit" class="btn btn-gradient-success mr-2 btnLogAdd">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row content">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body content-table">
                        <h4 class="card-title"> Logo Tablosu </h4>
                        <table class="table table-striped ">
                            <thead>
                            <tr style="text-align: center">
                                <th></th>
                                <th> Logo</th>
                                <th> İsmi</th>
                                <th> Resim</th>
                                <th> Durumu</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <?php foreach ($link as $row) { ?>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="mdi mdi-delete-forever logDelete" style="font-size: 25px"
                                               data-value="<?php e($row['Id']); ?>"></i>
                                        </a>
                                        <a href="#">
                                            <i class="mdi mdi-lead-pencil logEdit"
                                               style="font-size: 25px; color: rebeccapurple "
                                               data-value="<?php e($row['Id']); ?>"
                                               data-name="<?php e($row['name']); ?>"
                                               data-image="<?php e($row['image']); ?>"
                                               data-durum="<?php e($row['durum']); ?>"
                                            ></i>
                                        </a>

                                    </td>
                                    <td class="py-1"> <?php e($row['Id']); ?></td>
                                    <td> <?php e($row['name']); ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="eventModal"
                                           data-toggle="modal" data-target="#modalImage"
                                           data-value="<?php e($row['image']); ?>"
                                           data-name="<?php e($row['name']); ?>">
                                            <i class="mdi mdi-file-image" style="font-size: 25px"></i>
                                        </a>
                                        <?php e(' ' . $row['image']); ?>
                                    </td>
                                    <td style="text-align: center">
                                        <input type="checkbox" class="tableCheck" value="<?php e($row['durum']); ?>"
                                               disabled style="height: 18px;width: 18px;">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "$_SERVER[DOCUMENT_ROOT]/partials/_footer.php" ?>
</div>
<div class="modal" id="modalImage" style="">
    <div class="modal-dialog" role="document" >
        <div class="modal-content card card-image">
            <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
                <section class="mb-4">
                    <h3 class="h1-responsive font-weight-bold text-center my-4" style="color: gray" id="modalName"></h3><br/>
                    <div class="row">
                        <div class="col-md-12 mb-md-0 mb-5" style="text-align: center">
                            <img id="modalImageSrc" style="width: 90%;height: 90%" />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
