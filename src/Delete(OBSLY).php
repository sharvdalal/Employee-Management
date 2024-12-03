<div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
    <div style="flex: 0 0 48%;">
    <?= $this->Form->control('', [
            'type' => 'select',
            'options' => $departments,
            'empty' => 'Select a Department',
            'id' => 'department-select',
            'onChange' => 'fetchEmployees()'
        ]); ?>
    </div> 
    <div style="flex: 0 0 48%;">
        <?= $this->Form->control('Employee Name', [
            'type' => 'select',
            'empty' => 'Select Employee',
            'options' => '',
            'id' => 'employees-select'
        ]);?>
    </div>
</div>

<div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
    <div style="flex: 0 0 48%;">
        <?= $this->Form->control('month', [
            'type' => 'select',
            'empty' => 'Select Month',
            'options' => [
                'January' => 'January',
                'February' => 'February',
                'March' => 'March',
                'April' => 'April',
                'May' => 'May',
                'June' => 'June',
                'July' => 'July',
                'August' => 'August',
                'September' => 'September',
                'October' => 'October',
                'November' => 'November',
                'December' => 'December'
            ]
            ]);  ?>
    </div>
    <div style="flex: 0 0 48%;">
        <?= $this->Form->control('Year'); ?>
    </div>
</div>