<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function datasql($databr) {
    if (!empty($databr)) {
        $p_dt = explode('/', $databr);
        $data_sql = $p_dt[2] . '-' . $p_dt[1] . '-' . $p_dt[0];
        return $data_sql;
    }
}
?>
