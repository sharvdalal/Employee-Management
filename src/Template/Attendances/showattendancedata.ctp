

<div class="">
    <?php list($year, $month) = explode('-', $date); ?>
    <h3 class="text-center"><?= __('Attendance ' . $year) ?></h3>
    <table cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center; width: 2%"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" style="border: 1px solid #000; padding: 5px; text-align: center; width: 14%"><?= $this->Paginator->sort('name') ?></th>
                <?php
                
                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                for ($i = 1; $i <= $days; $i++) {
                    echo "<th scope='col' style='border: 1px solid #000; padding: 5px; text-align: center;'>" . str_pad($i, 2, '0', STR_PAD_LEFT) . "-$month</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($attendances as $attendance): ?>
                <?php $datas = $attendance['id']?>
                <tr>
                    <td style="border: 1px solid #000; padding: 5px; text-align: center;"><?= $this->Number->format($attendance['id']) ?></td>
                    <td style="border: 1px solid #000; padding: 5px;"><?= h($attendance['name']) ?></td>

                    <?php foreach ($attendance['attendances'] as $status): ?>
                        <td style="border: 1px solid #000; padding: 5px;"><?= h(strtoupper($status['status'][0])) ?></td>
                    <?php endforeach; ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div> -->
</div>