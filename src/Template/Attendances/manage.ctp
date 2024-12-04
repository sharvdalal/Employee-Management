<div class="text-center">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Attendances', 'action' => 'manage'], 'id' => 'date-from']) ?>
    <?= $this->Form->control('attendance', [
        'type' => 'date',
        'label' => 'Choose Date',
        'id' => 'attendance_date'
    ]) ?>
    <?= $this->Form->button('Submit', ['onClick' => 'dateSubmit()']) ?>
    <?= $this->Form->end() ?>
</div>


<?php if (isset($employees)): ?>
    <div class="attendances form large-9 medium-8 columns content">
        <div class="employees index large-9 medium-8 columns content">
            <h3><?= __('Attendance') . ' ' ?></h3>
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col" class="actions"><?= __('Status') ?></th>
                        <th scope="col" class="actions"><?= __('') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <?php $attendanceStatus = isset($employee->attendances[0]->status) ? $employee->attendances[0]->status : null; ?>

                        <tr>
                            <td><?= $this->Number->format($employee->id) ?></td>
                            <td><?= h($employee->name) ?></td>
                            <td class="actions">
                                <?= $this->Form->create($employee, [
                                    'id' => 'attendance-status-form-' . $employee->id,
                                    'url' => ['controller' => 'Attendances', 'action' => 'addData'],
                                    'type' => 'ajax'
                                ]) ?>
                                <?= $this->Form->control('status[' . $employee->id . ']', [
                                    'type' => 'select',
                                    'options' => ['present' => 'Present', 'absent' => 'Absent', 'leave' => 'Leave'],
                                    'label' => false,
                                    'empty' => true,
                                    'value' => $attendanceStatus,
                                    // 'onChange' => 'document.getElementById("attendance-status-form-' . $employee->id . '").submit();'
                                    'onChange' => 'updateStatus(this, ' . $employee->id . ', ' .  $date . ')'
                                ]); ?>
                                <?= $this->Form->end() ?>

                            </td>
                            <td id="icon-id-<?= $employee->id ?>">
                                <?php if ($attendanceStatus): ?>
                                    <i class="fa-solid fa-check" style="color: #ffde05; font-size: 24px;"></i>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
           
        </div>
    </div>
<?php endif; ?>


<script>
    function updateStatus(selectElement, employeeId, date) {

        $('#icon-id-' + employeeId).html('<i class="fa-solid fa-spinner fa-spin" style="color: #e9ca07; font-size: 24px;"></i>');

        var status = selectElement.value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/attendances/addData', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        var data = 'status=' + status + '&employee_id=' + employeeId + '&date=' + date.toString();
        xhr.onload = function() {
            if (xhr.status === 200 || xhr.status === 500) { 
                try {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response.message); 

                    if (xhr.status === 200) {
                        $('#icon-id-' + employeeId).html('<i class="fa-solid fa-check" style="color: #28f000; font-size: 24px;"></i>');
                    } else {
                        $('#icon-id-' + employeeId).html('<i class="fa-solid fa-xmark" style="color: #f50000; font-size: 24px;"></i>');
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    console.error('Response:', xhr.responseText);
                }
            } else {
                console.error('Unexpected error with status:', xhr.status);
                $('#icon-id-' + employeeId).html('<i class="fa-solid fa-question" style="color: #f5a000; font-size: 24px;"></i>');
            }
        };
        xhr.send(data);


    }
</script>