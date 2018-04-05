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

        $validator
            ->scalar('shipping_method')
            ->maxLength('shipping_method', 255)
            ->allowEmpty('shipping_method');

        $validator
            ->decimal('shipping_price')
            ->allowEmpty('shipping_price');

        $validator
            ->decimal('customer_discount')
            ->allowEmpty('customer_discount');

        $validator
            ->decimal('total_discount')
            ->allowEmpty('total_discount');

        $validator
            ->scalar('coupon_code')
            ->maxLength('coupon_code', 45)
            ->allowEmpty('coupon_code');

        $validator
            ->dateTime('coupon_created')
            ->allowEmpty('coupon_created');

        $validator
            ->scalar('coupon_type')
            ->maxLength('coupon_type', 45)
            ->allowEmpty('coupon_type');

        $validator
            ->allowEmpty('coupon_sigle_use');

        $validator
            ->decimal('coupon_value')
            ->allowEmpty('coupon_value');

        $validator
            ->dateTime('coupon_expiration_date')
            ->allowEmpty('coupon_expiration_date');

        $validator
            ->decimal('grand_total')
            ->requirePresence('grand_total', 'create')
            ->notEmpty('grand_total');

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
    public function getCustomerMainAdress($customer_id)
    {
        return TableRegistry::get('Customers')->find()
            ->select(['first_name', 'last_name','address1', 'address2', 'city', 'state', 'postal_code'])
            ->where(['id' => $customer_id])->first();
    }
    public function saveOrder($items, $shipping, $reference)
    {
        $session = $this->request->session();
        $auth_user = $session->read('Auth.User');
        $customer = $this->Orders->Customers->get($session->read('Auth.User.customer_id'));
        $orders = TableRegistry::get('Orders');
        $order = $orders->newEntity();

        $order->customer_id = $customer->customer_id;
        $order->reference = $reference;
        $order->payment_type = "";
        $order->recipient_name = $shipping['recipient_name'];
        $order->address1 = $shipping['address1'];
        $order->address2 = $shipping['address2'];
        $order->postal_code = $shipping['postal_code'];
        $order->state = $shipping['state'];
        $order->city = $shipping['city'];
        $order->shipping_method = $shipping['shipping_method'];
        $order->shipping_price = $shipping['shipping_price'];
        $order->customer_discount = $customer->discount;
        $order->total_discount = 0.0;
        $order->grand_total = 0.0;
    }
}
