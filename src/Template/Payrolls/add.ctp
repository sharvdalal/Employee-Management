<div class="payrolls form large-9 medium-8 columns content" style="    width: 100%;">
    <?= $this->Form->create(null, ['id' => 'payroll-form']) ?>
    <fieldset>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
            <div style="flex: 0 0 48%; ">
                <?= $this->Form->control('Department', [
                    'type' => 'select',
                    'options' => $departments,
                    'empty' => 'Select a Department',
                    'id' => 'department-select',
                    'onChange' => 'fetchEmployees()'
                ]); ?>
            </div>

            <div style="display: flex; align-items: center;  width: 48%;">
                <div style="width: 100%; max-width: 300px; flex-grow: 1; margin-right: 15px;">
                    <?= $this->Form->control('Employee Name', [
                        'type' => 'select',
                        'name' => 'employee_id',
                        'options' => '',
                        'id' => 'employees-select',
                        'style' => 'width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; font-size: 14px;'
                    ]); ?>
                </div>
                <div id="employee-spinner" style=" display: none; align-items: center;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size: 20px;"></i>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
            <div style="flex: 0 0 48%;">
                <?= $this->Form->control('month', [
                    'type' => 'select',
                    'empty' => 'Select Month',
                    'options' => [
                        '01' => 'January',
                        '02' => 'February',
                        '03' => 'March',
                        '04' => 'April',
                        '05' => 'May',
                        '06' => 'June',
                        '07' => 'July',
                        '08' => 'August',
                        '09' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December'
                    ]
                ]); ?>
            </div>
            <div style="flex: 0 0 48%;">
                <?= $this->Form->control('year'); ?>
            </div>

        </div>



        <?= $this->Form->control('first_form', ['type' => 'hidden', 'value' => 'first_form']) ?>
        <?= $this->Form->button(__('Submit')) ?>

    </fieldset>

    <?= $this->Form->end() ?>



    <?php if (isset($employeeData)): ?>
        <?php
        list($year, $monthNumber) = explode('-', $datetoFind);
        $month = DateTime::createFromFormat('!m', $monthNumber)->format('F');
        ?>
        <div id="second-form-div" style="height: 2px; background-color: #ddd;"></div>
        <div style="margin-top: 50px; font-family: 'Arial', sans-serif;">
            <h3 style="margin-bottom: 20px; text-align: center; font-size: 24px; font-weight: bold; color: #333;">
                Payroll Data for <?= $month ?> and <?= $year ?>
            </h3>
            <?php foreach ($employeeData as $employee): ?>
                <?php $employeeSalary = $employee["salary"] ?>
                <div id="payroll-summary">
                    <div style="padding: 20px; max-width: 600px; margin: 20px auto; background-color: #f9f9f9; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                        <input id="empId" type="hidden" value=<?= $employee["id"] ?> style="display: none;">
                        <input id="empDate" type="hidden" value=<?= $datetoFind ?> style="display: none;">
                        <input id="empSalary" type="hidden" value=<?= $employee["salary"] ?> style="display: none;">

                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Employee Name:</span>
                            <span style="color: #333;"> <b><?= h($employee["name"]) ?></b></span>
                        </div>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Employee Department:</span>
                            <span style="color: #333;"> <b><?= h($employee["department"]) ?></b></span>
                        </div>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Employee Designation:</span>
                            <span style="color: #333;"> <b><?= h($employee["designation"]) ?></b></span>
                        </div>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Employee Base Pay/Month:</span>
                            <span style="color: #333;"> <b><?= h($employee["salary"]) ?></b></span>
                        </div>

                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Total Working Days:</span>
                            <span style="color: #333;"> <b><?= h($totWorkingDays) ?></b></span>
                        </div>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Total Present:</span>
                            <span style="color: #333;"> <b><?= h($totPRE) ?></b></span>
                        </div>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Total Leaves:</span>
                            <span style="color: #333;"> <b><?= h($totLEV) ?></b></span>
                        </div>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                            <span style="font-weight: bold; color: #555;">Total Absent:</span>
                            <span style="color: #333;"> <b><?= h($totABS) ?></b></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?= $this->Form->create(null) ?>
            <fieldset id="adjustments-container">
            </fieldset>
            <input type="hidden" name="second_form" value="second_form">
            <input id="empId" name="employee_id" type="hidden" value=<?= $employee["id"] ?>>
            <input id="empDate" name="date" type="hidden" value=<?= $datetoFind ?>>
            <input id="employee-salary-hidden" type="hidden" name="base_salary" value="<?= $employee['salary']  ?>">
            <div class="text-center">
                <button type="button" id="add-adjustment" style="display: inline-block; margin: 10px 0; padding: 8px 16px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem;">+ Add Adjustment</button>
            </div>

            <?php
            $salary = (int) $employee["salary"];
            $perDaySalary = $salary  / $totWorkingDays;
            $absentCut =    round(((int)$totABS * $perDaySalary), 2);
            $finalSalary = round($salary - $absentCut, 2);
            ?>

            <div class="text-center" style="font-family: Arial, sans-serif; margin: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); max-width: 300px; margin: 20px auto;">
                <div style="display: flex; justify-content: space-between; font-size: 1.1rem; margin-bottom: 10px; align-items: center;">
                    <strong style="font-weight: bold; color: #333;">Net Pay Per Month:</strong>
                    <span style="font-weight: bold; color: #28a745; font-size: 1.25rem;"><?= h($employee["salary"]) ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; font-size: 1.1rem; margin-bottom: 10px; align-items: center;">
                    <p style="font-weight: bold; color: #333;">Absent Cut:</p>
                    <p id="absent-cut" style="color: #dc3545;"><b><?= $absentCut ?></b></p>
                </div>

                <div style="height: 1px; background-color: #ddd; margin: 10px 0;"></div>

                <div style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: bold; align-items: center;">
                    <strong style="font-weight: bold; color: #333;">Final Salary:</strong>
                    <span id="net-pay" style="font-size: 1.5rem; font-weight: bold; color: #007bff;"><?= h($finalSalary) ?></span>
                    <input id="net-pay-hidden" type="hidden" name="" value="<?= h($finalSalary) ?>">
                </div>
            </div>

            <?= $this->Form->button(__('Submit'), ['style' => 'background-color: #28a745; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px; cursor: pointer;']) ?>
            <?= $this->Form->end() ?>
        </div>
    <?php endif; ?>



</div>
















<script>
    window.onload = function() {

        document.getElementById('payroll-form').reset();
        document.getElementById('department-select').selectedIndex = 0;
        document.getElementById('employees-select').selectedIndex = 0;
        document.getElementById('employees-select').value = '';
        document.getElementById('month').selectedIndex = 0;
        document.getElementById('year').value = '';

        $('html, body').animate({
            scrollTop: $("#second-form-div").offset().top
        }, 1000);
    };



    function fetchEmployees() {
        $('#employee-spinner').css('display', 'flex');
        $('#employees-select').empty();
        var department = $('#department-select').val();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/payrolls/fetchEmployees', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        var data = 'department=' + department;
        xhr.onload = function() {
            if (xhr.status === 200) {
                $('#employee-spinner').css('display', 'none');
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        $('#employees-select').append(new Option("Select Employee", ""))
                        $.each(response.employees, function(key, value) {
                            $('#employees-select').append(new Option(value.name, value.id))
                        });
                    } else {
                        console.error('No message in response');
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    console.error('Response:', xhr.responseText);
                }
            } else {
                console.error('Unexpected error with status:', xhr.status);
            }
        };

        xhr.send(data);
    }
</script>


<script>
    let baseSalary = Number(document.getElementById('net-pay-hidden').value);

    function updateNetPay() {
        let netPay = baseSalary;

        const adjustments = document.querySelectorAll('.adjustment');
        adjustments.forEach((adjustment, index) => {
            const type = adjustment.querySelector('[name^="payroll_adjustments[' + index + '][type]"]').value;
            const amount = parseFloat(adjustment.querySelector('[name^="payroll_adjustments[' + index + '][amount]"]').value) || 0;


            if (type === 'Bonus') {
                netPay += amount;
            } else if (type === 'Deductions') {
                netPay -= amount;
            }
        });


        document.getElementById('net-pay').innerText = netPay;

    }


    document.getElementById('add-adjustment').addEventListener('click', function() {
        const container = document.getElementById('adjustments-container');
        const index = container.children.length;
        const adjustmentTemplate = `
                <div class="adjustment" style="margin-bottom: 15px; padding: 15px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: space-between;">
    <select name="payroll_adjustments[${index}][type]" onChange="updateNetPay()" style="padding: 8px; font-size: 1rem; border-radius: 4px; border: 1px solid #ccc; width: 120px;">
        <option value="Bonus">Bonus</option>
        <option value="Deductions">Deductions</option>
    </select>
    
    <input type="text" name="payroll_adjustments[${index}][name]" placeholder="Adjustment Name" style="padding: 8px 12px; font-size: 1rem; border-radius: 4px; border: 1px solid #ccc; width: 180px; margin: 0 10px;">
    
    <input type="number" name="payroll_adjustments[${index}][amount]" placeholder="Amount" step="0.01" onInput="updateNetPay()" style="padding: 8px 12px; font-size: 1rem; border-radius: 4px; border: 1px solid #ccc; width: 150px;">
    
    <button type="button" class="remove-adjustment" style="background-color: #dc3545; color: #fff; padding: 8px 12px; font-size: 1rem; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
        Remove
    </button>
</div>

            `;
        container.insertAdjacentHTML('beforeend', adjustmentTemplate);
    });


    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-adjustment')) {
            e.target.parentElement.remove();
            updateNetPay();
        }
    });
</script>