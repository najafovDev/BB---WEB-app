<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GtfsController
 *
 * @author sahil1
 */
class GtfsController  extends Controller{
    
    public function actionAgency(){
        
        $this->renderPartial('agency');
    }
    public function actionStops(){
        $output['stops'] = Busstop::model()->findAll();
        $this->renderPartial('stops',$output);
    }
    public function actionRoutes(){
        $output['routes'] = BbRoute::model()->findAll();
        $this->renderPartial('routes',$output);
    }
    public function actionTrips(){
        $output['routes'] = BbRoute::model()->findAll();
        $this->renderPartial('trips',$output);
    }
    public function actionStop_times(){
        $output['routes'] = BbRoute::model()->findAll();
        $this->renderPartial('stop_times',$output);
    }
    public function actionCalendar(){
        $this->renderPartial('calendar');
    }
    public function actionCalendar_dates(){
        $output['routes'] = BbRoute::model()->findAll();
        $this->renderPartial('calendar',$output);
    }
    public function actionShapes(){
        $output['paths'] = BbPath::model()->findAll();
        $this->renderPartial('shapes',$output);
    }
    public function actionSolve($id){
        $sum = 0;
        for($i=1;$i<=$id;$i++){
            $sum+=$this->actionTestSolve($i);
//            echo $i;
        }
        echo $sum;
    }
    public function actionTestSolve($id){
        $id = (int) $id;
//        echo floor($id/1000);
//        echo '<br>';
        $hundred = floor(($id)/100);
//        echo '<br>';
        $ten = floor(($id-$hundred*100)/10);
//        echo '<br>';
        $remaining = $id%10;
        return $hundred+$ten +$remaining;
    }
}
