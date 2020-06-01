<?php
include "$_SERVER[DOCUMENT_ROOT]/includes/_config.php";
include "$_SERVER[DOCUMENT_ROOT]/includes/_database.php";
global $db;

if (isset($_POST['action']) && $_POST['action'] == 'evList') {
    $data = $db->_EventsSingle($_POST['Id']);
    foreach ($data as $key => $row) {
        $control = true; ?>
        <div class="col-sm-6 col-md-4 col-xs-6">
            <div class="card">
                <img class="card-img-top" style="border-radius: 5px 5px 10px 10px"
                src="https://www.dash.thegettinout.com/assets/images/uploadFile/<?php e($row['image1']); ?>"
                alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title pb-2 border-bottom border-info"
                        style="color: orange;text-align:center;font-weight: 400;"><?php e($row['name']); ?></h3>
                    <h5 class="card-title pb-2" style="color: white;margin: 0; padding: 0;font-weight: 500;">
                        <?php e($row['date']); ?> - <?php e($row['time']); ?>
                        <i class="material-icons" style="vertical-align: bottom; float: right;">access_time</i></h5>
                    <?php if (!empty($row['konum']) || is_null($row['konum'])) { ?>
                        <h5 class="card-title pb-2" style="color: white;margin: 0; padding: 0;font-weight: 500;font-style: italic;">
                            <?php e($row['konum']); ?>
                            <i class="material-icons" style="vertical-align: bottom; float: right;">my_location</i></h5>
                    <?php } ?>
                    <p class="card-text"
                       style="overflow: hidden; text-overflow: ellipsis; max-height: 100px; color: white;">
                        <?php e($row['description']); ?>
                    </p>
                    <a class="float-right conBtn"
                       style="background: linear-gradient(60deg, #029eb1, #25b1c3);box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4); padding: 5px 25px; border-radius: 10px"
                       href="javascript:void(0)" data-id="<?php e($row['Id']); ?>">Daha fazla...</a>
                </div>
            </div>
        </div>
    <?php }
    if (!isset($control) || !$control) { ?>
        <div class="container" style="text-align: center; margin-top: 50px;">
            <h3> Aradığınız Kategori ile ilgili Etkinlik Bulunamadı </h3>
        </div>
    <?php }
}

if (isset($_POST['action']) && $_POST['action'] == 'dashboardShow') {
    $dataWeek = $db->_EventsNowBetWeek();
    foreach ($dataWeek as $key => $row) { ?>
        <div class="col-sm-6 col-md-3 col-xs-6 tabDash ">
            <div class="card">
                <img class="card-img-top" style="border-radius: 5px 5px 10px 10px"
                     src="https://www.dash.thegettinout.com/assets/images/uploadFile/<?php e($row['image1']); ?>"
                     alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title pb-2 border-bottom border-info"
                        style="color: orange;text-align:center;font-weight: 400;"><?php e($row['name']); ?></h4>
                    <h5 class="card-title pb-2" style="color: white;margin: 0; padding: 0;font-weight: 500;">
                        <?php e($row['date']); ?> - <?php e($row['time']); ?>
                        <i class="material-icons" style="vertical-align: bottom; float: right;">access_time</i></h5>
                    <?php if (!empty($row['konum']) || is_null($row['konum'])) { ?>
                        <h5 class="card-title pb-2" style="color: white;margin: 0; padding: 0;font-weight: 500;font-style: italic;">
                            <?php e($row['konum']); ?>
                            <i class="material-icons"
                               style="vertical-align: bottom; float: right;">my_location</i></h5>
                    <?php } ?>
                    <p class="card-text"
                       style="overflow: hidden; text-overflow: ellipsis; max-height: 100px; color: white;">
                        <?php e($row['description']); ?>
                    </p>
                    <a class="float-right conBtn"
                       style="background: linear-gradient(60deg, #029eb1, #25b1c3);box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4); padding: 5px 25px; border-radius: 10px"
                       href="javascript:void(0)" data-id="<?php e($row['Id']); ?>">Daha fazla...</a>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
    <script>
        var appURL = 'http://the.localhost/';
        //var appURL = 'https://www.dev.thegettinout.com/';

        $(".conBtn").on("click", function () {
            $(".itemList").fadeToggle("fast");
            var formData = {};
            formData['Id'] = $(this).data("id");
            formData['action'] = "eventDetail";
            $.ajax({
                url: appURL + 'includes/_ajaxDetail.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $(".itemList").html(data);
                    $(".itemList").fadeToggle("fast");
                }
            });
            $(".main-panel").scrollTop(0);
        });

    </script>
<?php if (isset($_POST['action']) && $_POST['action'] == 'searchList') {
    $data = $db->_EventsSearch($_POST['search']);
    foreach ($data as $key => $row) {
        $control = true; ?>
        <div class="col-sm-6 col-md-4 col-xs-6">
            <div class="card">
                <img class="card-img-top" style="border-radius: 5px 5px 10px 10px"
                src="https://www.dash.thegettinout.com/assets/images/uploadFile/<?php e($row['image1']); ?>"
                alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title pb-2 border-bottom border-info"
                        style="color: orange;text-align:center;font-weight: 400;"><?php e($row['name']); ?></h3>
                    <h5 class="card-title pb-2" style="color: white;margin: 0; padding: 0;font-weight: 500;">
                        <?php e($row['date']); ?> - <?php e($row['time']); ?>
                        <i class="material-icons" style="vertical-align: bottom; float: right;">access_time</i></h5>
                    <?php if (!empty($row['konum']) || is_null($row['konum'])) { ?>
                        <h5 class="card-title pb-2" style="color: white;margin: 0; padding: 0;font-weight: 500;font-style: italic;">
                            <?php e($row['konum']); ?>
                            <i class="material-icons" style="vertical-align: bottom; float: right;">my_location</i></h5>
                    <?php } ?>
                    <p class="card-text"
                       style="overflow: hidden; text-overflow: ellipsis; max-height: 100px; color: white;">
                        <?php e($row['description']); ?>
                    </p>
                    <a class="float-right conBtn"
                       style="background: linear-gradient(60deg, #029eb1, #25b1c3);box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4); padding: 5px 25px; border-radius: 10px"
                       href="javascript:void(0)" data-id="<?php e($row['Id']); ?>">Daha fazla...</a>
                </div>
            </div>
        </div>
    <?php }
    if (!isset($control) || !$control) { ?>
        <div class="container" style="text-align: center; margin-top: 50px;">
            <h3> Aramanıza Uygun Etkinlik Bulunamadı</h3>
        </div>
    <?php }
}
