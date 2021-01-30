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
                      'overview'=>array('name'=>'Overview', 'url'=>'/overview','icon'=>'fa-table'),
                      'instruction'=>array('name'=>'Instruction', 'url'=>'/instruction','icon'=>'fa-table'),
                      'story'=>array('name'=>'Story', 'url'=>'/story','icon'=>'fa-table'),
                      'word'=>array('name'=>'Word', 'url'=>'/word','icon'=>'fa-table'),
                      'storysession'=>array('name'=>'Session', 'url'=>'/storySession','icon'=>'fa-table'),
                    );
  	\View::share('sideMenu', $sideMenu);
  }
  
  function pr($data) {
  	echo '<pre>';
  	print_r($data);
  	echo '</pre>';
  }
}
