<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfigurationGroups Model
 *
 * @property \App\Model\Table\ConfigurationsTable|\Cake\ORM\Association\HasMany $Configurations
 *
 * @method \App\Model\Entity\ConfigurationGroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfigurationGroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfigurationGroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationGroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfigurationGroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationGroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfigurationGroup findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfigurationGroupsTable extends Table
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

        $this->setTable('configuration_groups');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Configurations', [
            'foreignKey' => 'configuration_group_id'
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        $validator
            ->allowEmpty('visible');

        return $validator;
    }
}
