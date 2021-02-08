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
  	$sideMenu = array('dashboard'=>array('name'=>'Dashboard', 'url'=>'/dashboard','icon'=>'fa-tachometer-alt', 'role'=>''), 
                  'trainee'=>array('name'=>'Trainee Information', 'url'=>'/trainee','icon'=>'fa-table', 'role'=>''), 
                  'overview'=>array('name'=>'Overview', 'url'=>'/overview','icon'=>'fa-table', 'role'=>'SA'),
                  'instruction'=>array('name'=>'Instruction', 'url'=>'/instruction','icon'=>'fa-table', 'role'=>'SA'),
                  'story'=>array('name'=>'Story', 'url'=>'/story','icon'=>'fa-table', 'role'=>'SA'),
                  'word'=>array('name'=>'Word', 'url'=>'/word','icon'=>'fa-table', 'role'=>'SA'),
                  'type'=>array('name'=>'Session Type', 'url'=>'/type','icon'=>'fa-table', 'role'=>'SA'),
                );
  	\View::share('sideMenu', $sideMenu);
  }
  
  function pr($data) {
  	echo '<pre>';
  	print_r($data);
  	echo '</pre>';
  }
}
