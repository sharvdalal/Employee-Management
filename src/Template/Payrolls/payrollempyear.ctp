<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <h3 class="text-center" style="font-family: Arial, sans-serif; font-weight: lighter; color: #333; margin-bottom: 20px; text-align: center;">
        <?= __('Employee Yearly Salary Report for ') . $year ?>
    </h3>

    <div style="text-align: center; background-color: #fff; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px;">
    <input placeholder="Enter Year" type="text" id="year" oninput="changeYear()" style="font-size: 16px; padding: 10px; margin-top: 10px; border: 1px solid #ccc; border-radius: 4px; width: 100%; max-width: 250px;"/>
  </div>


    <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; text-align: center;">
        <thead style="background-color: #f2f2f2; color: #333;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Employee</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Department</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Year</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Base Pay</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Bonus</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Deductions</th>
                <th style="border: 1px solid #ddd; padding: 8px; background-color: #e0e0e0;">Net Salary</th>
            </tr>
        </thead>
        <tbody style="background-color: #ffffff;">
            <?php foreach ($query as $q): ?>
                <?php 
                    $totalSalary = $q['total_base_salary'] +  $q['total_bonus'] - $q['total_deductions']; 
                ?>
                <tr style="border-bottom: 1px solid #ddd; background-color: #ffffff;">
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($q['employee_name']) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($q['department']) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h($year) ?></b>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">
                        <b><?= h(number_format($q['total_base_salary']),2) ?></b>
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
    function changeYear() {
      const yearInput = document.getElementById('year').value;
      const currentYear = new Date().getFullYear();
      const parsedYear = parseInt(yearInput, 10); 

      if (parsedYear >= 2000 && parsedYear <= currentYear) {
        window.location.href = `/payrolls/payrollempyear/${parsedYear}`;
      } 
    }
</script>