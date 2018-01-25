<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property |\Cake\ORM\Association\HasMany $OrdersDetails
 * @property |\Cake\ORM\Association\BelongsToMany $Categories
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemsTable extends Table
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

        $this->setTable('items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('OrdersDetails', [
            'foreignKey' => 'item_id'
        ]);

        $this->hasMany('Images',[
            'foreignKey' => 'item_id'
        ]);

        $this->belongsToMany('Categories', [
            'foreignKey' => 'item_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_items'
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
            ->scalar('sku')
            ->maxLength('sku', 255)
            ->requirePresence('sku', 'create')
            ->notEmpty('sku')
            ->add('sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->numeric('stock')
            ->allowEmpty('stock');

        $validator
            ->scalar('unit')
            ->maxLength('unit', 45)
            ->requirePresence('unit', 'create')
            ->notEmpty('unit');

        $validator
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->allowEmpty('brand');

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
        $rules->add($rules->isUnique(['sku']));

        return $rules;
    }
    public function getCategories()
    {
        $query = TableRegistry::get('Categories')->find('list')->select(['id', 'category'])->toArray();
        
        return $query;
    }
    public function getCategoryEntity($id)
    {
        $categories = TableRegistry::get('Categories');
        $category = $categories->get($id);
        return $category;
    }
    public function getImageEntity()
    {
        return TableRegistry::get('Images')->newEntity();
    }
    public function saveImage($img)
    {
        $images = TableRegistry::get('Images');
        if($images->save($img)){
            return true;
        }else{
            return false;
        }
    }
    public function getItemImages()
    {
        $images = TableRegistry::get('Images');
        return $images->find('all')->toArray();
    }
    public function getItemForCart($item = null, $amount = 1){
        return [
            'id' => $item->id,
            'sku' => $item->sku,
            'description' => $item->description,
            'price' => $item->price,
            'unit' => $item->unit,
            'brand' => $item->brand,
            'amount' => $amount,
            'img' =>  !empty($item->images) ? $item->images['0'] : 'default.png',
            'subtotal' => round($amount * $item['price'], 2)
            ];
    }
}
