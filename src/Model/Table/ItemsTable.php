<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Items Model
 *
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\BrandsTable|\Cake\ORM\Association\BelongsTo $Brands
 * @property \App\Model\Table\GroupsTable|\Cake\ORM\Association\HasMany $Groups
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\HasMany $Images
 * @property \App\Model\Table\CouponsTable|\Cake\ORM\Association\BelongsToMany $Coupons
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
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);
        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id'
        ]);
        $this->hasMany('Groups', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('Images', [
            'foreignKey' => 'item_id'
        ]);
        $this->belongsToMany('Coupons', [
            'foreignKey' => 'item_id',
            'targetForeignKey' => 'coupon_id',
            'joinTable' => 'coupons_items'
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
            ->allowEmpty('sku')
            ->add('sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->scalar('short_description')
            ->maxLength('short_description', 350)
            ->allowEmpty('short_description');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->decimal('stock')
            ->allowEmpty('stock');

        $validator
            ->scalar('unit')
            ->maxLength('unit', 45)
            ->requirePresence('unit', 'create')
            ->notEmpty('unit');

        $validator
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['brand_id'], 'Brands'));

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
    public function getItemForCart($item = null,$item_request){
        $quantity = isset($item_request['quantity']) ? $item_request['quantity'] : 1; 
        unset($item_request['item_id']);
        unset($item_request['quantity']);
        /*foreach ($item_request as $i => $row) {
            if ($row == '')
               unset($item_request[$i]);
        }*/
        foreach($item['options'] as $option)
        {
            
        }
        return [
            'id' => $item->id,
            'sku' => $item->sku,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'unit' => $item->unit,
            'brand' => $item->brand,
            'quantity' => $quantity,
            'options' => $item_request,
            'img' =>  !empty($item->images) ? $item->images['0'] : 'default.png',
            'subtotal' => round($quantity * $item['price'], 2),
            ];
    }
}
