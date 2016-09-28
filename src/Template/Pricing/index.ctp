<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pricing'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pricing index large-9 medium-8 columns content">
    <h3><?= __('Pricing') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seq') ?></th>
                <th scope="col"><?= $this->Paginator->sort('info') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pricing as $pricing): ?>
            <tr>
                <td><?= $this->Number->format($pricing->id) ?></td>
                <td><?= h($pricing->name) ?></td>
                <td><?= $this->Number->format($pricing->active) ?></td>
                <td><?= $this->Number->format($pricing->seq) ?></td>
                <td><?= h($pricing->info) ?></td>
                <td><?= $this->Number->format($pricing->price) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pricing->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pricing->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pricing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pricing->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
