<?php
namespace Meling\Cart\Points\Point\Deliveries;

class Cdek extends Delivery
{
    private $cost;

    public function cost()
    {
        if($this->cost === null) {
            $cdek   = new CalculatePriceDeliveryCdek();
            $sender = $this->getCdekCityId($this->cityEntity->name());
            if($sender === null) {
                return null;
            }
            $receiver = $this->getCdekCityId($this->cityEntity->name());
            if($receiver === null) {
                return null;
            }
            $cdek->setSenderCityId($sender['id']);
            $cdek->setReceiverCityId($receiver['id']);
            $cdek->setModeDeliveryId(1);
            $cdek->addTariffPriority(139);
            $cdek->addTariffPriority(1);
            $cdek->addTariffPriority(18);
            $cdek->addGoodsItemByVolume(1, 1 / 200);
            try {
                $cdek->calculate();
                if($result = $cdek->getResult()) {
                    $this->name = $this->cityEntity->name();

                    $this->cost = (int)$result['result']['price'];
                }
            } catch(\Exception $e) {
            }
        }

        return $this->cost;
    }

    /**
     * @param string $cityName
     * @return mixed
     */
    public function getCdekCityId($cityName)
    {
        $uri    = 'http://api.cdek.ru/city/getListByTerm/jsonp.php?q=' . $cityName . '&name_startsWith=' . $cityName;
        $result = json_decode(file_get_contents($uri), true);
        if(isset($result['geonames'])) {
            return current($result['geonames']);
        }

        return null;
    }

}

class CalculatePriceDeliveryCdek
{
    public  $dateExecute;

    public  $goodsList;

    public  $tariffList;

    private $authLogin;

    private $authPassword;

    private $error;

    private $jsonUrl = 'http://api.cdek.ru/calculator/calculate_price_by_json.php';

    private $modeId;

    private $receiverCityId;

    private $result;

    private $senderCityId;

    private $tariffId;

    private $version = "1.0";

    public function __construct()
    {
        $this->dateExecute = date('Y-m-d');
    }

    /*public function addGoodsItemBySize($weight, $length, $width, $height)
    {
        $weight = (float)$weight;
        if(!$weight) {
            throw new \Exception("Неправильно задан вес места № " . (count($this->getGoodsList()) + 1) . ".");
        }
        $paramsItem = array(
            "длина"  => $length,
            "ширина" => $width,
            "высота" => $height,
        );
        foreach($paramsItem as $k => $param) {
            $param = (int)$param;
            if($param == 0) {
                throw new \Exception(
                    "Неправильно задан параметр '" . $k . "' места № " . (count($this->getGoodsList()) + 1) . "."
                );
            }
        }
        $this->goodsList[] = array(
            'weight' => $weight,
            'length' => $length,
            'width'  => $width,
            'height' => $height,
        );
    }*/

    public function addGoodsItemByVolume($weight, $volume)
    {
        $paramsItem = array(
            "вес"          => $weight,
            "объёмный вес" => $volume,
        );
        foreach($paramsItem as $k => $param) {
            $param = (float)$param;
            if(!$param) {
                throw new \Exception(
                    "Неправильно задан параметр '" . $k . "' места № " . (count($this->getGoodsList()) + 1) . "."
                );
            }
        }
        $this->goodsList[] = array(
            'weight' => $weight,
            'volume' => $volume,
        );
    }

    public function addTariffPriority($id, $priority = 0)
    {
        $id = (int)$id;
        if(!$id) {
            throw new \Exception("Неправильно задан id тарифа.");
        }
        $priority           = ($priority > 0) ? $priority : count($this->tariffList) + 1;
        $this->tariffList[] = array(
            'priority' => $priority,
            'id'       => $id,
        );
    }

    public function calculate()
    {
        $data                = array();
        $data['version']     = $this->version;
        $data['dateExecute'] = $this->dateExecute;
        if(!empty($this->authLogin)) {
            $data['authLogin'] = $this->authLogin;
        }
        if(!empty($this->authPassword)) {
            $data['secure'] = $this->_getSecureAuthPassword();
        }
        if(!empty($this->senderCityId)) {
            $data['senderCityId'] = $this->senderCityId;
        }
        if(!empty($this->receiverCityId)) {
            $data['receiverCityId'] = $this->receiverCityId;
        }
        if(!empty($this->tariffId)) {
            $data['tariffId'] = $this->tariffId;
        }
        if(!empty($this->tariffList)) {
            $data['tariffList'] = $this->tariffList;
        }
        if(!empty($this->modeId)) {
            $data['modeId'] = $this->modeId;
        }

        if(isset($this->goodsList)) {
            foreach($this->goodsList as $idGoods => $goods) {
                $data['goods'][$idGoods] = array();
                if(!empty($goods['weight']) && $goods['weight'] <> '' && $goods['weight'] > 0.00) {
                    $data['goods'][$idGoods]['weight'] = $goods['weight'];
                }
                if(!empty($goods['length']) && $goods['length'] <> '' && $goods['length'] > 0) {
                    $data['goods'][$idGoods]['length'] = $goods['length'];
                }
                if(!empty($goods['width']) && $goods['width'] <> '' && $goods['width'] > 0) {
                    $data['goods'][$idGoods]['width'] = $goods['width'];
                }
                if(!empty($goods['height']) && $goods['height'] <> '' && $goods['height'] > 0) {
                    $data['goods'][$idGoods]['height'] = $goods['height'];
                }
                if(!empty($goods['volume']) && $goods['volume'] <> '' && $goods['volume'] > 0.00) {
                    $data['goods'][$idGoods]['volume'] = $goods['volume'];
                }

            }
        }
        if(!extension_loaded('curl')) {
            throw new \Exception("Не подключена библиотека CURL");
        }
        $response = $this->_getRemoteData($data);
        if(isset($response['result']) && !empty($response['result'])) {
            $this->result = $response;

            return true;
        } else {
            $this->error = $response;

            return false;
        }
    }

    /*public function getError()
    {
        return $this->error;
    }*/

    public function getGoodsList()
    {
        if(!isset($this->goodsList)) {
            return null;
        }

        return $this->goodsList;
    }

    public function getResult()
    {
        return $this->result;
    }

    /*public function setAuth($authLogin, $authPassword)
    {
        $this->authLogin    = $authLogin;
        $this->authPassword = $authPassword;
    }*/

    /*public function setDateExecute($date)
    {
        $this->dateExecute = date($date);
    }*/

    public function setModeDeliveryId($id)
    {
        $id = (int)$id;
        if(!in_array($id, array(1, 2, 3, 4))) {
            throw new \Exception("Неправильно задан режим доставки.");
        }
        $this->modeId = $id;
    }

    public function setReceiverCityId($id)
    {
        $id = (int)$id;
        if($id == 0) {
            throw new \Exception("Неправильно задан город-получатель.");
        }
        $this->receiverCityId = $id;
    }

    public function setSenderCityId($id)
    {
        $id = (int)$id;
        if($id == 0) {
            throw new \Exception("Неправильно задан город-отправитель.");
        }
        $this->senderCityId = $id;
    }

    /*public function setTariffId($id)
    {
        $id = (int)$id;
        if($id == 0) {
            throw new \Exception("Неправильно задан тариф.");
        }
        $this->tariffId = $id;
    }*/

    private function _getRemoteData($data)
    {
        $data_string = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->jsonUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    private function _getSecureAuthPassword()
    {
        return md5($this->dateExecute . '&' . $this->authPassword);
    }

}