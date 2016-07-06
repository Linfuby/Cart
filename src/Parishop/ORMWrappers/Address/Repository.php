<?php
namespace Parishop\ORMWrappers\Address;

/**
 * Таблица Адресов покупателей
 * @method Query query()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \Parishop\ORMWrappers\Repository
{
    /**
     * @param int    $customerId Идентификатор покупателя
     * @param string $phone      Номер телефона (В формате 8хххххххххх)
     * @param string $lastname   Фамилия
     * @param string $firstname  Имя
     * @param string $middlename Отчество
     * @param string $zip        Индекс
     * @param int    $countryId  Идентификатор страны
     * @param int    $regionId   Идентификатор Региона/Области
     * @param int    $cityId     Идентификатор Города
     * @param string $city_name  Название города (Если отсутствует идентификатор)
     * @param string $street     Адрес
     * @return \PHPixie\ORM\Models\Type\Database\Entity
     * @deprecated
     */
    public function add(
        $customerId,
        $phone,
        $lastname = null,
        $firstname = null,
        $middlename = null,
        $zip = null,
        $countryId = null,
        $regionId = null,
        $cityId = null,
        $city_name = null,
        $street = null)
    {
        $entity = $this->create();
        $entity->setField('customerId', $customerId);
        $entity->setField('phone', $phone);
        $entity->setField('lastname', htmlentities($lastname));
        $entity->setField('firstname', htmlentities($firstname));
        $entity->setField('middlename', htmlentities($middlename));
        $entity->setField('zip', $zip ? substr($zip, 0, 6) : null);
        $entity->setField('countryId', (int)$countryId ? (int)$countryId : 176);
        $entity->setField('regionId', $regionId ? $regionId : null);
        $entity->setField('cityId', $cityId ? $cityId : null);
        $entity->setField('city_name', htmlentities($city_name));
        $entity->setField('street', htmlentities($street));
        $entity->save();

        return $entity;
    }

    /**
     * @param mixed $data
     * @return Entity
     */
    public function create($data = null)
    {
        if($data != null) {
            // Получаем Валидатор Адреса
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
                    /** @var \PHPixie\Validate\Errors\Error\Custom $error */
                    foreach($fieldResult->errors() as $error) {
                        $errors[$fieldResult->path()][$error->type()] = $error->asString();
                    }
                }

                return $errors;
            }
            $fields     = array(
                'customerId',
                'lastname',
                'firstname',
                'middlename',
                'email',
                'phone',
                'countryId',
                'regionId',
                'cityId',
                'street',
                'home',
                'housing',
                'flat',
                'zip',
            );
            $data       = $result->getValue();
            $entityData = array();
            foreach($fields as $field) {
                if(isset($data[$field])) {
                    $entityData[$field] = $data[$field];
                }
            }
            $entityData['phone']    = \Parishop\ORMWrappers\Customer\Entity::convertPhone($entityData['phone']);
            $entityData['modified'] = date('Y-m-d H:i:s');

        } else {
            $entityData = null;
        }
        if(!empty($data['id'])) {
            $this->query()->in($data['id'])->update($entityData);

            return $this->query()->in($data['id'])->findOne();
        }

        return parent::create($entityData);
    }

    /**
     * @param int    $id         Идентификатор адреса
     * @param int    $customerId Идентификатор покупателя
     * @param string $phone      Номер телефона (В формате 8хххххххххх)
     * @param string $lastname   Фамилия
     * @param string $firstname  Имя
     * @param string $middlename Отчество
     * @param string $zip        Индекс
     * @param int    $countryId  Идентификатор страны
     * @param int    $regionId   Идентификатор Региона/Области
     * @param int    $cityId     Идентификатор Города
     * @param string $city_name  Название города (Если отсутствует идентификатор)
     * @param string $street     Адрес
     * @return \PHPixie\ORM\Models\Type\Database\Entity
     * @throws \Exception
     * @deprecated
     */
    public function edit(
        $id,
        $customerId,
        $phone,
        $lastname = null,
        $firstname = null,
        $middlename = null,
        $zip = null,
        $countryId = null,
        $regionId = null,
        $cityId = null,
        $city_name = null,
        $street = null)
    {
        $entity = $this->query()->load($id);
        $entity->setField('customerId', $customerId);
        $entity->setField('phone', $phone);
        $entity->setField('lastname', htmlentities($lastname));
        $entity->setField('firstname', htmlentities($firstname));
        $entity->setField('middlename', htmlentities($middlename));
        $entity->setField('zip', $zip ? substr($zip, 0, 6) : null);
        $entity->setField('countryId', $countryId ? $countryId : null);
        $entity->setField('regionId', $regionId ? $regionId : null);
        $entity->setField('cityId', $cityId ? $cityId : null);
        $entity->setField('city_name', htmlentities($city_name));
        $entity->setField('street', htmlentities($street));
        $entity->setField('home', htmlentities($street));
        $entity->setField('housing', htmlentities($street));
        $entity->save();

        return $entity;
    }

    /**
     * Валидация Адреса
     * customerId - Идентификатор Покупателя. BIGINT * Обязателен
     * lastname - Фамилия. STRING * Обязателен
     * firstname - Имя. STRING * Обязателен
     * middlename - Отчество. STRING
     * email - E-Mail. STRING(EMAIL) * Обязателен
     * phone - Телефон. INT(11) * Обязателен
     * zip - Индекс. INT(6)
     * countryId - Идентификатор страны. BIGINT
     * regionId - Идентификатор Региона/Области. BIGINT
     * cityId - Идентификатор города. BIGINT * Обязателен
     * street - Адрес. STRING (255) * Обязателен
     * home - Номер дома STRING(255) * Обязателен
     * housing - Номер корпуса STRING(255)
     * flat - Номер кваритиры STRING(255)
     * @return \PHPixie\Validate\Validator
     */
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
        // customerId - Идентификатор Покупателя. BIGINT * Обязателен
        $document->valueField('customerId')
            ->required()
            ->addFilter()
            ->numeric()
            ->minLength(1)
            ->maxLength(20);
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
        // zip - Индекс. INT(6)
        $document->valueField('zip')
            ->addFilter()
            ->numeric()
            ->minLength(5)
            ->maxLength(6);
        // cityId - Идентификатор города. BIGINT * Обязателен
        $document->valueField('cityId')
            ->required()
            ->addFilter()
            ->slug()
            ->minLength(1)
            ->maxLength(20);
        // street - Адрес. STRING (255) * Обязателен
        $document->valueField('street')
            ->required()
            ->addFilter()
            ->minLength(1)
            ->maxLength(255);
        // home - Номер дома STRING(255) * Обязателен
        $document->valueField('home')
            ->required()
            ->addFilter()
            ->minLength(1)
            ->maxLength(255);
        // housing - Номер корпуса STRING(255)
        $document->valueField('housing')
            ->addFilter()
            ->alphaNumeric()
            ->maxLength(255);
        // flat - Номер кваритиры STRING(255)
        $document->valueField('flat')
            ->addFilter()
            ->alphaNumeric()
            ->maxLength(255);
        $rule->callback(
            function (\PHPixie\Validate\Results\Result\Root $result, $values) {
                /** @var \PHPixie\Validate\Results\Result\Field $field */
                foreach($result->fields() as $field) {
                    if(!$field->isValid()) {
                        foreach($field->errors() as $error) {
                            if($error instanceof \PHPixie\Validate\Errors\Error\EmptyValue) {
                                $field->addCustomError($field->path(), 'Обязательно для заполнения');
                            } elseif($error instanceof \PHPixie\Validate\Errors\Error\Filter) {
                                switch($error->filter()) {
                                    case 'alpha':
                                        $field->addCustomError($field->path(), 'Должно содержать только буквы');
                                        break;
                                    case 'alphaNumeric':
                                        $field->addCustomError($field->path(), 'Должно содержать только буквы и цифры');
                                        break;
                                    case 'numeric':
                                        $field->addCustomError($field->path(), 'Должно содержать только цифры');
                                        break;
                                    case 'minLength':
                                        $field->addCustomError($field->path(), 'Минимум ' . current($error->parameters()) . ' символов');
                                        break;
                                    case 'maxLength':
                                        $field->addCustomError($field->path(), 'Максимум ' . current($error->parameters()) . ' символов');
                                        break;
                                }
                            }
                        }
                    }
                }
            }
        );

        return $validator;
    }

    /**
     * @param Entity                                 $entity
     * @param \PHPixie\Slice\Type\ArrayData\Editable $data
     */
    public function update($entity, $data = null)
    {
        if($data instanceof \PHPixie\Slice\Type\ArrayData\Editable) {
            $entity->setField('customerId', $data->get('customerId', $entity->getRequiredField('customerId')));
            $entity->setField('lastname', $data->get('lastname', $entity->getField('lastname')));
            $entity->setField('firstname', $data->get('firstname', $entity->getField('firstname')));
            $entity->setField('middlename', $data->get('middlename', $entity->getField('middlename')));
            $entity->setField('email', $data->get('email', $entity->getRequiredField('email')));
            $entity->setField('phone', \Parishop\ORMWrappers\Customer\Entity::convertPhone($data->get('phone', $entity->getField('phone'))));
            $entity->setField('countryId', $data->get('countryId', $entity->getRequiredField('countryId')));
            $entity->setField('regionId', $data->get('regionId', $entity->getRequiredField('regionId')));
            $entity->setField('cityId', $data->get('cityId', $entity->getRequiredField('cityId')));
            $entity->setField('street', $data->get('street', $entity->getField('street')));
            $entity->setField('home', $data->get('home', $entity->getField('home')));
            $entity->setField('housing', $data->get('housing', $entity->getField('housing')));
            $entity->setField('flat', $data->get('flat', $entity->getField('flat')));
            $entity->setField('zip', $data->get('zip', $entity->getField('zip')));
            $entity->setField('modified', date('Y-m-d H:i:s'));
        }
    }


}
