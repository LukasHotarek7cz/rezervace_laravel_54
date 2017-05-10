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
		$odchoziFormular1 = new cLHRezervace1Model();
		$odchoziFormular1 = $odchoziFormular1->mDataDoForm();
		$tasks1 = tabulka_rezervacis::orderBy('datum', 'asc')->get();
		return view('LHviews1', compact('tasks1', 'odchoziFormular1'));
	}

	public function store(Request $request)
	{

		$this->validate(request(), [
			"Datum" => "required|max:24"
			,"Název" => "required|max:20"
			,"Poznámka" => "nullable|max:20"
			,"Telefon" => "required|max:16|min:9"
			,"Mod" => "required|max:1"
			,"PuvodníDatum" => "nullable|max:24"
		]);

		$prichoziFormular1 = new cLHRezervace1Model();

		$prichoziFormular1->datum1 = request('Datum');
		$prichoziFormular1->nazev1 = request('Název');
		$prichoziFormular1->poznamka1 = request('Poznámka');
		$prichoziFormular1->telefon1 = request('Telefon');
		$prichoziFormular1->mod1 = request('Mod');
		$prichoziFormular1->datum2 = request('PuvodníDatum');
		$prichoziFormular1->mFormDatumy2Datumy();

		$SQLdotaz1 = tabulka_rezervacis::where("datum", $prichoziFormular1->datum1);
		$SQLdotaz2 = tabulka_rezervacis::where("datum", $prichoziFormular1->datum2);

		switch($prichoziFormular1->mod1){
		case 1://přidat
			if($SQLdotaz1->count() > 0){
				$odchoziFormular1 = $prichoziFormular1->mDataDoForm();
				$tasks1 = tabulka_rezervacis::orderBy('datum', 'asc')->get();
				return view('LHviews1', compact('tasks1', 'odchoziFormular1'))->withErrors(["mesage" => "Zadany datum a hodina josu obsazeny"]);
			} else{
				tabulka_rezervacis::insert($prichoziFormular1->mDataDoDB());
			}
			break;

		case 2://upravit
			if((!$prichoziFormular1->mJsouDatumyStejne() && $SQLdotaz1->count() > 0) || ($prichoziFormular1->mJsouDatumyStejne() &&  $SQLdotaz1->count() > 1)){
				$odchoziFormular1 = $prichoziFormular1->mDataDoForm();
				$tasks1 = tabulka_rezervacis::orderBy('datum', 'asc')->get();
				return view('LHviews1', compact('tasks1', 'odchoziFormular1'))->withErrors(["mesage" => "Zadany datum a hodina josu obsazeny"]);
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

		//$odchoziFormular1 = new cLHRezervace1Model();
		//$odchoziFormular1 = $odchoziFormular1->mDataDoForm();
		$odchoziFormular1 = $prichoziFormular1->mDataDoForm();
		$tasks1 = tabulka_rezervacis::orderBy('datum', 'asc')->get();
		return view('LHviews1', compact('tasks1', 'odchoziFormular1'));
		
	}
	
	
}
