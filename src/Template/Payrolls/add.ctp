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




        <?= $this->Form->button(__('Submit')) ?>

    </fieldset>

    <?= $this->Form->end() ?>





    <?php if (isset($employeeData)): ?>
        <div style="height: max-content;">
            <?php $employeeSalary = 0; ?>
            <?php
            list($year, $monthNumber) = explode('-', $datetoFind);
            $month = DateTime::createFromFormat('!m', $monthNumber)->format('F');
            ?>

            <?php foreach ($employeeData as $employee): ?>
                <?php $employeeSalary = $employee["salary"] ?>
                <div id="payroll-summary">
                    <div style="padding: 20px; max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <h3 style="margin-bottom: 20px; text-align: center; font-size: 20px; color: #333;">
                            <b>Payroll Data for <?= $month ?> and <?= $year ?></b>
                        </h3>
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
        </div>

        <div style="text-align: center; padding: 15px; margin: 20px auto; max-width: 600px; background-color: #f1f1f1; border: 2px solid #007bff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
            <h3 style="margin: 0; font-size: 24px; color: #007bff; font-weight: bold;">
                <input id="employee-salary-display" type="hidden" name="" value=" <?= $employeeSalary ?>">
                Final Net Pay for October 2024: <span id="net-pay-value" style="color: #28a745;"> <?= $employeeSalary ?></span>
            </h3>
        </div>



        <div id="adjustments-container" style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
            <h4 style="text-align: center; font-size: 18px; color: #333; ">Adjustments</h4>
            <div id="adjustment-fields">

            </div>
            <button onclick="addAdjustments()" id="add-adjustment" type="button" style="display: block; margin: 10px auto; padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
                + Add Adjustment
            </button>
        </div>

        <button
            id="submit-adjustments"
            onclick="submitAdjustments(); this.style.backgroundColor='#0056b3'; this.style.transform='scale(0.98)';"
            onmouseover="this.style.backgroundColor='#0056b3'; this.style.cursor='pointer';"
            onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';"
            type="button"
            style="display: block; margin: 20px auto; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.2s ease, transform 0.2s ease;">
            Submit Adjustments
        </button>
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
        // var date = 
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


    function addAdjustments() {
        const container = document.getElementById('adjustment-fields');
        const rowId = `adjustment-${Date.now()}`;
        const adjustmentRow = `
            <div id="${rowId}" style="margin-bottom: 15px; display: flex; gap: 10px;">
                <select id = "select select-${rowId}" style="flex: 1; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="" selected>Adjustment Type</option>
                    <option value="Bonus">Bonus</option>
                    <option value="Deductions">Deductions</option>
                </select>
                <input id="desc desc-${rowId}"   type="text" placeholder="Description" style="flex: 2; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                <input id="amount amount-${rowId}"  type="number" placeholder="Amount" style="flex: 1; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="button" onclick="applyAdjustment('${rowId}')" style="padding: 5px 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                <button type="button" onclick="removeAdjustment('${rowId}')" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">X</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', adjustmentRow);
    };

    function applyAdjustment(rowId) {
        let adjustDiv = document.getElementById(rowId);


        const select = adjustDiv.querySelector('select');


        const inputs = adjustDiv.querySelectorAll('input');


        const type = select ? select.value : null;
        const amount = inputs.length > 1 ? inputs[1].value : '';

        if (!type || isNaN(amount) || amount <= 0) {
            alert("Please select a valid type and enter a positive amount.");
            return;
        }
        console.log(amount + " " + type);
        updateNetPay(amount, type);

        if (select) {
            select.disabled = true;
        }

        inputs.forEach(input => {
            input.disabled = true;
        });



    }

    function removeAdjustment(rowId) {
        const select = document.getElementById(`select-${rowId}`);
        const amountInput = document.getElementById(`amount-${rowId}`);
        const type = select.value;
        const amount = parseFloat(amountInput.value);

        if (type && !isNaN(amount) && amount > 0) {

            updateNetPay(amount, type === "Bonus" ? "Deductions" : "Bonus");
        }


        const row = document.getElementById(rowId);
        if (row) row.remove();
    }
    let finalNetPay = document.querySelector("#employee-salary-display").value;
    let finalNetPayNum = Number(finalNetPay);
    const netPayElement = document.querySelector("#net-pay-value");

    function updateNetPay(amount, type) {
        amount = Number(amount);
        if (type === "Bonus") {
            finalNetPayNum += amount;
        } else if (type === "Deductions") {
            finalNetPayNum -= amount;
        }
        console.log(finalNetPayNum);

        netPayElement.textContent = finalNetPayNum + "/-";
    }

    function submitAdjustments() {
        const adjustments = [];
        $('#adjustment-fields > div').each(function() {
            const row = $(this);
            const select = row.find('select');
            const inputs = row.find('input');
            const type = select.length ? select.val() : null;
            const description = inputs.eq(0).val() || '';
            const amount = inputs.eq(1).val() || '';

            if (type && description && amount) {
                adjustments.push({
                    type: type,
                    description: description,
                    amount: parseFloat(amount),
                });
            }
        });

        console.log(adjustments);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/payrolls/calculateSalary', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        var adjustmentsJson = JSON.stringify(adjustments);
        var id = $('#empId').val();
        var date = $('#empDate').val();
        var salary = $('#empSalary').val();

        var data = 'adjustments=' + encodeURIComponent(adjustmentsJson) + '&date=' + encodeURIComponent(date) + '&salary=' + encodeURIComponent(salary) + '&id=' + encodeURIComponent(id);

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                    window.location.href = `/payrolls/view/${response.employeeId}/${response.payrollId}`;

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