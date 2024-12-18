<?php 
$data = $payrollData[0]; 
list($year, $month) = explode('-', $date);
$monthName = DateTime::createFromFormat('!m', $month)->format('F');
?>
<div class="text-center" style="margin-top: 50px;">
    <h2 style="color: #333; font-size: 24px; font-weight: 600;">Payroll Details For: </strong> <?= h($year) ?> <?= h($monthName) ?></h2>
</div>
<div style="max-width: 1200px; margin: 0 auto; padding: 30px; background-color: #f4f7fc;">
    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Payroll :</strong> <?= h($year) ?> <?= h($monthName) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Employee Name:</strong> <?= h($employeeData[0]["name"]) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Employee Email:</strong> <?= h($employeeData[0]["email"]) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Employee Department:</strong> <?= h($employeeData[0]["department"]) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Employee Designation:</strong> <?= h($employeeData[0]["designation"]) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Employee Base Pay/Month:</strong> <?= h($data["base_salary"]) ?></p>
    </div>

    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h4 style="color: #333; font-size: 20px; font-weight: 600; border-bottom: 2px solid #ececec; padding-bottom: 10px; margin-bottom: 20px;">Attendance Summary</h4>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Total Working Days:</strong> <?= h($totWorkingDays) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Total Present:</strong> <?= h($totPRE) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Total Leaves:</strong> <?= h($totLEV) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Total Absent:</strong> <?= h($totABS) ?></p>
    </div>

    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h4 style="color: #333; font-size: 20px; font-weight: 600; border-bottom: 2px solid #ececec; padding-bottom: 10px; margin-bottom: 20px;">Payroll Adjustments</h4>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 10px; background-color: #f4f7fc; color: #333; text-align: left;">Type</th>
                    <th style="border: 1px solid #ddd; padding: 10px; background-color: #f4f7fc; color: #333; text-align: left;">Description</th>
                    <th style="border: 1px solid #ddd; padding: 10px; background-color: #f4f7fc; color: #333; text-align: left;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payrollData[0]["payroll_adjustments"] as $adjustment): ?>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px; color: #555;"><?= h($adjustment["type"]) ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px; color: #555;"><?= h($adjustment["name"]) ?></td>
                        <td style="border: 1px solid #ddd; padding: 10px; color: #555;"><?= h($adjustment["amount"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 20px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h4 style="color: #333; font-size: 20px; font-weight: 600; border-bottom: 2px solid #ececec; padding-bottom: 10px; margin-bottom: 20px;">Final Payroll Calculation</h4>
        <?php
            $basePay = $data["base_salary"];
            $perDayPay = $basePay / $totWorkingDays;
            $absentCut = $perDayPay * $totABS;
            $adjustmentsTotal = 0;
            $bonus = 0;
            $deductions = 0;

            foreach ($payrollData[0]["payroll_adjustments"] as $adjustment) {
                if ($adjustment["type"] === "Bonus") {
                    $bonus += $adjustment["amount"];
                } elseif ($adjustment["type"] === "Deductions") {
                    $deductions += $adjustment["amount"];
                }
            }

            $finalPay = $basePay - $absentCut + $bonus - $deductions;
        ?>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>Base Pay Salary:</strong> <?= h($basePay) ?></p>
        <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>- Absent Cut:</strong> -<?= h(number_format($absentCut, 2)) ?></p>

        <?php if ($bonus > 0): ?>
            <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>+ Bonus:</strong> +<?= h(number_format($bonus, 2)) ?></p>
        <?php endif; ?>
        <?php if ($deductions > 0): ?>
            <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 10px 0;"><strong>- Deductions:</strong> -<?= h(number_format($deductions, 2)) ?></p>
        <?php endif; ?>

        <hr style="border: 0; height: 1px; background: #ddd; margin: 20px 0;">
        <p style="color: #333; font-size: 18px; font-weight: 600; margin-top: 20px;"><strong>Final Pay:</strong> <?= h(number_format($finalPay, 2)) ?></p>
    </div>
</div>
