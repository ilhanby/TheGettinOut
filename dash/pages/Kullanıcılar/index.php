<?php
include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
global $db;
$link = $db->_User();

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
                  <i class="mdi mdi-contacts"></i>
                </span> Kullanıcılar </h3>
            <button type="button" class="btn btn-inverse-primary btn-fw componentAdd">YENİ</button>
        </div>
        <div class="row component">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-sample" action="javascript:void (0);">
                            <p class="card-description"> Kullanıcı Bilgileri</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <input type="hidden" id="userId" value="0">
                                        <label class="col-sm-3 col-form-label" for="userName">Adı</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control name" id="userName"
                                                   placeholder="Kullanıcı Adı" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kullanıcı Durumu</label>
                                        <hr>
                                        <p>
                                            <input type="radio" id="radioAcik" class="userDurum" name="radio-group"
                                                   value="1">
                                            <label for="radioAcik">Açık</label>
                                            <input type="radio" id="radioKapali" class="userDurum" name="radio-group"
                                                   value="0">
                                            <label for="radioKapali">Kapalı</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="userPassw">Şifresi</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" placeholder="Şifresi"
                                                   id="userPassw"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="userPosition">Pozisyonu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Pozisyonu"
                                                   id="userPosition"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="userMail">E-Mail Hesabı</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" placeholder="E-Mail hesabı"
                                                   id="userMail" required/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div style="float:right;">
                                <button type="submit" class="btn btn-gradient-success mr-2 btnUserAdd">Kaydet</button>
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
                        <h4 class="card-title">Kullanıcı Tablosu</h4>
                        <table class="table table-striped ">
                            <thead>
                            <tr style="text-align: center">
                                <th></th>
                                <th> Kullanıcı</th>
                                <th> İsmi</th>
                                <th> Şifre</th>
                                <th> Pozisyon</th>
                                <th> Mail</th>
                                <th> Durumu</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <?php foreach ($link as $row) { ?>
                                <tr>
                                    <td>
                                        <a href="#">
                                            <i class="mdi mdi-delete-forever userDelete" style="font-size: 25px"
                                               data-value="<?php e($row['Id']); ?>"></i>
                                        </a>
                                        <a href="#">
                                            <i class="mdi mdi-lead-pencil userEdit"
                                               style="font-size: 25px; color: rebeccapurple "
                                               data-value="<?php e($row['Id']); ?>"
                                               data-name="<?php e($row['name']); ?>"
                                               data-passw="<?php e($row['passw']); ?>"
                                               data-position="<?php e($row['position']); ?>"
                                               data-mail="<?php e($row['mail']); ?>"
                                               data-durum="<?php e($row['durum']); ?>"
                                            ></i>
                                        </a>
                                    </td>
                                    <td class="py-1"> <?php e($row['Id']); ?></td>
                                    <td> <?php e($row['name']); ?></td>
                                    <td> * </td>
                                    <td> <?php e($row['position']); ?></td>
                                    <td> <?php e($row['mail']); ?></td>
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
