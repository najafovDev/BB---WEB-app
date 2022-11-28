<?php
function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

class ElFinderConnectorAction extends CAction
{
    /**
     * @var array
     */
    public $settings = array();

    public function run()
    {
        $opts = array(
                // 'debug' => true,
                'roots' => array(
                        array(
                                'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                                'path'          => '../files/',         // path to files (REQUIRED)
                                'URL'           =>  '/files/', // URL to files (REQUIRED)
                                'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
                        )
                )
        );
        require_once(dirname(__FILE__) . '/php/elFinder.class.php');
        require_once(dirname(__FILE__) . '/php/elFinderConnector.class.php');
        require_once(dirname(__FILE__) . '/php/elFinderVolumeDriver.class.php');
        require_once(dirname(__FILE__) . '/php/elFinderVolumeLocalFileSystem.class.php');
        $fm = new elFinderConnector(new elFinder($opts));
        $fm->run();

    }
}
