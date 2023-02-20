<?php
namespace Drupal\training\Controller;
use Drupal\Core\Controller\ControllerBase;
class TrainingNewController extends ControllerBase {
  public function training() {
    $config_object = \Drupal::config('training.settings');
    return array(
      '#markup' => 'Namaste!!!! Welcome to our Training Website.'. $config_object->get('student_name'),
      
    );
  }  
}
