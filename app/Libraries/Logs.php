<?php

namespace App\Libraries;

use App\Models\LogModel;

class Logs {

    private LogModel $logModel;

    public function __construct()
    {
        $this->logModel = model('LogModel');
    }

    public function save($params = []) {
        $this->logModel->create($params);
    }

}