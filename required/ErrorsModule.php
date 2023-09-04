<?php

  class pout{

    public function developerModeChiker() {
     global $db;
        $query = "SELECT meta_field , meta_value FROM system_info WHERE meta_field='developerMode'";
        $result = mysqli_query($db, $query);
        $status = mysqli_fetch_assoc($result);
        $developerMode=$status['meta_value'];
        return  $developerMode; 
  }
 
      public function yellow($data){
         global $developerMode;
         $developerMode = pout::developerModeChiker();

          $style = 'style="background-color:yellow;
                    width: 100%;
                    padding:1%;
                    margin:1%;
                    font-size: 95%;
                    font-family: "verdana";"';
    // text-transform: uppercase;
         if ($developerMode ==1 ) {
              $type = gettype($data);
                  if ($type == 'array') {
                   
                    echo '<div '.$style.'>
                           <pre>';

                   print_r($data);
                 
                   echo '
                         </pre>
                    </div>
                         ';


                  }elseif ($type == 'string') {
                     echo '<div '.$style.'>
                          '.$data.'
                        </div>
                         ';
                  }
         }
     
    }

      public function pink($data){
         global $developerMode;
         $developerMode = pout::developerModeChiker();

          $style = 'style="background-color:#FF75F5;
                    width: 100%;
                    padding:1%;
                    margin:1%;
                    font-size: 95%;
                    font-family: "verdana";"';

         if ($developerMode ==1 ) {
              $type = gettype($data);
                  if ($type == 'array') {
                   
                    echo '<div '.$style.'>
                           <pre>';

                   print_r($data);
                 
                   echo '
                         </pre>
                    </div>
                         ';


                  }elseif ($type == 'string') {
                     echo '<div '.$style.'>
                          '.$data.'
                        </div>
                         ';
                  }
         }
     
    }

    public function gray($data){
         global $developerMode;
         $developerMode = pout::developerModeChiker();

          $style = 'style="background-color:#BEBEBE;
                    width: 100%;
                    padding:1%;
                    margin:1%;
                    font-size: 95%;
                    font-family: "verdana";"';

         if ($developerMode ==1 ) {
              $type = gettype($data);
                  if ($type == 'array') {
                   
                    echo '<div '.$style.'>
                           <pre>';

                   print_r($data);
                 
                   echo '
                         </pre>
                    </div>
                         ';


                  }elseif ($type == 'string') {
                     echo '<div '.$style.'>
                          '.$data.'
                        </div>
                         ';
                  }
         }
     
    }

        public function aqua($data){
         global $developerMode;
         $developerMode = pout::developerModeChiker();

          $style = 'style="background-color:#00FFFF;
                    width: 100%;
                    padding:1%;
                    margin:1%;
                    font-size: 95%;
                    font-family: "verdana";"';

         if ($developerMode ==1 ) {
              $type = gettype($data);
                  if ($type == 'array') {
                   
                    echo '<div '.$style.'>
                           <pre>';

                   print_r($data);
                 
                   echo '
                         </pre>
                    </div>
                         ';


                  }elseif ($type == 'string') {
                     echo '<div '.$style.'>
                          '.$data.'
                        </div>
                         ';
                  }
         }
     
    }


       public function green($data){
         global $developerMode;
         $developerMode = pout::developerModeChiker();

          $style = 'style="background-color:#7FFF00;
                    width: 100%;
                    padding:1%;
                    margin:1%;
                    font-size: 95%;
                    font-family: "verdana";"';

         if ($developerMode ==1 ) {
              $type = gettype($data);
                  if ($type == 'array') {
                   
                    echo '<div '.$style.'>
                           <pre>';

                   print_r($data);
                 
                   echo '
                         </pre>
                    </div>
                         ';


                  }elseif ($type == 'string') {
                     echo '<div '.$style.'>
                          '.$data.'
                        </div>
                         ';
                  }
         }
     
    }

   public function black($data){
         global $developerMode;
         $developerMode = pout::developerModeChiker();

          $style = 'style="background-color:black;
                    width: 100%;
                    padding:1%;
                    margin:1%;
                    font-size: 95%;
                    color:white;
                    font-family: "verdana";"';

         if ($developerMode ==1 ) {
              $type = gettype($data);
                  if ($type == 'array') {
                   
                    echo '<div '.$style.'>
                           <pre>';

                   print_r($data);
                 
                   echo '
                         </pre>
                    </div>
                         ';


                  }elseif ($type == 'string') {
                     echo '<div '.$style.'>
                          '.$data.'
                        </div>
                         ';
                  }
         }
     
    }

 


}
  

?>