<?php

namespace Utiles;

class MySQLUtil {
    private static function getConnection() {
        $sqlconn = new \MySQLi("localhost","root","","integrador");
        return $sqlconn;
    }
    public static function execute($sqlTxt) {
        $conn = MySQLUtil::getConnection();
        $rnro = mysqli_errno($conn);
        if ($rnro != 0) {
            return ["resultado" => "error"];
        }
        $resultset = $conn->query($sqlTxt);
        $rnro = mysqli_errno($conn);
        if ($rnro != 0) {
            $conn->close();
            return ["resultado" => "error"];
        }
        $conn->close();
        return ["resultado" => "ok"];
    }
    public static function query($sqlTxt) {
        $conn = MySQLUtil::getConnection();
        $rnro = mysqli_errno($conn);
        if ($rnro != 0) {
            $conn->close();
            return ["resultado" => "error"];
        }
        $resultset = $conn->query($sqlTxt);
        $rnro = mysqli_errno($conn);
        if ($rnro != 0) {
            $conn->close();
            return ["resultado" => "error"];
        }
        $ret = [];
        for ($rec = $resultset->fetch_assoc(); $rec != null; $rec = $resultset->fetch_assoc()) {
            array_push($ret, $rec);
        }
        $conn->close();
        return ["resultado" => "ok", "data" => $ret];
    }
}

?>