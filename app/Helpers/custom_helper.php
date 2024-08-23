<?php
// app/Helpers/custom_helper.php

use App\Models\ModelCrud;

if (!function_exists('countDataCart')) {
    function countDataCart() {
        $model = new ModelCrud();
        $session = session();
        $uid = $session->get('id');
        $model->setParamDataPagination("tbl_cart");
        $cart = $model->select_1_cond("user_id", $uid);
        return count($cart);
    }
}
