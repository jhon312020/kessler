<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function __construct() {
  	$sideMenu = array('dashboard'=>array('name'=>'Dashboard', 'url'=>'/dashboard','icon'=>'fa-tachometer-alt'), 
                      'trainee'=>array('name'=>'Trainee', 'url'=>'/trainee','icon'=>'fa-table'), 
                      'overviews'=>array('name'=>'Overview', 'url'=>'/dashboard','icon'=>'fa-table'),
                      'instructions'=>array('name'=>'Instruction', 'url'=>'/instructions','icon'=>'fa-table'),
                      'story'=>array('name'=>'Story', 'url'=>'/story','icon'=>'fa-table'),
                      'words'=>array('name'=>'Word', 'url'=>'/words','icon'=>'fa-table'),
                      'StorySession'=>array('name'=>'Session', 'url'=>'/StorySession','icon'=>'fa-table'),
                    );
  	\View::share('sideMenu', $sideMenu);
  }
  
  function pr($data) {
  	echo '<pre>';
  	print_r($data);
  	echo '</pre>';
  }
}
