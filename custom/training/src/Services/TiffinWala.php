<?php

namespace Drupal\training\Services;
use Drupal\Core\Messenger\MessengerInterface;

class TiffinWala {
   
      protected $messenger;

        function __construct(MessengerInterface $messenger)
        {
            $this->messenger = $messenger;
        }

        function deliver( $auto,$name,$address) 
        {
          $message = $this->messenger->addMessage($name." Thankyou for your order will be deliver at your location ".$address." within 10 minutes !");
        }

    }


?>