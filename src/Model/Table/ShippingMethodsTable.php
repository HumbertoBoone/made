<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ShippingMethods Model
 *
 * @property \App\Model\Table\CouponsTable|\Cake\ORM\Association\HasMany $Coupons
 *
 * @method \App\Model\Entity\ShippingMethod get($primaryKey, $options = [])
 * @method \App\Model\Entity\ShippingMethod newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ShippingMethod[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ShippingMethod|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShippingMethod patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ShippingMethod[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ShippingMethod findOrCreate($search, callable $callback = null, $options = [])
 */
class ShippingMethodsTable extends Table
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

        $this->setTable('shipping_methods');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Coupons', [
            'foreignKey' => 'shipping_method_id'
        ]);
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
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
