<?php
   include_once 'database.php';
   date_default_timezone_set("Asia/Calcutta");
   $date = date("y-m-d"); //Today date
   $studentbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Birth_Date, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $fathersbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Father_Bdate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $mothersbday = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Mother_Bdate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $parentanii = mysqli_query($conn,"SELECT * FROM birthday where  DATE_FORMAT(Parrent_AniiDate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $staffbday = mysqli_query($conn,"SELECT * FROM staff where  DATE_FORMAT(Birthdate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list
   $staffanii = mysqli_query($conn,"SELECT * FROM staff where  DATE_FORMAT(staff_AniiDate, '%m-%d') = DATE_FORMAT('$date', '%m-%d')");//Select the birthday list

                   
    if(!empty($studentbday)){
                     foreach($studentbday as $studentrow)
                    {  
                        $data = array (
                                        'channelId' => '614b2eb14950f20004022c93',
                                          'channelType' => 'whatsapp',
                                          'recipient' => 
                                          array (
                                            'name' => $studentrow['First_Name']." ".$studentrow['Last_Name'],
                                            'phone' => '91'.$studentrow['Mobile_Number'],
                                          ),
                                          'whatsapp' => 
                                          array (
                                            'type' => 'template',
                                            'template' => 
                                            array (
                                              'templateName' => 'student_msg_bday',
                                              'bodyValues' => 
                                              array (
                                                'fname' => $studentrow['First_Name'],
                                              ),
                                            ),
                                          ),
                                        );
                        $data_string = json_encode($data);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>$data_string,
                            CURLOPT_HTTPHEADER => array(
                              'apiSecret: ',
                              'apiKey: ',
                              'Content-Type: application/json'
                            ),
                          ));
                          
                          $response1 = curl_exec($curl);
                          
                          curl_close($curl);

                    }       
                  }



                  if(!empty($fathersbday)){
                     foreach($fathersbday as $fathersbdayrow)
                    {  
                        $data = array (
                                        'channelId' => '614b2eb14950f20004022c93',
                                          'channelType' => 'whatsapp',
                                          'recipient' => 
                                          array (
                                            'name' => $fathersbdayrow['First_Name']." ".$fathersbdayrow['Last_Name'],
                                            'phone' => '91'.$fathersbdayrow['Mobile_Number'],
                                          ),
                                          'whatsapp' => 
                                          array (
                                            'type' => 'template',
                                            'template' => 
                                            array (
                                              'templateName' => 'father_msg_bday',
                                              'bodyValues' => 
                                              array (
                                                'sname' => $fathersbdayrow['Last_Name'],
                                              ),
                                            ),
                                          ),
                                        );
                        $data_string = json_encode($data);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>$data_string,
                            CURLOPT_HTTPHEADER => array(
                              'apiSecret: ',
                              'apiKey: 61b2e600733f200004ff85f1',
                              'Content-Type: application/json'
                            ),
                          ));
                          
                          $response2 = curl_exec($curl);
                          
                          curl_close($curl);

                    }       
                  }


                    if(!empty($mothersbday)){
                     foreach($mothersbday as $mothersbdayrow)
                    {  
                        $data = array (
                                        'channelId' => '614b2eb14950f20004022c93',
                                          'channelType' => 'whatsapp',
                                          'recipient' => 
                                          array (
                                            'name' => $mothersbdayrow['First_Name']." ".$mothersbdayrow['Last_Name'],
                                            'phone' => '91'.$mothersbdayrow['Mobile_Number'],
                                          ),
                                          'whatsapp' => 
                                          array (
                                            'type' => 'template',
                                            'template' => 
                                            array (
                                              'templateName' => 'mother_msg_bday',
                                              'bodyValues' => 
                                              array (
                                                'sname' => $mothersbdayrow['Last_Name'],
                                              ),
                                            ),
                                          ),
                                        );
                        $data_string = json_encode($data);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>$data_string,
                            CURLOPT_HTTPHEADER => array(
                              'apiSecret: ',
                              'apiKey: ',
                              'Content-Type: application/json'
                            ),
                          ));
                          
                          $response3 = curl_exec($curl);
                          
                          curl_close($curl);

                    }       
                  }


                  if(!empty($parentanii)){
                     foreach($parentanii as $parentaniirow)
                    {  
                        $data = array (
                                        'channelId' => '614b2eb14950f20004022c93',
                                          'channelType' => 'whatsapp',
                                          'recipient' => 
                                          array (
                                            'name' => $parentaniirow['First_Name']." ".$parentaniirow['Last_Name'],
                                            'phone' => '91'.$parentaniirow['Mobile_Number'],
                                          ),
                                          'whatsapp' => 
                                          array (
                                            'type' => 'template',
                                            'template' => 
                                            array (
                                              'templateName' => 'parent_anni_msg',
                                              'bodyValues' => 
                                              array (
                                                'sname' => $parentaniirow['Last_Name'],
                                              ),
                                            ),
                                          ),
                                        );
                        $data_string = json_encode($data);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>$data_string,
                            CURLOPT_HTTPHEADER => array(
                              'apiSecret: ',
                              'apiKey: ',
                              'Content-Type: application/json'
                            ),
                          ));
                          
                          $response4 = curl_exec($curl);
                          
                          curl_close($curl);

                    }       
                  }


                  if(!empty($staffbday)){
                     foreach($staffbday as $staffbdayrow)
                    {  
                        $data = array (
                                        'channelId' => '614b2eb14950f20004022c93',
                                          'channelType' => 'whatsapp',
                                          'recipient' => 
                                          array (
                                            'name' => $staffbdayrow['Staff_Name'],
                                            'phone' => '91'.$staffbdayrow['Phone_Number'],
                                          ),
                                          'whatsapp' => 
                                          array (
                                            'type' => 'template',
                                            'template' => 
                                            array (
                                              'templateName' => 'staff_bday',
                                              'bodyValues' => 
                                              array (
                                                'fullname' => $staffbdayrow['Staff_Name'],
                                              ),
                                            ),
                                          ),
                                        );
                        $data_string = json_encode($data);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>$data_string,
                            CURLOPT_HTTPHEADER => array(
                              'apiSecret: ',
                              'apiKey: ',
                              'Content-Type: application/json'
                            ),
                          ));
                          
                          $response5 = curl_exec($curl);
                          
                          curl_close($curl);

                    }       
                  }



                  if(!empty($staffanii)){
                     foreach($staffanii as $staffaniirow)
                    {  
                        $data = array (
                                        'channelId' => '614b2eb14950f20004022c93',
                                          'channelType' => 'whatsapp',
                                          'recipient' => 
                                          array (
                                            'name' => $staffaniirow['Staff_Name'],
                                            'phone' => '91'.$staffaniirow['Phone_Number'],
                                          ),
                                          'whatsapp' => 
                                          array (
                                            'type' => 'template',
                                            'template' => 
                                            array (
                                              'templateName' => 'staff_anni',
                                              'bodyValues' => 
                                              array (
                                                'fname' => $staffaniirow['Staff_Name'],
                                              ),
                                            ),
                                          ),
                                        );
                        $data_string = json_encode($data);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://server.gallabox.com/devapi/messages/whatsapp',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS =>$data_string,
                            CURLOPT_HTTPHEADER => array(
                              'apiSecret: ',
                              'apiKey: ',
                              'Content-Type: application/json'
                            ),
                          ));
                          
                          $response6 = curl_exec($curl);
                          
                          curl_close($curl);

                    }       
                  }
                        
                     ?>



