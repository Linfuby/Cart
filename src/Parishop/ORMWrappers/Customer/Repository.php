<?php

namespace Parishop\ORMWrappers\Customer;

/**
 * Class Repository
 * @method Entity getByLogin($login)
 * @method Query query()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \PHPixie\AuthORM\Repositories\Type\Login
{
    /**
     * @var \Parishop\App\Builder
     */
    private $builder;

    public function __construct($repository, $builder)
    {
        parent::__construct($repository);
        $this->builder = $builder;
    }

    /**
     * @param mixed $data
     * @return Entity
     */
    public function create($data = array())
    {
        if($data !== null) {
            // Получаем Валидатор Покупателя
            $validator = $this->getValidator();
            /** @var \PHPixie\Validate\Results\Result $result */
            $result = $validator->validate($data);
            // Если данные не валидные
            if(!$result->isValid()) {
                $errors = array();
                foreach($result->errors() as $error) {
                    $errors[] = $error;
                }
                foreach($result->invalidFields() as $fieldResult) {
                    $errors[$fieldResult->path()] = array();
                    foreach($fieldResult->errors() as $error) {
                        $errors[$fieldResult->path()][] = $error;
                    }
                }

                return $errors;
            }
            if(empty($data['customerId'])) {
                foreach($this->loginFields() as $field) {
                    if($this->query()->where($field, $data[$field])->findOne()) {
                        return array('email' => array('Такой e-mail уже зарегистрирован. Авторизуйтесь'));
                    }
                }
            }
            $fields     = array(
                'lastname',
                'firstname',
                'middlename',
                'email',
                'phone',
                'password',
                'newsletter',
            );
            $data       = $result->getValue();
            $entityData = array();
            foreach($fields as $field) {
                if(isset($data[$field])) {
                    $entityData[$field] = $data[$field];
                }
            }
            if(empty($entityData['password'])) {
                $password = substr(md5(uniqid(rand(), true)), 0, 10);
            } else {
                $password = $entityData['password'];
            }
            $salt                   = substr(md5(uniqid(rand(), true)), 0, 9);
            $entityData['password'] = sha1($salt . sha1($salt . sha1($password)));
            $entityData['salt']     = $salt;
            $entityData['phone']    = Entity::convertPhone($entityData['phone']);
            $entityData['publish']  = 1;
            $entityData['modified'] = date('Y-m-d H:i:s');
        } else {
            $entityData = null;
        }
        /** @var Entity $customer */
        $customer = parent::create($entityData);

        // TODO-Linfuby: Отправить E-Mail с паролем после сохранения Покупателя
        //$this->builder->components()->email()->sendTemplate('register', $customer->email, array('password' => $password));

        return $customer;
    }

    public function getValidator()
    {
        /** Компонент Валидатора **************************************************************************************/
        $validator = $this->builder->components()->validate()->validator();
        /** @var \PHPixie\Validate\Rules\Rule\Value $rule */
        $rule = $validator->rule();
        /** @var \PHPixie\Validate\Rules\Rule\Data\Document $document */
        $document = $rule->addDocument();
        $document->allowExtraFields();
        /** Валидация полей *******************************************************************************************/
        // lastname - Фамилия. STRING * Обязателен
        $document->valueField('lastname')
            ->required()
            ->addFilter()
            ->alpha()
            ->minLength(2)
            ->maxLength(255);
        // firstname - Имя. STRING * Обязателен
        $document->valueField('firstname')
            ->required()
            ->addFilter()
            ->alpha()
            ->minLength(2)
            ->maxLength(255);
        // middlename - Отчество. STRING
        $document->valueField('middlename')
            ->addFilter()
            ->alpha()
            ->minLength(2)
            ->maxLength(255);
        // email - E-Mail. STRING(EMAIL) * Обязателен
        $document->valueField('email')
            ->required()
            ->filter('email');
        // phone - Телефон. INT(11) * Обязателен
        $document->valueField('phone')
            ->required()
            ->addFilter()
            ->phone();

        return $validator;
    }

    public function update(Entity $entity, $data = array())
    {
        if($data instanceof \PHPixie\Slice\Type\ArrayData\Editable) {
            if($data->get('password')) {
                $salt = substr(md5(uniqid(rand(), true)), 0, 9);
                $entity->setField('salt', $salt);
                $entity->setField('password', sha1($salt . sha1($salt . sha1($data->get('password')))));
            }
            $entity->setField('customerGroupId', $data->get('customerGroupId', $entity->getField('customerGroupId', 1)));
            $entity->setField('customerClientId', $data->get('customerClientId', $entity->getField('customerClientId')));
            $entity->setField('addressId', $data->get('addressId', $entity->getField('addressId')));
            $entity->setField('sexId', $data->get('sexId', $entity->getField('sexId', 3003)));
            $entity->setField('fb_id', $data->get('fb_id', $entity->getField('fb_id')));
            $entity->setField('vk_id', $data->get('vk_id', $entity->getField('vk_id')));
            $entity->setField('lastname', $data->get('lastname', $entity->getField('lastname')));
            $entity->setField('firstname', $data->get('firstname', $entity->getField('firstname')));
            $entity->setField('middlename', $data->get('middlename', $entity->getField('middlename')));
            $entity->setField('email', $data->get('email', $entity->getField('email')));
            $entity->setField('phone', Entity::convertPhone($data->get('phone', $entity->getField('phone'))));
            $entity->setField('wishlist', $data->get('wishlist', $entity->getField('wishlist')));
            $entity->setField('publish', $data->get('publish', $entity->getField('publish', 1)));
            $entity->setField('newsletter', $data->get('newsletter', $entity->getField('newsletter', 0)));
            $entity->setField('birthday', $data->get('birthday', $entity->getField('birthday', '0000-00-00')));
            $entity->setField('birthday_use', $data->get('birthday_use', $entity->getField('birthday_use', '0000-00-00')));
            $entity->setField('birthday_edit', $data->get('birthday_edit', $entity->getField('birthday_edit', '0000-00-00')));
            $entity->setField('marriage', $data->get('marriage', $entity->getField('marriage', '0000-00-00')));
            $entity->setField('marriage_use', $data->get('marriage_use', $entity->getField('marriage_use', '0000-00-00')));
            $entity->setField('marriage_edit', $data->get('marriage_edit', $entity->getField('marriage_edit', '0000-00-00')));
            $entity->setField('modified', date('Y-m-d H:i:s'));
            $entity->save();
        }
    }

    protected function loginFields()
    {
        return array('email');
    }


}
