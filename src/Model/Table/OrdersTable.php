<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Number;
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
        $this->hasMany('OrderDetails', [
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
    public function getShippingMethods()
    {
        $methods = TableRegistry::get('ShippingMethods');
        return $methods->find()->where(['status =' => 'enabled'])->toArray();
    }
    public function getShippingMethod($id)
    {
        $methods = TableRegistry::get('ShippingMethods');
        return $methods->find()->where(['status =' => 'enabled', 'id =' => $id])->first();
    }
    public function verifyCoupon($coupon_code, $total)
    {
        $coupons = TableRegistry::get('Coupons');
        $shipping_methods = TableRegistry::get('ShippingMethods');
        $items = TableRegistry::get('Items');
        $coupon = $coupons->find()->where(['code' => $coupon_code])->first();
        $exp_date = new Time($coupon->expiration_date);
        //debug($coupon->min_amount);
        //debug($total);
        if ($exp_date->isFuture()) {
            if ($coupon->min_amount < $total) {
                if ($coupon->active == true) {
                    if ($coupon->type == 'shipping_discount') {
                        $shipping_methods->find()->where(['id' => $coupon->id]);
                    } elseif ($coupon->type == 'percentage_discount') {
                        return ['valid' => TRUE, 'discount' => $total * $coupon->value, 'message' => 'success'];
                    } elseif ($coupon->type == 'fixed_cart_discount') {
                        return ['valid' => TRUE,'discount' => $coupon->value, 'message' => 'success'];
                    } elseif ($coupon->type == 'item_discount') {
                        $query = $items->find();
                        $query->matching('Coupons', function($q) {
                            return $q->where(['Coupons.id' => $coupon->id]);
                        });
                    }
                } else {
                    return ['valid' => FALSE,'discount' => 0.0, 'message' => 'El cupon no esta disponible'];
                }
            } else {
                $min_amount = Number::currency($coupon->min_amount, null, ['after' => ' pesos']);
                return ['valid' => FALSE, 'discount' => 0.0, 'message' => 'Se requiere una cantidad mínima de '.$min_amount.' para validar cupon '];
            }
        } else {
            return ['valid' => FALSE, 'discount' => 0.0, 'message' => 'El cupon ha expirado'];
        }
    }
    public function kk()
    {
        //debug(Time::now());
        debug(Cake\I18n\Number::defaultCurrency());
    }
    public function saveOrder($total,$order_s, $customer, $type = null,  $reference = null)
    {
        $orders = TableRegistry::get('Orders');
        $order_details = TableRegistry::get('OrderDetails');

        $order = $orders->newEntity();
        
        //debug(count($order_s['items']));
        $order->customer_id = $customer['customer_id'];
        $order->reference = $reference;
        $order->payment_type = $type;
        $order->status = "created";
        $order->recipient_name = $order_s['shipping_address']['recipient_name'];
        $order->address1 = $order_s['shipping_address']['address1'];
        $order->address2 = $order_s['shipping_address']['address2'];
        $order->postal_code = $order_s['shipping_address']['postal_code'];
        $order->state = $order_s['shipping_address']['state'];
        $order->city = $order_s['shipping_address']['city'];
        $order->shipping_method = isset($order_s['shipping_method']['description']) ? $order_s['shipping_method']['method'] : "FREE";
        $order->shipping_price = isset($order_s['shipping_method']['price']) ? $order_s['shipping_method']['price'] : 0.0;
        $order->customer_discount = $customer['customer']['discount'];
        //$order->total_discount = $order->customer_discount * $total;
        $order->coupon_code = "";
        //$order->coupon_created = Time::now();
        $order->coupon_type = "";
        $order->coupon_single_use = "";
        $order->coupon_value = "";
        //$order->coupon_expiration_date = "";
        if ($order->coupon_type == "percentage_discount") {
            $order->total_discount = $total * $order->coupon_value;
        } elseif ($order->coupon_type == "fixed_cart_discount") {
            $order->total_discount = $total - $order->coupon_value;
        }
        $order->grand_total = $total - $order->total_discount;

        if ($orders->save($order)) {
            $order_id = $order->id;
            foreach($order_s['items'] as $i)
            {
                $item = $order_details->newEntity();
                $item->order_id = $order_id;
                $item->sku = $i['sku'];
                $item->name = $i['name'];
                $item->description = $i['description'];
                $item->brand = isset($i['brand']) ? $i['brand'] : "no-brand";
                $item->unit_price = $i['price'];
                $item->unit = $i['unit'];
                $item->amount = $i['quantity'];
                $item->subtotal = $i['subtotal'];
                $item->options = isset($i['options']) ? json_encode($i['options']) : null;
                $order_details->save($item);
            }
        }
        //debug($order);
        return $order;
    }
}
