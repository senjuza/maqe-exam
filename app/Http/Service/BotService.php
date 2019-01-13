<?php
/**
 * Created by PhpStorm.
 * User: doc_1
 * Date: 13/01/2019
 * Time: 18:50
 */

namespace App\Http\Service;

use Illuminate\Support\Facades\Log;
use App\Http\Model\BotModel;
use Illuminate\Support\Facades\Config;

class BotService
{


    protected $botObj;
    private $directionArray;
    private $directionIndexArray;

    public function init(){
        $bot = new BotModel();

        //check session
        //todo:: check session

        //found use old data
        //todo:found use old data

        //if not found create new

        $this->botObj = new BotModel(0,0, (object)Config::get('const.DIRECTION.NORTH'));
        $this->directionArray = Config::get('const.DIRECTION');

        $this->directionIndexArray = [];
        foreach ($this->directionArray as $direction){
            $directionObj = (object)$direction;
            $this->directionIndexArray[$directionObj->index] = $directionObj;
        }

    }

    public function getBot(){
        return $this->botObj;
    }
    public function save(){}
    public function calculate($cmdAction){
        foreach ($cmdAction as $action){

            if(!is_numeric($action)) {
                switch ($action) {
                    case 'r':
                        $this->getDirection($this->botObj, true);
                        break;
                    case 'l':
                        $this->getDirection($this->botObj, false);
                        break;
                }
            }else{
                $this->getPosition($this->botObj, $action);
            }
        }
        return $this->botObj;
    }

    private function getDirection($obj, $clockwise=true){
        $directionIndex = $obj->directionIndex;
        if($clockwise){
            $directionIndex++;
        }else{
            $directionIndex--;
        }
        $size = sizeof($this->directionArray);

        if($directionIndex<0){
            $directionIndex = $size-1;
        }elseif($directionIndex >= $size){
            $directionIndex = 0;


        }

        foreach ($this->directionArray as $direction){
            $directionObj = (object)$direction;
            if($directionObj->index === $directionIndex){
                $obj->directionIndex = $directionObj->index;
                $obj->directionName = $directionObj->name;

                break;
            }
        }

    }

    private function getPosition($obj, $value){
        $value = intval($value);
        $directionIndex = $obj->directionIndex;
        //
        $directionObj = $this->directionIndexArray[$directionIndex];

        switch ($directionObj->xAction) {
            case '+':
                $obj->pos_x+=$value;
                break;
            case '-':
                $obj->pos_x-=$value;
                break;
        }

        switch ($directionObj->yAction) {
            case '+':
                $obj->pos_y+=$value;
                break;
            case '-':
                $obj->pos_y-=$value;
                break;
        }

    }

}