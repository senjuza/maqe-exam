<?php
/**
 * Created by PhpStorm.
 * User: doc_1
 * Date: 13/01/2019
 * Time: 15:37
 */

namespace App\Http\Controllers;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Service\BotService;
use App\Http\ExceptionHandle\InvalidCMDException;

class BotController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    protected $permissionName = 'event';

    public function __construct(){

    }



    public function  sayHello(){
        $data = [];
        return view('bot.index')->with($data);
    }
    public function calculateDirection(Request $request){

        //------------- receive parameter -----------
        $cmd    = $request->input('cmd');
        $cmd = strtolower($cmd);
        Log::debug('$cmd='.$cmd);

        //------------- validate parameter -----------
        $validText = "rlw";
        if (preg_match("/[^0-9".$validText."]/", $cmd))
        {
            Log::debug('---- Invalid characters found ---');
            $response = [
                'status' => '0',
                'title' => 'Error!',
                'message' => 'Invalid characters found.',
            ];
            return response()->json($response);
        }

        //------------- service -----------
        $botService = new BotService();
        $botService->init();
        $cmdArr = [];
        try {
            $cmdArr = $this->parseCmdToArray($cmd);
        } catch (InvalidCMDException $e) {
            //report($e);

            Log::debug('---- Invalid characters format ---');
            $response = [
                'status' => '0',
                'title' => 'Error!',
                'message' => 'Invalid characters format.',
            ];
            return response()->json($response);
        }

        $botObj = $botService->calculate($cmdArr);
        $botService->save();


        $resultText = sprintf(
            'X:%s Y:%s Direction: %s'
            ,$botObj->pos_x
            ,$botObj->pos_y
            ,$botObj->directionName
        );

        //-----------------------
        $response = [
            'status' => '1',
            'title' => 'Success',
            'message' => $resultText,
        ];



        Log::debug('---- finish ---');
        // TODO Logger
        return response()->json($response);
    }

    private function parseCmdToArray($cmdText){
        $chars = str_split($cmdText);

        $resultArray =[];
        $tempChar = "";
        $count=0;
        $checkNumericOnly = false;
        foreach ($chars as $char){
            if(is_numeric($char)){
                if(!$checkNumericOnly){
                    throw new InvalidCMDException('Invalid CMD input !!!');
                }
                $tempChar .= $char;

            }else{
                if(!empty($tempChar)){
                    //if prev is integer
                    $resultArray[] = $tempChar;
                    $tempChar = '';
                    $checkNumericOnly = false;
                }
                if($char==='w'){
                    $checkNumericOnly = true;
                }elseif($checkNumericOnly){
                    throw new InvalidCMDException('Invalid CMD input !!!');
                }
                $resultArray[] = $char;
            }

            $count++;
            //check is last
            if(sizeof($chars) === $count && !empty($tempChar)){
                $resultArray[] = $tempChar;
            }
            if(sizeof($chars) === $count && $char==='w'){
                throw new InvalidCMDException('Invalid CMD input !!!');
            }
        }

        return $resultArray;
    }


}