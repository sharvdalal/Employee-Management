<?php
$monthMap = [
    "01" => "January",
    "02" => "February",
    "03" => "March",
    "04" => "April",
    "05" => "May",
    "06" => "June",
    "07" => "July",
    "08" => "August",
    "09" => "September",
    "10" => "October",
    "11" => "November",
    "12" => "December",
];

function getWorkingDays($monthYear) {
    [$year, $month] = explode('-', $monthYear);
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $workingDays = 0;
    for ($day = 1; $day <= $totalDays; $day++) {     
        $dayOfWeek = date('w', strtotime("$year-$month-$day"));       
        if ($dayOfWeek != 0) {
            $workingDays++;
        }
    }
    return $workingDays;
}
 ?>

<div class="">
    <?php list($year, $month) = explode('-', $date); ?>
    <h3 class="text-center">
    <span style="font-weight: lighter;"><?= __('Attendance') ?></span>
    <span style="font-weight: bold;"><?= __(' ' . $monthMap[$month] . ' ' . $year) ?></span>
</h3>
    <h4 style="margin-left: 2rem;">Total Working Days: <?= getWorkingDays($date)?>  </h4>
    <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center; width: 0.75%">Id</th>
                <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center; width: 2%">Name</th>
                <?php
                
                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                for ($i = 1; $i <= $days; $i++) {
                    echo "<th scope='col' style='border: 1px solid #000; width: 0.5% '>" . str_pad($i, 2, '0', STR_PAD_LEFT) ."</th>";
                }
                ?>
              <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center;width: 0.55%">PRE</th>
              <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center; width: 0.55%">LEV</th>
              <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center; width: 0.55%">ABS</th>

            </tr>
        </thead>
        <tbody>

        <?php foreach ($attendances as $attendance): ?>
    <tr>
        <td style="border: 1px solid #000; padding: 5px; text-align: center;"><?= $this->Number->format($attendance['id']) ?></td>
        <td style="border: 1px solid #000; padding: 5px;"><?= h($attendance['name']) ?></td>

        <?php 
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $totPRE = 0;
        $totLEV = 0;
        $totABS = 0;
        for ($i = 1; $i <= $days; $i++) {

            $loopDate = $i < 10 ? "0" . $i : $i;
            $attendanceFound = false;

         
            foreach ($attendance['attendances'] as $data) {
               
                $attendanceDate = $data['date'];
                $dateStr = $attendanceDate->format('Y-m-d');
                $loopDateStr = $year . '-' . $month . '-' . $loopDate;
               

                if ($dateStr == $loopDateStr) {

                    $statusData = strtoupper(h($data['status'][0]));
                    if($statusData == 'P') $totPRE++;
                    else if($statusData == 'L') $totLEV++;
                    else $totABS++;

                    echo "<td style='border: 1px solid #000; width: 0.5%'>" .$statusData  . "</td>";
                    $attendanceFound = true;
                    break;
                }
            }
            $sunCheckDate = $loopDate . '-' . $month . '-' . $year;
            $dateTime = new DateTime($sunCheckDate);
            $isSunday =  $dateTime->format('w') == 0;
            if (!$attendanceFound) {
                if($isSunday){
                    echo "<td style='border: 1px solid #000; padding: 5px;'>H</td>";
                }
                else{
                    echo "<td style='border: 1px solid #000; padding: 5px;'></td>";
                }
                
            }
        }
        echo "<td style='border: 1px solid #000; '> <b>" .$totPRE ."</b></td>";
        echo "<td style='border: 1px solid #000; '><b>" .$totLEV ."</b></td>";
        echo "<td style='border: 1px solid #000; '><b>" .$totABS ."</b></td>";

        ?>
    </tr>
<?php endforeach; ?>

        </tbody>
    </table>

    <!-- <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div> -->
</div>