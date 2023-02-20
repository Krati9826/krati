<?php

namespace Drupal\training\Form;
//ConfigFormBase:to create forms for configuration pages on your Drupal website.
use Drupal\Core\Form\ConfigFormBase;
//FormStateInterface:Provides an interface for an object containing the current state of a form.
use Drupal\Core\Form\FormStateInterface;
/**
 * Class TrainingConfigForm
 */
class TrainingConfigurationForm extends ConfigFormBase
{
    /**
     * {@inheritDoc}
     */
    //getEditableConfigNames(): Gets the configuration names that will be editable.
    protected function getEditableConfigNames()
    {
        return[
            'training.settings',
        ];
    }
    /**
     * {@inheritDoc}
     */
    //getFormId() : Returns a unique, machine-readable name for the form.
    public function getFormId()
    {
        
        return 'training_form_id';
    }
    /**
     * {@inheritDoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
       //The CurrentUser method returns a string that contains the name of the current user account
       //$current  =  $this->currentUser();
       
        $config = $this->config('training.settings');
        $form['student_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Student Name:'),
            '#maxlenght' => 30,
            '#size' => 35,
            '#default_value' => $config->get('student_name'), 
        ];
        $form['email'] = array(
            '#title' => t('Email Address'),
            '#type' => 'textfeild',
            '#size' => 45,
            '#required' => TRUE,
            '#description' => t('Registration Form'),
            '#default_value' => $config->get('email'),
        );
        $form['select_class'] = array (
            '#type' => 'select',
            '#title' => ('Select Class:'),
            '#options' => array(
              '1stClass' => t('First Class'),
              '2ndClass' => t('Second Class'),
              '3rdClass' => t('Third Class')
            ),
            '#default_value' => $config->get('select_class'),
        );
        $form['student_dob'] = array(
          '#type' => 'date',
          '#title' => t('Enter Your Date Of Birth'),
          '#required' => 'TRUE',
          '#default_value' => $config->get('student_dob'),
        );
        $form['terms'] = array(
            '#type' => 'checkbox',
            '#title' => t('I hereby,accept the terms and conditions'),
            '#default_value' => $config->get('terms'),
        );

        return parent::buildForm($form, $form_state);
    }
    /**
     * {@inheritDoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        
        $config = $this->config('training.settings');
        $config->set('student_name', $form_state->getValue('student_name'));
        $config->set('email', $form_state->getValue('email'));
        $config->set('select_class', $form_state->getValue('select_class'));
        $config->set('student_dob', $form_state->getValue('student_dob'));
        $config->set('terms', $form_state->getValue('terms'));
        $config->save();
            
    }
}
