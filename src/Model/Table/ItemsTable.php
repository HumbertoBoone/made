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
 * @property |\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\ImagesTable|\Cake\ORM\Association\HasMany $Images
 * @property |\Cake\ORM\Association\BelongsToMany $Coupons
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

        /*$this->belongsTo('Groups', [
            'foreignKey' => 'group_id'
        ]);*/
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);
        $this->hasMany('Images', [
            'foreignKey' => 'item_id'
        ]);
        $this->hasMany('Groups', [
            'foreignKey' => 'group_id'
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
            ->requirePresence('sku', 'create')
            ->notEmpty('sku')
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
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->allowEmpty('brand');

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
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

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
