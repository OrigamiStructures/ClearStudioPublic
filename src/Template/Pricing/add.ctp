<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pricing'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pricing form large-9 medium-8 columns content">
    <?= $this->Form->create($pricing) ?>
    <fieldset>
        <legend><?= __('Add Pricing') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('active');
            echo $this->Form->input('seq');
            echo $this->Form->input('info');
            echo $this->Form->input('blurb');
            echo $this->Form->input('price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
