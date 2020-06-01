<?php
include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
global $db;
$link = $db->_Events();
$category = $db->_Category();


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
                  <i class="mdi mdi-format-list-bulleted"></i>
                </span> Etkinlikler </h3>
            <button type="button" class="btn btn-inverse-primary btn-fw componentAdd">YENİ</button>
        </div>
        <div class="row component">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-sample" action="javascript:void (0);">
                            <p class="card-description"> Etkinlik Bilgileri</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Kategori</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="eventCategory">
                                                <?php foreach ($category as $row) { ?>
                                                    <option value="<?php e($row['Id']); ?>"><?php e($row['name']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <input type="hidden" id="eventId" value="0">
                                        <label class="col-sm-3 col-form-label" for="eventName">Adı</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control name" id="eventName"
                                                   placeholder="Etkinlik Adı" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Etkinlik Durumu</label>
                                        <hr>
                                        <p>
                                            <input type="radio" id="radioAcik" class="eventDurum" name="radio-group"
                                                   value="1">
                                            <label for="radioAcik">Açık</label>
                                            <input type="radio" id="radioKapali" class="eventDurum" name="radio-group"
                                                   value="0">
                                            <label for="radioKapali">Kapalı</label>
                                        </p>
                                        <p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="eventDate">Tarih</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Etkinlik Tarihi"
                                                   id="eventDate"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="eventTime">Saati</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Etkinlik Saati"
                                                   id="eventTime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="eventImage1">K.Resim</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="eventImage1">
                                                <option value="">Seçiniz...</option>
                                                <?php if (!empty($resim)) {
                                                    foreach ($resim as $res) { ?>
                                                        <option value="<?php e($res); ?>"><?php e($res); ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="eventImage2">Resim</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="eventImage2">
                                                <option value="">Seçiniz...</option>
                                                <?php if (!empty($resim)) {
                                                    foreach ($resim as $res) { ?>
                                                        <option><?php e($res); ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="eventTime">Konumu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Etkinlik Konumu"
                                                   id="eventCord"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Açıklaması </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <textarea class="form-control" style="height: 200px" id="eventDesc"
                                                      required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div style="float:right;">
                                <button type="submit" class="btn btn-gradient-success mr-2 btnEventAdd">Kaydet</button>
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
                        <h4 class="card-title">Etkinlik Tablosu</h4>
                        <table class="table table-striped">
                            <thead>
                            <tr style="text-align: center">
                                <th></th>
                                <th> Etkinlik</th>
                                <th> Kategori</th>
                                <th> İsmi</th>
                                <th> Açıklama</th>
                                <th> K.Resim</th>
                                <th> Resim</th>
                                <th> Konum</th>
                                <th> Tarih</th>
                                <th> Saat</th>
                                <th> Durumu</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <?php foreach ($link as $row) { ?>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="mdi mdi-delete-forever eventDelete" style="font-size: 25px"
                                               data-value="<?php e($row['Id']); ?>"></i>
                                        </a>
                                        <a href="#">
                                            <i class="mdi mdi-lead-pencil eventEdit"
                                               style="font-size: 25px; color: rebeccapurple "
                                               data-value="<?php e($row['Id']); ?>"
                                               data-name="<?php e($row['name']); ?>"
                                               data-category="<?php e($row['categoryId']); ?>"
                                               data-desc="<?php e($row['description']); ?>"
                                               data-image1="<?php e($row['image1']); ?>"
                                               data-image2="<?php e($row['image2']); ?>"
                                               data-date="<?php e($row['date']); ?>"
                                               data-time="<?php e($row['time']); ?>"
                                               data-cord="<?php e($row['konum']); ?>"
                                               data-durum="<?php e($row['durum']); ?>"
                                            ></i>
                                        </a>
                                    </td>
                                    <td class="py-1"> <?php e($row['Id']); ?></td>
                                    <td>
                                        <?php
                                        $categorySingle = $db->_CategorySingle($row['categoryId']);
                                        foreach ($categorySingle as $catSingle)
                                            e($catSingle['name']);
                                        ?>
                                    </td>
                                    <td> <?php e($row['name']); ?></td>
                                    <td style="white-space: nowrap;
                                               overflow: hidden;
                                               max-width: 500px;"><?php e($row['description']); ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="eventModal"
                                           data-toggle="modal" data-target="#modalImage"
                                           data-value="<?php e($row['image1']); ?>"
                                           data-name="<?php e($row['name']); ?>">
                                            <i class="mdi mdi-file-image" style="font-size: 25px"></i>
                                        </a>
                                        <?php e(' ' . $row['image1']); ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="eventModal"
                                           data-toggle="modal" data-target="#modalImage"
                                           data-value="<?php e($row['image2']); ?>"
                                           data-name="<?php e($row['name']); ?>">
                                            <i class="mdi mdi-file-image" style="font-size: 25px"></i>
                                        </a>
                                        <?php e(' ' . $row['image2']); ?>
                                    </td>
                                    <td> <?php e($row['konum']); ?></td>
                                    <td> <?php e($row['date']); ?></td>
                                    <td> <?php e($row['time']); ?></td>
                                    <td style="text-align: center">
                                        <input type="checkbox" class="tableCheck" value="<?php e($row['durum']); ?>"
                                               disabled
                                               style="height: 18px;width: 18px;">
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