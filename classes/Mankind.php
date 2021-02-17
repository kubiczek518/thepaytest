<?php

//V praxi singleton design a static metody nepoužívám, porušují zásady OOP, zde jsou tyto praktiky použity pro splnění zadání "Pouze 1 instance"

class Mankind{

    private static $instance = null;
    private $persons = array();

    public static function getInstance()
    {
        if(self::$instance == null)
            self::$instance = new Mankind();
        return self::$instance;
    }

    private function __construct()
    {
    }

    public function getPersonsArray(){
        $pairArray = array();
        foreach($this->persons as $person)
            $pairArray[$person->getId()] = $person;

        return $pairArray;
    }

    public function getPersonById($id){
        $found = from($this->persons)->where('$o ==> $o->getId() == '.$id)->toArrayDeep();
        if(sizeof($found) > 0)
            return array_values($found)[0];

        throw new Exception("Person with ID $id does not exist");
    }

    public function getMenPercent(){
        if(sizeof($this->persons) == 0)
            return 0;

        return floor(from($this->persons)->where('$o ==> $o->getSex() == "M"')->count() / sizeof($this->persons) * 100);
    }

    public function loadFromCsv($url){
        $newPersons = array();
        $fn = fopen($url, "r");
        while(!feof($fn))  {
            $result = explode(';', fgets($fn));
            array_push($newPersons, new Person($result[0], $result[1], $result[2], $result[3], $result[4]));
        }
        fclose($fn);
        $this->persons = $newPersons;

        // V případě jednorázového zpracování velkého souboru zavolat v jeden moment na úrovni OS vícekrát skript s parametrem offset a číst vždy od určitého řádku
        // V případě častého zpracování velkého souboru jednorázově vložit do databáze a poté již s daty pracovat na abstraktní vrstvě
    }

}