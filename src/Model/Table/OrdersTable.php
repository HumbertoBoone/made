<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Orders Model
 *
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\OrdersDetailsTable|\Cake\ORM\Association\HasMany $OrdersDetails
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('OrdersDetails', [
            'foreignKey' => 'order_id'
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
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('reference')
            ->maxLength('reference', 255)
            ->allowEmpty('reference');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 255)
            ->allowEmpty('payment_type');

        $validator
            ->scalar('recipient_name')
            ->maxLength('recipient_name', 255)
            ->allowEmpty('recipient_name');

        $validator
            ->scalar('address1')
            ->maxLength('address1', 255)
            ->allowEmpty('address1');

        $validator
            ->scalar('address2')
            ->maxLength('address2', 255)
            ->allowEmpty('address2');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 255)
            ->allowEmpty('postal_code');

        $validator
            ->scalar('state')
            ->maxLength('state', 255)
            ->allowEmpty('state');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmpty('city');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));

        return $rules;
    }
    public function getCustomerAddresses($customer_id)
    {
        $addresses = TableRegistry::get('Addresses');
        return $addresses->find()->where(['customer_id' => $customer_id])->toArray();
    }
    public function getCustomerAddress($address_id, $customer_id)
    {
        $addresses = TableRegistry::get('Addresses');
        return $addresses->find()->where(['id' => $address_id])->andWhere(['customer_id' => $customer_id])->first();
    }
}
