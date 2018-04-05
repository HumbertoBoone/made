<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('customer_id');
        $this->setPrimaryKey('customer_id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Timestamp');
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
            ->integer('customer_id')
            ->allowEmpty('customer_id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('role')
            ->maxLength('role', 45)
            ->requirePresence('role', 'create')
            ->notEmpty('role');

        $validator
            ->scalar('status')
            ->maxLength('status', 45)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('verification_token')
            ->maxLength('verification_token', 256)
            ->allowEmpty('verification_token');

        $validator
            ->dateTime('verification_token_created')
            ->allowEmpty('verification_token_created');

        $validator
            ->scalar('password_reset_token')
            ->maxLength('password_reset_token', 256)
            ->allowEmpty('password_reset_token');

        $validator
            ->dateTime('password_reset_token_created')
            ->allowEmpty('password_reset_token_created');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
    public function crearNuevo(array $customerData)
    {
        $customersTable = TableRegistry::get('Customers');
        $customer = $customersTable->newEntity();
        $customer->company = $customerData['company'];
        $customer->first_name = $customerData['first_name'];
        $customer->last_name = $customerData['last_name'];
        $customer->address1 = $customerData['address1'];
        $customer->address2 = $customerData['address2'];
        $customer->tel = $customerData['tel'];
        $customer->city = $customerData['city'];
        $customer->state = $customerData['state'];
        $customer->postal_code = $customerData['postal_code'];
        if ($customersTable->save($customer)) {
        // The $customer entity contains the id now
            return $customer->id;
        }
    }
    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
            ->select(['Users.customer_id', 'Users.email', 'Users.password', 'Users.role', 'Users.status'])
            ->contain(['Customers' => ['fields' => ['Customers.first_name','Customers.last_name','Customers.tel','Customers.company','Customers.discount']]])
                //->innerJoinWith('Customers')
            ->where(['Users.status' => 'verified']);

        return $query;
    }
}
