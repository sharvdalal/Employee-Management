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

        <div id="second-form-div">
            <h3 style="margin-bottom: 20px; text-align: center; font-size: 20px; color: #333;">
                <b>Payroll Data for <?= $month ?> and <?= $year ?></b>
            </h3>
            <?php foreach ($employeeData as $employee): ?>
                <?php $employeeSalary = $employee["salary"] ?>
                <div id="payroll-summary">
                    <div style="padding: 20px; max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <input id="empId" type="hidden" value=<?= $employee["id"] ?> style="display: none;">
                        <input id="empDate" type="hidden" value=<?= $datetoFind ?> style="display: none;">
                        <input id="empSalary" type="hidden" value=<?= $employee["salary"] ?> style="display: none;">


                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Employee Name:</span>
                            <span style="color: #333;"> <b><?= h($employee["name"]) ?></b></span>
                        </div>
                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Employee Department:</span>
                            <span style="color: #333;"> <b><?= h($employee["department"]) ?></b></span>
                        </div>
                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Employee Designation:</span>
                            <span style="color: #333;"> <b><?= h($employee["designation"]) ?></b></span>
                        </div>

                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Employee Base Pay/Month:</span>
                            <span style="color: #333;"> <b><?= h($employee["salary"]) ?></b></span>
                        </div>

                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Total Working Days:</span>
                            <span style="color: #333;"> <b><?= h($totWorkingDays) ?></b></span>
                        </div>
                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Total Present:</span>
                            <span style="color: #333;"> <b><?= h($totPRE) ?></b></span>
                        </div>
                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Total Leaves:</span>
                            <span style="color: #333;"> <b><?= h($totLEV) ?></b></span>
                        </div>
                        <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <span style="font-weight: bold; color: #555;">Total Absent:</span>
                            <span style="color: #333;"> <b><?= h($totABS) ?></b></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center">
                <strong>Final Net Pay: <span id="net-pay"><?= h($employee["salary"]) ?></span></strong>
            </div>

    <?= $this->Form->create(null) ?>
    <fieldset id="adjustments-container">
        <div class="adjustment">
            <?= $this->Form->control('payroll_adjustments.0.type', [
                'type' => 'select',
                'options' => ['Bonus' => 'Bonus', 'Deductions' => 'Deductions'],
                'label' => 'Type',
                'onChange' => 'updateNetPay()',
            ]); ?>
            <?= $this->Form->control('payroll_adjustments.0.name', [
                'type' => 'text',
                'label' => 'Adjustment Name',
            ]); ?>
            <?= $this->Form->control('payroll_adjustments.0.amount', [
                'type' => 'number',
                'label' => 'Amount',
                'step' => '0.01',
                'onInput' => 'updateNetPay()',
            ]); ?>
            <button type="button" class="remove-adjustment">Remove</button>
        </div>
    </fieldset>
    <input type="hidden" name="second_form" value="second_form">
    <input id="empId" name="employee_id" type="hidden" value=<?= $employee["id"] ?>>
    <input id="empDate" name="date" type="hidden" value=<?= $datetoFind ?>>
    <input id="employee-salary-hidden" type="hidden" name="base_salary" value="<?=$employee["salary"]   ?>">
    <button type="button" id="add-adjustment">+ Add Adjustment</button>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
        </div>
    <?php endif; ?>








</div>
















<script>
    // $('#payroll-form').on('submit', function() { 
    //         $('html, body').animate({
    //             scrollTop: $('#payroll-summary').offset().top
    //         }, 1000);
    //     });



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
        let baseSalary = Number(document.getElementById('employee-salary-hidden').value); 
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


        document.getElementById('add-adjustment').addEventListener('click', function () {
            const container = document.getElementById('adjustments-container');
            const index = container.children.length;
            const adjustmentTemplate = `
                <div class="adjustment">
                    <select name="payroll_adjustments[${index}][type]" onChange="updateNetPay()">
                        <option value="Bonus">Bonus</option>
                        <option value="Deductions">Deductions</option>
                    </select>
                    <input type="text" name="payroll_adjustments[${index}][name]" placeholder="Adjustment Name">
                    <input type="number" name="payroll_adjustments[${index}][amount]" placeholder="Amount" step="0.01" onInput="updateNetPay()">
                    <button type="button" class="remove-adjustment">Remove</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', adjustmentTemplate);
        });


        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-adjustment')) {
                e.target.parentElement.remove();
                updateNetPay();  
            }
        });

        updateNetPay();
    </script>