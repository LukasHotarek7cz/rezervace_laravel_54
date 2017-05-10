<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cLHRezervace1Model extends Model
	{
	
	public $datum1 = "";
	public $nazev1 = "";
	public $poznamka1 = "";
	public $telefon1 = "";
	public $mod1 = 1;
	public $datum2 = "";
	
	public function __construct()
	{
		$this->datum1 = date("Y-m-d H:00:00:000",mktime((date('H')+2),0,0,date('m'),date('d'),date('Y')));
		$this->datum2 = date("Y-m-d H:00:00:000",mktime((date('H')+0),0,0,date('m'),date('d'),date('Y')));
		return $this;
	}
	
	public function mDataDoDB()
	{
		$this->mFormDatumy2Datumy();//zde by to bylo neteba ale je to prevence
		return [
			'datum' => $this->datum1
			,'nazev' => $this->nazev1
			,'poznamka' => $this->poznamka1
			,'telefon' => $this->telefon1
		];
	}
	
	public function mDataDoForm()
	{
		$this->mDatumy2FormDatumy();
		$R1 = [
			'datum1' => $this->datum1
			,'nazev1' => $this->nazev1
			,'poznamka1' => $this->poznamka1
			,'telefon1' => $this->telefon1
			,'mod1' => $this->mod1
			,'datum2' => $this->datum2
		];
		$this->mFormDatumy2Datumy();
		return $R1;
	}
	
	//tato metoda zaokrouhli dolu datum cas na hodiny
	public function mDatumUprava($aDatum1)
	{
		return (substr($aDatum1, 0, 13).":00:00.000");
	}
	
	//tato metoda zaokrouhly vsechny datumy v teto tride
	public function mDatumyUprava()
	{
		$this->datum1 = $this->mDatumUprava($this->datum1);
		$this->datum2 = $this->mDatumUprava($this->datum2);
		return $this;
	}
	
	//firmatovaci metoda datumu do <formu>
	public function mDatumy2FormDatumy()
	{
		$this->mDatumyUprava();
		$this->datum1[10]="T";
		$this->datum2[10]="T";
		return $this;
	}
	
	//firmatovaci metoda datumu do DB
	public function mFormDatumy2Datumy()
	{
		$this->mDatumyUprava();
		$this->datum1[10]=" ";
		$this->datum2[10]=" ";
		return $this;
	}
	
	public function mJsouDatumyStejne()
	{
		$this->mFormDatumy2Datumy();
		return ($this->datum1 == $this->datum2);
		return $this;
	}
	
}






