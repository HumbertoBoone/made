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
        foreach ($item_request as $i => $row) {
            if ($row == '')
               unset($item_request[$i]);
        }
        $options = null;
        $options_total = 0.0;
        $message = '';
        $options_table = TableRegistry::get('Options');
        $groups_table = TableRegistry::get('Groups');
        //debug($item_request);
        $options_array = array();
        $options_linear = array();
        $options_upsidedown = array();
        foreach($item_request as  $u => $option)
        {
            if(is_array($option)){
                    $suboptions_group = array();
                    //debug($g);
                    $pp = array();
                    foreach($option as $g => $suboption){
                        $suboption = $options_table->get($suboption);
                        $valid = $groups_table->exists(['id' => $suboption->group_id, 'item_id' =>$item->id]);
                        if($suboption->available == 1 && ($suboption->stock > 0 || $suboption->stock == null) && $valid)
                        {
                            $pp[$u][] = array(
                                'id' => $suboption->id,
                                'name' => $suboption->name,
                                'value' => $suboption->value);
                            //$pp[$u] = $suboptions_group;    
                            $options_total += $suboption->value;
                        }else{
                            $message .= $suboption->name.'<br>';
                        }
                    }
                    //debug($suboptions_group);
                    //debug($pp);
                    $options[] = $pp;
                }else if(is_numeric($option) && $options_table->exists(['id' => intval($option)])){
                    // debug(intval($option));
                    $option = $options_table->get(intval($option));
                    $valid = $groups_table->exists(['id' => $option->group_id, 'item_id' =>$item->id]);
                    if($option->available == 1 && ($option->stock > 0 || $option->stock == null) && $valid)
                    {
                        $options[] = [$u => [
                            'id' => $option->id,
                            'name' => $option->name,
                            'value' => $option->value]];
                        $options_total += $option->value;
                    }
                    else
                    {
                       $message .= $option->name.'<br>';
                    }
                    //$options_total += $option->value;
                }else if(is_integer($u) && $options_table->exists(['id' => $u])){
                    $option_entity = $options_table->get($u);
                    $valid = $groups_table->exists(['id' => $option_entity->group_id, 'item_id' =>$item->id]);
                    $group = $groups_table->get($option_entity->group_id);
                    if($option_entity->available == 1 && ($option_entity->stock > 0 || $option_entity->stock == null) && $valid)
                    {
                        $options[] = [$group->name => [
                            'id' => $option_entity->id,
                            'name' => $option_entity->name,
                            'value' => $option_entity->value,
                            'content' => $option]];
                        $options_total += $option_entity->value;
                    }
                    else
                    {
                        $message .= $option->name.'<br>';
                    }
                }
        }
        //debug($options_total);
        //$options[] = $options_array;
        //$options[] = $options_linear;
        //$options[] = $options_upsidedown;
        //debug($options);
        return [
            'id' => $item->id,
            'sku' => $item->sku,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'unit' => $item->unit,
            'brand' => $item->brand,
            'quantity' => $quantity,
            'options' => $options,
            'img' =>  !empty($item->images) ? $item->images['0'] : 'default.png',
            'subtotal' => round($quantity * ($item->price + $options_total), 2),
            ];
    }
}
