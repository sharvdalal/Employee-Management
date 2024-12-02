<div class="attendances form large-9 medium-8 columns content">
    <div class="employees index large-9 medium-8 columns content">
        <h3><?= __('Attendance') . ' ' . $date ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>

                    <th scope="col" class="actions"><?= __('Status') ?></th>
                </tr>
            </thead>
            <tbody>
                   <?php foreach ($employees as $employee): ?>
                  <?php $attendanceStatus = isset($employee->attendances[0]->status) ? $employee->attendances[0]->status : ''; ?>

                    <tr>
                        <td><?= $this->Number->format($employee->id) ?></td>
                        <td><?= h($employee->name) ?></td>
                        <td class="actions">
                            <?= $this->Form->create($employee, ['id' => 'attendance-status-form-' . $employee->id]) ?>
                            <?= $this->Form->control('status[' . $employee->id . ']', [
                                'type' => 'select',
                                'options' => ['present' => 'Present', 'absent' => 'Absent', 'leave' => 'Leave'],
                                'label' => false,
                                'empty' => true,
                                'value' => $attendanceStatus,
                                'onChange' => 'document.getElementById("attendance-status-form-' . $employee->id . '").submit();'
                            ]); ?>
                            <?= $this->Form->end() ?>

                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>