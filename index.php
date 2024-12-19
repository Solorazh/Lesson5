<?php
if(isset($argv[1]) && isset($argv[2])){
    getSchedule($argv[1],$argv[2]);
} else {
     getSchedule('','');
}
function getSchedule($year, $month){
    if($year != ''){
        $startDate = $year.'-'.$month.'-01';
    } else {
        $startDate = 'first day of this month midnight';
    }
    $dt = new DateTimeImmutable($startDate);
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    
    $workingDays = [];
    $wDayCnt = 0;
    for ($day = 0; $day < $daysInMonth; ++$day) {
        $d = $dt->add(new DateInterval('P' . $day . 'D'));
        $workingDays[$day]['date']= $d->format('Y-m-d');
        $workingDays[$day]['work'] = '';
      
        if ($wDayCnt % 3 === 0) {    
               
            if ($d->format('N') < 6) { 
                
                $workingDays[$day]['work']='+';  
                      
            } else { 
                $wDayCnt = 0;
                continue;
            }
        }
            
        ++$wDayCnt;
    }
    echo "date\t\twork" . PHP_EOL;
    foreach($workingDays as $day){    
        echo $day['date'] . "\t" . $day['work'];
        echo PHP_EOL;
    }   
}