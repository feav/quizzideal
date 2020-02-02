<?php

function getSettings ($pdo) {
    $setts_sql = "SELECT * FROM cashbackengine_settings";
    //$setts_result = smart_mysql_query($setts_sql);
    unset($settings);
    $settings = array();
    $req = $pdo->query($setts_sql);
    $setts_result = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($setts_result as $setts_row)
    {
        $settings[$setts_row['setting_key']] = $setts_row['setting_value'];
    }
    return $settings;
}

/**
 * @param $pdo PDO
 * @param $key_settings
 * @param $value
 */
function updateSettings($pdo, $key_settings, $value) {
    $stmt = $pdo->prepare("INSERT INTO cashbackengine_settings (setting_key, setting_value) VALUES (:setting_key, :setting_value)");
    $stmt->bindParam(':setting_key', $key_settings);
    $stmt->bindParam(':setting_value', $value);
    $stmt->execute();

    $stmt = $pdo->prepare("SELECT * FROM REGISTRY where name = ?");
    if ($stmt->execute($key_settings)) {
        return $stmt->fetch();
    }
}
