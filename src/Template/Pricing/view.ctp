<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pricing'), ['action' => 'edit', $pricing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pricing'), ['action' => 'delete', $pricing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pricing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pricing'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pricing'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pricing view large-9 medium-8 columns content">
    <h3><?= h($pricing->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($pricing->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Info') ?></th>
            <td><?= h($pricing->info) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pricing->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $this->Number->format($pricing->active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seq') ?></th>
            <td><?= $this->Number->format($pricing->seq) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($pricing->price) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Blurb') ?></h4>
        <?= $this->Text->autoParagraph(h($pricing->blurb)); ?>
    </div>
</div>
