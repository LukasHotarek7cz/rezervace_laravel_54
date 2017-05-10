<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\tabulka_rezervacis;
use App\cLHRezervace1Model;

class cLHRezervace1Controller extends Controller
{
	public function index()
	{
		$error1 = "";
		$odchoziFormular1 = new cLHRezervace1Model();
		$odchoziFormular1->mDatumyUprava();
		$odchoziFormular1->mDatumy2FormDatumy();
		$odchoziFormular2 = $odchoziFormular1->mDataDoForm();
		$tasks1 = tabulka_rezervacis::orderBy('datum', 'asc')->get();
		return view('LHviews1', compact('tasks1', 'odchoziFormular2', 'error1'));
	}

	public function store(Request $request)
	{

		$errors=null;
		$error1="";
		$prichoziFormular1 = new cLHRezervace1Model();
		$odchoziFormular1 = new cLHRezervace1Model();

		$this->validate(request(), [
			"ittnDatum1" => "required|nullable|max:24"
			,"ittnNazev1" => "required|nullable|max:20"
			,"ittnPoznamka1" => "nullable|max:20"
			,"ittnTelefon1" => "required|nullable|max:12|min:9"
			,"ittnMod1" => "required|nullable|max:1"
			,"ittnDatum2" => "nullable|max:24"
		]);

		$prichoziFormular1->datum1 = request('ittnDatum1');
		$prichoziFormular1->nazev1 = request('ittnNazev1');
		$prichoziFormular1->poznamka1 = request('ittnPoznamka1');
		$prichoziFormular1->telefon1 = request('ittnTelefon1');
		$prichoziFormular1->mod1 = request('ittnMod1');
		$prichoziFormular1->datum2 = request('ittnDatum2');

		$prichoziFormular1->mDatumyUprava();
		$prichoziFormular1->mFormDatumy2Datumy();

		$SQLdotaz1 = tabulka_rezervacis::where("datum", $prichoziFormular1->datum1);
		$SQLdotaz2 = tabulka_rezervacis::where("datum", $prichoziFormular1->datum2);

		switch($prichoziFormular1->mod1){
		case 1://přidat
			if($SQLdotaz1->count() > 0){
				$error1="Zadany datum a hodina josu obsazeny";
				$odchoziFormular1=$prichoziFormular1;
			} else{
				tabulka_rezervacis::insert($prichoziFormular1->mDataDoDB());
			}
			break;

		case 2://upravit
			if((!$prichoziFormular1->mJsouDatumyStejne() && $SQLdotaz1->count() > 0) || ($prichoziFormular1->mJsouDatumyStejne() &&  $SQLdotaz1->count() > 1)){
				$error1="Zadany datum a hodina josu obsazeny";
				$odchoziFormular1=$prichoziFormular1;
			} else{
				if($SQLdotaz2->count() > 0){
					$SQLdotaz2->delete();
				}
				tabulka_rezervacis::insert($prichoziFormular1->mDataDoDB());
			}
			break;

		case 3://smazat
			if($SQLdotaz1->count() > 0){
				$SQLdotaz1->delete();
			}
			break;
		}

		$odchoziFormular1->mDatumyUprava();
		$odchoziFormular1->mDatumy2FormDatumy();
		$odchoziFormular2 = $odchoziFormular1->mDataDoForm();

		$tasks1 = tabulka_rezervacis::orderBy('datum', 'asc')->get();
		return view('LHviews1', compact('tasks1', 'odchoziFormular2', 'error1'));
	}
	
	
}
