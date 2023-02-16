<?php
Class WitchExorcism {
  public $villagers;    

  private $deathRate;

  function __construct() {
      $this->villagers = [];
  }       

  private function getVillagersKilledByWitch($year) {
      $villagersKilled = 0;
      for ($i = 1; $i <= $year; $i++) {
          $villagersKilled += $this->getFibonacci($i);
      }
      return $villagersKilled;
  }

  private function getFibonacci($year) {
      if ($year == 1 || $year == 2) {
          return 1;
      }
      return $this->getFibonacci($year - 1) + $this->getFibonacci($year - 2);
  }
  
  private function getAverageDeathRate() {        
      $totalDeathRate = 0;
      $numberAdded = [];

      foreach ($this->villagers as $villager) {
          $totalDeathRate += $villager['deathRate'];            
          $numberAdded[] = $villager['deathRate'];
      }

      $result = '('. implode(' + ', $numberAdded) .') / ' . count($this->villagers) . ' = ' . $totalDeathRate / count($this->villagers);

      return $result;
  }

  public function addVillager($name, $ageOfDeath, $yearOfDeath) {
      $yearOfBirth = $yearOfDeath - $ageOfDeath;

      if ($yearOfBirth < 0) $yearOfBirth = -1;

      $this->villagers[] = [
          'name' => $name,
          'yearOfBirth' => $yearOfBirth,
          'yearOfDeath' => $yearOfDeath,
          'ageOfDeath' => $ageOfDeath,
          'deathRate' => $this->getVillagersKilledByWitch($yearOfBirth)
      ];
  }

  public function getEstimateDeathRate() {
      $arrAnswer = [];
      foreach ($this->villagers as $villager) {
          $arrAnswer[] = 'Person ' . $villager['name'] . ' born on Year = ' . $villager['yearOfDeath'] . ' – ' . $villager['ageOfDeath'] . ' = ' . $villager['yearOfBirth'] . ', number of people killed on year ' . $villager['yearOfBirth'] . ' is ' . $villager['deathRate'];
      }

      $arrAnswer[] = 'So the average is ' . $this->getAverageDeathRate();

      return $arrAnswer;
  }

}

$vm = new WitchExorcism();
$vm->addVillager('A', 10, 12);
$vm->addVillager('B', 13, 17);

print_r($vm->getEstimateDeathRate());
?>