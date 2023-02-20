<?php

namespace Drupal\training\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\training\Services\RikshawWala;
use Drupal\training\Services\TiffinWala;

class TrainingForm extends FormBase {
    protected $tiffinWala;
    protected $rikshawWala;

    public function __construct(TiffinWala $tiffin_wala,RikshawWala $rikshaw_wala)
    {
        $this->tiffinWala = $tiffin_wala;
        $this->rikshawWala = $rikshaw_wala;
    }

    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('tiffin.services'),
            $container->get('rikshaw.services')
           );
    }

  public function getFormId() {
    return 'training';
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['user_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Enter Name:'),
      '#required' => TRUE,
    );
   
    $form['user_phoneno'] = array (
      '#type' => 'tel',
      '#title' => t('Enter Contact Number'),
      '#required' => TRUE,

    );

    $form['user_address'] = array(
        '#type' => 'textfield',
        '#title' => t('Enter Address:'),
        '#required' => TRUE,
      );
    
    $form['actions']['#type'] = 'actions';
    
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('submit'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  //validateForm:the form must be checked to make sure all the mandatory fields are filled in. 
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if(strlen($form_state->getValue('user_name'))<1) 
    {
            $form_state->setErrorByName('user_name', $this->t('Please enter a valid Name'));
    }

    if(strlen($form_state->getValue('user_phoneno')) < 10) 
    {
            $form_state->setErrorByName('user_phoneno', $this->t('Please enter a valid Phone Number'));
    }
      
  }   

public function submitForm(array &$form, FormStateInterface $form_state)
 {
    $auto = $this->rikshawWala->getAuto();
     $name = $form_state->getValue('user_name');
   
    $address = $form_state->getValue('user_address');
     $this->tiffinWala->deliver( $auto,$name,$address); 
  }
}




