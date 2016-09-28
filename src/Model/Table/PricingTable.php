<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pricing Model
 *
 * @method \App\Model\Entity\Pricing get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pricing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pricing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pricing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pricing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pricing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pricing findOrCreate($search, callable $callback = null)
 */
class PricingTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('pricing');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->integer('active')
            ->allowEmpty('active');

        $validator
            ->integer('seq')
            ->allowEmpty('seq');

        $validator
            ->allowEmpty('info');

        $validator
            ->allowEmpty('blurb');

        $validator
            ->numeric('price')
            ->allowEmpty('price');

        return $validator;
    }
}
