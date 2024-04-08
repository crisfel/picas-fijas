<?php

namespace controller;

class PicasFijasController
{
    public $picasMatches;
    public $fijasMatches;
    public $congratulationsMessage;

    public function __construct()
    {
        $this->picasMatches = 0;
        $this->fijasMatches = 0;
        $this->congratulationsMessage = '';
    }


    public function getFijasMatches()
    {
        return $this->fijasMatches;
    }

    public function getPicasMatches()
    {
        return $this->picasMatches;
    }

    public function incrementFijas()
    {
        $this->fijasMatches++;
    }

    public function incrementPicas()
    {
        $this->picasMatches++;
    }

    public function seeAllMatches($secret, $numList)
    {
        if (!empty($secret) && !empty($numList) && !isset($_SESSION['secret'])) {
            $numArr = str_split($numList);
            $_SESSION['secret'] = $secret;
            $this->compareSecret($numArr);

            if ($this->getFijasMatches() == count($numArr)) {
                $this->congratulationsMessage = '¡Felicitaciones has adivinado la serie de números!, el la serie secreta era '. $_SESSION['secret'];
                unset($_SESSION['secret']);

                return $this->congratulationsMessage;

            }

            return 'Número de picas = ' . $this->getPicasMatches() . ' Número de fijas= ' . $this->getFijasMatches();

        } elseif (!empty($numList) && isset($_SESSION['secret'])) {
            $numArr = str_split($numList);
            $this->compareSecret($numArr);

            if ($this->getFijasMatches() == count($numArr)) {
                $this->congratulationsMessage = '¡Felicitaciones has adivinado la serie de números!, el la serie secreta era '. $_SESSION['secret'];
                unset($_SESSION['secret']);

                return $this->congratulationsMessage;
            }

            return 'Número de picas = ' . $this->getPicasMatches() . ' Número de fijas= ' . $this->getFijasMatches();
        }
    }

        public function compareSecret($numArr)
        {
            for ($i = 0; $i < count($numArr); $i++) {
                $index = array_search($numArr[$i], str_split($_SESSION['secret']));

                if ($index > -1 && $i == $index) {
                    $this->incrementFijas();
                }

                if ($index > -1 && $i != $index) {
                    $this->incrementPicas();
                }
            }
        }
/*

*/
}