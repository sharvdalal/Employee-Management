<?php
$Dept_Array = ['Leadership', 'HR', 'Marketing', 'Sales', 'Finance', 'Support', 'IT', 'R&D', 'Operations', 'Legal'];
$months_Array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
?>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h3 class="text-center" style="font-family: Arial, sans-serif; font-weight: lighter; color: #333; margin-bottom: 20px;">
        <span><?= __('Department Monthly Salary Report for ') . $year ?></span>
    </h3>

    <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; text-align: center;">
        <thead style="background-color: #f2f2f2; color: #333;">
            <tr>
                <th class="text-center" scope="col" style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Department</th>
                <th class="text-center" scope="col" style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Month</th>
                <th class="text-center" scope="col" style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Base Pay</th>
                <th class="text-center" scope="col" style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Bonus</th>
                <th class="text-center" scope="col" style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Deductions</th>
                <th class="text-center" scope="col" style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Net Payment</th>
            </tr>
        </thead>
        <tbody style="background-color: #ffffff;">
            <?php foreach ($Dept_Array as $dept): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td class="text-center" style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($dept) ?></b>
                    </td>
                    <td class="text-center" style="border: 1px solid #ddd; padding: 8px;">
                        <b> <?= h($month) ?></b>
                    </td>

                    <?php
                    $baseSalary = 0;
                    $bonus = 0;
                    $deductions = 0;

                    foreach ($query as $q) {
                        if ($q["department"] == $dept) {
                            $baseSalary = $q["total_base_salary"];
                            $bonus = $q["total_bonus"];
                            $deductions = $q["total_deductions"];
                            break;
                        }
                    }
                    $netPayment = $baseSalary + $bonus - $deductions;
                    echo "<td class='text-center' style='border: 1px solid #ddd; padding: 8px;'>
                            <b>" . number_format($baseSalary, 2) . "</b>
                          </td>";
                    echo "<td class='text-center' style='border: 1px solid #ddd; padding: 8px;'>
                            <b>" . number_format($bonus, 2) . "</b>
                          </td>";
                    echo "<td class='text-center' style='border: 1px solid #ddd; padding: 8px;'>
                            <b>" . number_format($deductions, 2) . "</b>
                          </td>";
                    echo "<td class='text-center' style='border: 1px solid #ddd; padding: 8px;'>
                            <b>" . number_format($netPayment, 2) . "</b>
                          </td>";
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
