<?php
namespace Parishop\ORMWrappers;

/**
 * Class EntitySemantic
 * @package    ORMWrappers
 * @subpackage Entity
 */
class EntitySemantic extends Entity
{
    /**
     * @param string $meta_title       Заголовок
     * @param string $meta_description Описание
     * @param string $meta_keywords    Ключевые фразы
     * @param string $og_title         Заголовок для социальных сетей
     * @param string $og_description   Описание для социальных сетей
     * @param string $og_image         Изображение для социальных сетей
     */
    public function setMetaData(
        $meta_title = null,
        $meta_description = null,
        $meta_keywords = null,
        $og_title = null,
        $og_description = null,
        $og_image = null)
    {
        $this->setField('meta_title', $meta_title);
        $this->setField('meta_description', $meta_description);
        $this->setField('meta_keywords', $meta_keywords);
        $this->setField('og_title', $og_title);
        $this->setField('og_description', $og_description);
        $this->setField('og_image', $og_image);
    }

    /**
     * @param int    $keywordGroupId Идентификатор семантической группы
     * @param int    $yandexRegionId Идентификатор Яндекс.Регион
     * @param int    $sexId          Идентификатор половой принадлежности
     * @param int    $plural         Идентификатор грамматического числа (0 - Не установлено, 1 - Ед. число, 2 - Мн. число, 3 - Без грам. числа)
     * @param bool   $season         Метка сезонности (Да/Нет)
     * @param string $season_start   Дата начала сезонности (Формат d.m.Y или Y-m-d)
     * @param string $season_end     Дата окончания сезонности (Формат d.m.Y или Y-m-d)
     * @param bool   $commercial     Метка коммерции (Да/Нет)
     */
    public function setSemantic(
        $keywordGroupId = 1,
        $yandexRegionId = 225,
        $sexId = 3003,
        $plural = 0,
        $season = false,
        $season_start = null,
        $season_end = null,
        $commercial = false)
    {
        $this->setField('keywordGroupId', (int)$keywordGroupId ? (int)$keywordGroupId : 1);
        $this->setField('yandexRegionId', (int)$yandexRegionId ? (int)$yandexRegionId : 225);
        $this->setField('sexId', in_array($sexId, array(3001, 3002, 3003)) ? $sexId : 3003);
        $this->setField('plural', (int)$plural ? (int)$plural : 0);
        $this->setField('season', $season ? 1 : 0);
        if($season) {
            $this->setField(
                'season_start', $season_start ? date('Y-m-d', date_create($season_start)->getTimestamp()) : null
            );
            $this->setField('season_end', $season_end ? date('Y-m-d', date_create($season_end)->getTimestamp()) : null);
        } else {
            $this->setField('season_start', null);
            $this->setField('season_end', null);
        }
        $this->setField('commercial', $commercial ? 1 : 0);
    }

    /**
     * @param string $meta_title       Заголовок
     * @param string $meta_description Описание
     * @param string $meta_keywords    Ключевые фразы
     * @param string $og_title         Заголовок для социальных сетей
     * @param string $og_description   Описание для социальных сетей
     * @param string $og_image         Изображение для социальных сетей
     * @param int    $keywordGroupId   Идентификатор семантической группы
     * @param int    $yandexRegionId   Идентификатор Яндекс.Регион
     * @param int    $sexId            Идентификатор половой принадлежности
     * @param int    $plural           Идентификатор грамматического числа (0 - Не установлено, 1 - Ед. число, 2 - Мн. число, 3 - Без грам. числа)
     * @param bool   $season           Метка сезонности (Да/Нет)
     * @param string $season_start     Дата начала сезонности (Формат d.m.Y или Y-m-d)
     * @param string $season_end       Дата окончания сезонности (Формат d.m.Y или Y-m-d)
     * @param bool   $commercial       Метка коммерции (Да/Нет)
     */
    public function updateSemantic(
        $meta_title = null,
        $meta_description = null,
        $meta_keywords = null,
        $og_title = null,
        $og_description = null,
        $og_image = null,
        $keywordGroupId = 1,
        $yandexRegionId = 225,
        $sexId = 3003,
        $plural = 0,
        $season = false,
        $season_start = null,
        $season_end = null,
        $commercial = false)
    {
        $this->setMetaData($meta_title, $meta_description, $meta_keywords, $og_title, $og_description, $og_image);
        $this->setSemantic(
            $keywordGroupId, $yandexRegionId, $sexId, $plural, $season, $season_start, $season_end,
            $commercial
        );
    }

}
