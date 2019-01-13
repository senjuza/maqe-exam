<?php
/**
 * Created by PhpStorm.
 * User: doc_1
 * Date: 13/01/2019
 * Time: 18:31
 */

namespace App\Http\Model;

use League\Flysystem\Config;
use Illuminate\Support\Facades\Log;

class BotModel
{


    public $pos_x=0;
    public $pos_y=0;
    public $directionName="";
    public $directionIndex="";

    public function __construct($pos_x=0, $pos_y=0 ,$directionObj=null){
        Log::debug('--- do construct---');
        $this->pos_x = $pos_x;
        $this->pos_y = $pos_y;

        if($directionObj){
            $this->directionName = $directionObj->name;
            $this->directionIndex = $directionObj->index;
        }

    }



}