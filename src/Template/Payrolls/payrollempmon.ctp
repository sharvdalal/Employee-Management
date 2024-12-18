<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h3 class="text-center" style="font-family: Arial, sans-serif; font-weight: lighter; color: #333; margin-bottom: 20px; text-align: center;">
        <?= __('Employee Monthly Salary Report for ') .  $month . ' ' . $year ?>
    </h3>

    <select onchange="changeMonth()" name="month" id="month" style="padding: 8px 12px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; background-color: #f9f9f9; width: 200px;">
    <option value="" disabled selected style="font-style: italic; color: #999;">Select Month</option>
    <option value="January">January</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>
</select>


    <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; text-align: center;">
        <thead style="background-color: #f2f2f2; color: #333;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Employee</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Department</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Month Year</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Base Pay</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Bonus</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Deductions</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Net Salary</th>
            </tr>
        </thead>
        <tbody style="background-color: #ffffff;">
            <?php foreach ($query as $q): ?>
                <?php 
                    $totalSalary = $q['employee_base_salary'] +  $q['total_bonus'] - $q['total_deductions']; 
                ?>
                <tr style="border-bottom: 1px solid #ddd; background-color: #ffffff;">
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($q['employee_name']) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($q['employee_department']) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($month . ' ' . $year) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h(number_format($q['employee_base_salary']),2) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h(number_format($q['total_bonus']),2) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h(number_format($q['total_deductions']),2) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h(number_format($totalSalary),2) ?></b>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>

    function changeMonth(){

        let selectedMonth = document.getElementById('month').value;
        let path = window.location.pathname; 
        let parts = path.split('/');
        let year = parts[parts.length - 2];
        if (selectedMonth) {
            window.location.href = `/payrolls/payrollempmon/${year}/${selectedMonth}`;
        }


    }

</script>
