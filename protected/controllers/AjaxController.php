<?php

class AjaxController extends Controller
{
	public function actions(){
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}	
	public function actionIndex()
	{
		$this->render('index');
	}
        public function actionApi(){
            echo 'false';
        }
        public function actionApiNew(){
//            header('Content-Type: application/json');
            $s = curl_init(); 
            if (Yii::app()->cache->offsetExists('apiGis') && Yii::app()->cache->get('apiTime')-time()>10){
                echo Yii::app()->cache->get('apiGis');
                Yii::app()->end();
            }
            curl_setopt($s,CURLOPT_URL,'http://37.72.130.150/api1.php'); 
            curl_setopt($s,CURLOPT_TIMEOUT,1);
             $result = curl_exec($s);
            Yii::app()->cache->set('apiGis',$result);
            Yii::app()->cache->set('apiTime',time());
            
            curl_close($s);
        }
        public function actionSendAlarm(){
          error_reporting(E_ALL);
          ini_set('display_errors', true);
          echo mail('farid.esedli@bakubus.az,sadig.najafov@gmail.com,le.bord@gmail.com','[OCTOPUS] Impinj connection dropped','Impinj connection dropped');
        }
        public function actionWeather(){
          $return = array('time'=>date('Y-m-d h:i:s'));
            $content_type = 'application/json';
            $status = 200;

            // set the status
            $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
            header($status_header);

            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
            header("Access-Control-Allow-Headers: Authorization");
            header('Content-type: ' . $content_type);
          $url = 'http://api.openweathermap.org/data/2.5/weather?q=Baku,aze&appid=1fb65c72e0763fb47cd6be46539c3587&units=metric';
            if (Yii::app()->cache->offsetExists('apiWeather') && time()-Yii::app()->cache->get('apiWTime')<240){
                $result2= Yii::app()->cache->get('apiWeather');
                $result2['weather'][0]['main'] = Utilities::t($result2['weather'][0]['main']);
                $return['temp_c'] = (int)$result2['main']['temp']; 
                $return['wind_dir'] = $result2['wind']['deg']; 
                $return['wind_mph'] = $result2['wind']['speed']; 
                $return['atm_press_mmhg'] = $result2['main']['pressure']; 
                $return['relative_hum'] = ($result2['main']['humidity']==100?$result2['main']['humidity']-1:$result2['main']['humidity']); 
                echo CJSON::encode($return);
                Yii::app()->end();
            }
            
            $s = curl_init(); 
            curl_setopt($s,CURLOPT_URL,$url); 
            curl_setopt($s,CURLOPT_TIMEOUT,10);
            curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($s);
            $result2 = CJSON::decode($result);
            Yii::app()->cache->set('apiWeather',$result2);
            Yii::app()->cache->set('apiWTime',time());
//            print_r($result2);
//            die();
            $result2['weather'][0]['main'] = Utilities::t($result2['weather'][0]['main']);
            $return['temp_c'] = (int)$result2['main']['temp']; 
//            $return['wind_dir'] = $result2['wind']['deg']; 
            $return['wind_mph'] = $result2['wind']['speed']; 
            $return['atm_press_mmhg'] = $result2['main']['pressure']; 
            $return['relative_hum'] = ($result2['main']['humidity']==100?$result2['main']['humidity']-1:$result2['main']['humidity']); 
            echo CJSON::encode($return);
            curl_close($s);
        }
        public function actionWeather2(){
            if (Yii::app()->cache->offsetExists('apiWeather') && Yii::app()->cache->get('apiTimeW')-time()>1000){
                echo Yii::app()->cache->get('apiWeather');
                Yii::app()->end();
            }
            $content_type = 'application/json';
            $status = 200;

            // set the status
            $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
            header($status_header);

            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
            header("Access-Control-Allow-Headers: Authorization");
            header('Content-type: ' . $content_type);
            $s = curl_init(); 
            curl_setopt($s,CURLOPT_URL,'http://online.ada.edu.az/weather/api'); 
            curl_setopt($s,CURLOPT_TIMEOUT,10);
            $result = curl_exec($s);
//            print_r($result);
            Yii::app()->cache->set('apiWeather',$result);
            Yii::app()->cache->set('apiTimeW',time());
            
            curl_close($s);
        }
        public function actionGetPaths($id){
            $tmp = BbRoute::model()->findByPk($id);
            $output = array();
            
            foreach($tmp->paths as $path){
                $tmppath =BbRoutePath::model()->findByAttributes(array('path_id'=>$path->id,'route_id'=>$tmp->id));
                $output[$tmppath->direction]['busstops'] = $path->busstops;
                $output[$tmppath->direction]['id'] = $path->id;
                $output[$tmppath->direction]['length'] = $path->length;
            }
            echo CJSON::encode($output);
            
        }
        public function actionGetPathKml($id){
            if (($tmp=Yii::app()->cache->get('kml'.$id))!==false){
                echo $tmp;
                Yii::app()->end();
            }

            $tmp = BbPath::model()->findByPk($id);
            $tmp2 = BbRoutePath::model()->findByAttributes(array('path_id'=>$id));
            if ($tmp2->direction=='Forward'){
                $color = 'CC99FE00';
            } else 
                $color = '7afbff00';
            $kml=<<<KML
<?xml version="1.0" encoding="UTF-8"?>
<kml xmlns="http://earth.google.com/kml/2.1">
  <Document>
    <name></name>
    <description></description>
    <Style id="blueLine">
      <LineStyle>
        <color>{$color}</color>
        <width>4</width>
      </LineStyle>
    </Style>
    <Placemark>
      <name>Blue Line</name>
      <styleUrl>#blueLine</styleUrl>
      <LineString>
        <altitudeMode>relative</altitudeMode>
        <coordinates>{$tmp->kml}
        </coordinates>
      </LineString>
    </Placemark>
  </Document>
  </kml>
KML;
            echo $kml;
            Yii::app()->cache->set('kml'.$id, $kml, 25000);

        }        
        public function actionGetPathPL($id){
            $tmp = BbPath::model()->findByPk($id);
            $tmp2 = BbRoutePath::model()->findByAttributes(array('path_id'=>$id));
            if ($tmp2->direction=='Forward'){
                $color = 'CC99FE00';
            } else 
                $color = '7afbff00';
            $matches = explode(',0,', $tmp->kml);
            $return = array();
            foreach($matches as $match){
                $matches2 = explode(',', $match);
                $coord['lat'] = $matches2[0];
                $coord['lng'] = $matches2[1];
                $return[] = $coord;
            }
            echo CJSON::encode($return);
//            echo $kml;
        }        
        public function actionGetBusstop($name){
            $crit = new CDbCriteria();
            $crit->addSearchCondition('name', $name);
            $tmps = Busstop::model()->findAll($crit);
            $return = array();
            foreach($tmps as $tmp){
                $return[$tmp->id]=$tmp->name;
            }
            echo CJSON::encode($return);
        }
        public function actionMarker($text,$color='ff0000'){
            $id = $text;
            $colors = array(
                'h1'=>'ff0000',
                1=>'CA9E67',
                14=>'01FF52',
                13=>'fa8d00',
                7=>'b000fa',
                2=>'662483',
                3=>'E6007E',
                5=>'01FEFF',
                6=>'FF0E0E',
                8=>'CD96FF',
                
            );
            $color = isset($colors[$id])?$colors[$id]:'ff0000';
header('Content-type: image/svg+xml');
            $html =<<<HTML
<svg width="220" height="220" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
 <g>
  <circle stroke="#5fbf00" id="svg_1" r="107.54069" cy="112" cx="111" stroke-width="0" fill="#{$color}"/>
  <circle stroke="#5fbf00" id="svg_4" r="78" cy="112" cx="111" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke-width="0" fill="#ffffff"/>
  <text font-weight="bold" style="cursor: move;" stroke="#5fbf00" transform="matrix(4.694856114041273,0,0,5.0239418134392535,-345.50988268994644,-365.9827657574409) " xml:space="preserve" text-anchor="middle" font-family="Sans-serif" font-size="24" id="svg_7" y="102.70202" x="97.66561" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke-width="0" fill="#000000">{$id}</text>
 </g>
</svg>
HTML;
            $html2 =<<<HTML
<svg width="220" height="220" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
 <g>
  <circle stroke="#5fbf00" id="svg_1" r="107.54069" cy="112" cx="111" stroke-width="0" fill="#{$color}"/>
  <circle stroke="#5fbf00" id="svg_4" r="78" cy="112" cx="111" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke-width="0" fill="#ffffff"/>
  <text style="cursor: move;" fill="#000000" stroke-width="0" stroke-dasharray="null" stroke-linejoin="null" stroke-linecap="null" x="97.66561" y="102.70202" id="svg_7" font-size="24" font-family="Sans-serif" text-anchor="middle" xml:space="preserve" transform="matrix(4.694856114041273,0,0,5.0239418134392535,-345.50988268994644,-365.9827657574409) " stroke="#5fbf00" font-weight="bold">{$id}</text>
 </g>
</svg>
HTML;
            echo $html;
        }
        
        public function actionGetDirections($fromPlace,$toPlace){
            $s = curl_init(); 
            curl_setopt($s,CURLOPT_URL,'http://37.72.130.150:8080/otp/routers/default/plan?fromPlace='.$fromPlace.'&toPlace='.$toPlace.'&maxWalkDistance=1500&mode=BUSISH,WALK'); 
            curl_setopt($s,CURLOPT_TIMEOUT,2);
            curl_setopt($s, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($s);
            curl_close($s);            
            $json = CJSON::decode($result);
            if (isset($json['error']) && isset($json['error']['msg']))
              $json['error']['msg'] = Utilities::t($json['error']['msg']);
            echo CJSON::encode($json);
        }
        private function _getStatusCodeMessage($status)
        {
            // these could be stored in a .ini file and loaded
            // via parse_ini_file()... however, this will suffice
            // for an example
            $codes = Array(
                200 => 'OK',
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
            );
            return (isset($codes[$status])) ? $codes[$status] : '';
        }
}