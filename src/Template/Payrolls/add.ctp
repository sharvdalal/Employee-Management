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
</div>


<

<?php if (isset($totPRE)): ?>
    <div id="payroll-summary">
    <div style="padding: 20px; max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <h3 style="margin-bottom: 20px; text-align: center; font-size: 20px; color: #333;">Payroll Data for Month and Year</h3>
    <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
        <span style="font-weight: bold; color: #555;">Employee Name:</span>
        <span style="color: #333;">[Value]</span>
    </div>
    <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
        <span style="font-weight: bold; color: #555;">Employee Department:</span>
        <span style="color: #333;">[Value]</span>
    </div>
    <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
        <span style="font-weight: bold; color: #555;">Employee Designation:</span>
        <span style="color: #333;">[Value]</span>
    </div>
    <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
        <span style="font-weight: bold; color: #555;">Employee Email:</span>
        <span style="color: #333;">[Value]</span>
    </div>
    <div style="margin-bottom: 10px; display: flex; justify-content: space-between;">
        <span style="font-weight: bold; color: #555;">Employee Mobile:</span>
        <span style="color: #333;">[Value]</span>
    </div>
</div>


    </div>
<?php endif; ?>














<script>

$('#payroll-form').on('submit', function() { 
        $('html, body').animate({
            scrollTop: $('#payroll-summary').offset().top
        }, 1000);
    });



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