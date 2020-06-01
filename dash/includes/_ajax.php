<?php
include "$_SERVER[DOCUMENT_ROOT]/includes/_config.php";
include "$_SERVER[DOCUMENT_ROOT]/includes/_database.php";
global $db;

if (isset($_POST['action']) && $_POST['action'] == 'noteAdd') {
    $data = array("note" => $_POST['note'], "durum" => "0");
    $insert = $query = $db->_Insert("_note", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'noteDelete') {
    $delete = $query = $db->_Delete("_note", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'noteUpdate') {
    $data = array("durum" => $_POST['durum'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_note", $data);
    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'linkAdd') {
    $data = array("name" => $_POST['name'], "url" => $_POST['url'], "durum" => $_POST['durum']);
    $insert = $query = $db->_Insert("_link", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'linkDelete') {
    $delete = $query = $db->_Delete("_link", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'linkUpdate') {
    $data = array("name" => $_POST['name'], "url" => $_POST['url'], "durum" => $_POST['durum'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_link", $data);
    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'anketAdd') {
    $data = array("name" => $_POST['name'], "kod1" => $_POST['kod1'], "durum" => $_POST['durum'], "kod2" => $_POST['kod2'], "kod3" => $_POST['kod3'], "kod4" => $_POST['kod4'], "description" => $_POST['description']);
    $insert = $query = $db->_Insert("_survey", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'anketDelete') {
    $delete = $query = $db->_Delete("_survey", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'anketUpdate') {
    $data = array("name" => $_POST['name'], "kod1" => $_POST['kod1'], "durum" => $_POST['durum'], "kod2" => $_POST['kod2'], "kod3" => $_POST['kod3'], "kod4" => $_POST['kod4'], "description" => $_POST['description'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_survey", $data);

    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'catAdd') {
    $data = array("name" => $_POST['name'], "icon" => $_POST['icon'], "durum" => $_POST['durum']);
    $insert = $query = $db->_Insert("_category", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'catDelete') {
    $delete = $query = $db->_Delete("_category", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'catUpdate') {
    $data = array("name" => $_POST['name'], "icon" => $_POST['icon'], "durum" => $_POST['durum'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_category", $data);
    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'userAdd') {
    $data = array("name" => $_POST['name'], "passw" => $_POST['passw'], "position" => $_POST['position'], "mail" => $_POST['mail'], "durum" => $_POST['durum']);
    $insert = $query = $db->_Insert("_user", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'userDelete') {
    $delete = $query = $db->_Delete("_user", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'userUpdate') {
    $data = array("name" => $_POST['name'], "passw" => $_POST['passw'], "position" => $_POST['position'], "mail" => $_POST['mail'], "durum" => $_POST['durum'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_user", $data);

    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'eventAdd') {
    $data = array("name" => $_POST['name'], "konum" => $_POST['konum'], "image1" => $_POST['image1'], "durum" => $_POST['durum'], "image2" => $_POST['image2'], "date" => $_POST['date'], "time" => $_POST['time'], "description" => $_POST['description'], "categoryId" => $_POST['categoryId']);
    $insert = $query = $db->_Insert("_events", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'eventDelete') {
    $delete = $query = $db->_Delete("_events", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'eventUpdate') {
    $data = array("name" => $_POST['name'], "konum" => $_POST['konum'], "image1" => $_POST['image1'], "durum" => $_POST['durum'], "image2" => $_POST['image2'], "date" => $_POST['date'], "time" => $_POST['time'], "description" => $_POST['description'], "categoryId" => $_POST['categoryId'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_events", $data);

    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'logAdd') {
    $data = array("name" => $_POST['name'], "image" => $_POST['image'], "durum" => $_POST['durum']);
    $insert = $query = $db->_Insert("_customerLogo", $data);
    if ($insert = true) {
        print_r("İşlem başarılı!");
    } else {
        return $insert;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'logDelete') {
    $delete = $query = $db->_Delete("_customerLogo", $_POST['Id']);
    if ($delete = true) {
        print_r("İşlem başarılı!");
    } else {
        return $delete;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'logUpdate') {
    $data = array("name" => $_POST['name'], "image" => $_POST['image'], "durum" => $_POST['durum'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_customerLogo", $data);

    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'imageDelete') {
    $path = "$_SERVER[DOCUMENT_ROOT]/assets/images/uploadFile/" . $_POST['path'];
    if (file_exists($path)) {
        unlink($path);
        echo 1;
    } else {
        echo 0;
    }
    die;
}
if (isset($_POST['action']) && $_POST['action'] == 'configUpdate') {
    $data = array("value" => $_POST['value'], "Id" => $_POST['Id']);
    $update = $query = $db->_Update("_settings", $data);

    if ($update = true) {
        print_r("İşlem başarılı!");
    } else {
        return $update;
    }
}