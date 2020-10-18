<?php
    //Ovaj dio je zasluzan za require svih biblioteka tj vaznih stvari kao sto su core (rutiranje) controller i baza podataka
    //kao i helperi tj session helper u kome zapocinjemo session_start radi cuvanja session podataka nakon loginovanja user-a 
    //takodje odje se skladisti i config a glavna stvar je da se instacira klasa Core koja sluzi za rutiranje sad idemo na config.php

    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';

    require_once 'helpers/session_helper.php';

    require_once 'config/config.php';

    //Instanciranje klase Core
    $init = new Core();    
    
  
    //print_r("<b>Controller:</b> " );var_dump($init->getController());
    //print_r('<b>Action:</b> ' .$init->getMethod());




