<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sanction\StoreSanctionRequest;
use Illuminate\Http\Request;
use App\Models\Sanction ;
use App\Models\User;
use App\Services\SanctionService\SanctionService;
class SanctionController extends Controller
{

private $SanctionService;

public function __construct(SanctionService $SanctionService){

    $this->SanctionService=$SanctionService;
}


}
