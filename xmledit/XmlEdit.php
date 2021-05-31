<?php

class Xml
{
	// nazwy plików XML
	private $plikKsiazki = 'ksiazki.xml';
	private $plikAutorzy = 'autorzy.xml';
	private $plikRodzaje = 'rodzaje.xml';
	
	// instancje klasy SimpleXML
	private $xmlKsiazki;
	private $xmlAutorzy;
	private $xmlRodzaje;
	
	// wczytane dane z plików XML w postaci tablicy
	private $tablicaAutorzy = [];
	private $tablicaAutorzy2 = [];
	private $tablicaKsiazki = [];
	private $tablicaRodzaje = [];
	private $tablicaRodzaje2 = [];
	
	public function __construct()
	{
		$this->xmlKsiazki = simplexml_load_file($this->plikKsiazki);
		$this->xmlAutorzy = simplexml_load_file($this->plikAutorzy);
		$this->xmlRodzaje = simplexml_load_file($this->plikRodzaje);
		$this->wczytajAutorow();
		$this->wczytajKsiazki();
		$this->wczytajAutorowInaczej();
		$this->wczytajRodzaje();
		$this->wczytajRodzajeInaczej();
	}
	
	/**
	 * Wczytuje plik XML i konwertuje go do tablicy.
	 */
	private function wczytajAutorow()
	{
		foreach($this->xmlAutorzy as $autor)
			$this->tablicaAutorzy[(int)$autor->id] = (string)$autor->imie . ' ' . (string)$autor->nazwisko;
	}

	private function wczytajAutorowInaczej()
	{
		foreach($this->xmlAutorzy as $autor){
			$this->tablicaAutorzy2[(int)$autor->id] = [
				'id' => (int)$autor->id,
				'imie' => (string)$autor->imie,
				'nazwisko' => (string)$autor->nazwisko,
			];
		}
	}

	private function wczytajRodzaje()
	{
		foreach($this->xmlRodzaje as $rodzaj)
			$this->tablicaRodzaje[(int)$rodzaj->id] = (string)$rodzaj->nazwa;
	}

	private function wczytajRodzajeInaczej()
	{
		foreach($this->xmlRodzaje as $rodzaj){
			$this->tablicaRodzaje2[(int)$rodzaj->id] = [
				'id' => (int)$rodzaj->id,
				'nazwa' => (string)$rodzaj->nazwa,
			];
		}
	}

	/**
	 * Wczytuje plik XML i konwertuje go do tablicy.
	 */
	private function wczytajKsiazki()
	{
		foreach($this->xmlKsiazki as $ksiazki) {
			$this->tablicaKsiazki[(int)$ksiazki->id] = [
				'id' => (int)$ksiazki->id,
				'id_autora' => (int)$ksiazki->id_autora,
				'tytul' => (string)$ksiazki->tytul,
				'strony' => (string)$ksiazki->strony,
				'id_rodzaju' => (int)$ksiazki->id_rodzaju,
			];
		}
	}
	
	/**
	 * Generuje kolejne ID książki.
	 * 
	 * @return integer
	 */
	private function generujIdKsiazki()
	{
		$max = -1;

		foreach($this->tablicaKsiazki as $k) {
			if($k) {
				if($k['id'] > $max)
					$max = (int)$k['id'];
			}
		}
	
		return $max + 1;
	}

	/**
	 * Generuje kolejne ID autora.
	 * 
	 * @return integer
	 */
	private function generujIdAutora()
	{
		$max = -1;

		foreach($this->tablicaAutorzy2 as $k) {
			if($k) {
				if($k['id'] > $max)
					$max = (int)$k['id'];
			}
		}
	
		return $max + 1;
	}

	/**
	 * Generuje kolejne ID autora.
	 * 
	 * @return integer
	 */
	private function generujIdRodzaju()
	{
		$max = -1;

		foreach($this->tablicaRodzaje2 as $k) {
			if($k) {
				if($k['id'] > $max)
					$max = (int)$k['id'];
			}
		}
	
		return $max + 1;
	}
	
	/**
	 * Konwertuje obiekt SimpleXMLElement do tablicy.
	 * 
	 * @param SimpleXMLElement $xmlElement
	 * @return array
	 */
	private function konwertujDoTablicy($xmlElement)
	{
		$temp = [];
		
		foreach($xmlElement as $pole => $wart)
			$temp[$pole] = (string)$wart;
		
		return $temp;
	}
	
	/**
	 * Zwraca tablicę z autorami.
	 * 
	 * @return array
	 */
	public function zwrocAutorzy()
	{
		return $this->tablicaAutorzy;
	}

	/**
	 * Zwraca tablicę z autorami inaczej.
	 * 
	 * @return array
	 */
	public function zwrocAutorzyInaczej(){
		return $this->tablicaAutorzy2;
	}

	/**
	 * Zwraca tablicę z autorami inaczej.
	 * 
	 * @return array
	 */
	public function zwrocRodzaje(){
		return $this->tablicaRodzaje;
	}

	/**
	 * Zwraca tablicę z autorami inaczej.
	 * 
	 * @return array
	 */
	public function zwrocRodzajeInaczej(){
		return $this->tablicaRodzaje2;
	}
	
	/**
	 * Zwraca tablicę z książkami.
	 * 
	 * @return array
	 */
	public function zwrocKsiazki()
	{
		return $this->tablicaKsiazki;
	}
	
	/**
	 * Dodaje książkę do XML.
	 * 
	 * @param array $dane
	 */
	public function dodajKsiazke($dane)
	{
		$ksiazka = $this->xmlKsiazki->addChild('ksiazka');
		$ksiazka->addChild('id', $this->generujIdKsiazki());
		$ksiazka->addChild('id_autora', $dane['id_autora']);
		$ksiazka->addChild('tytul', $dane['tytul']);
		$ksiazka->addChild('strony', $dane['strony']);
		$ksiazka->addChild('id_rodzaju', $dane['id_rodzaju']);
		
		$this->xmlKsiazki->asXML($this->plikKsiazki);
	}

	/**
	 * Dodaje książkę do XML.
	 * 
	 * @param array $dane
	 */
	public function dodajAutora($dane)
	{
		$autor = $this->xmlAutorzy->addChild('autor');
		$autor->addChild('id', $this->generujIdAutora());
		$autor->addChild('imie', $dane['imie']);
		$autor->addChild('nazwisko', $dane['nazwisko']);

		$this->xmlAutorzy->asXML($this->plikAutorzy);
	}

	/**
	 * Dodaje książkę do XML.
	 * 
	 * @param array $dane
	 */
	public function dodajRodzaj($dane)
	{
		$rodzaj = $this->xmlRodzaje->addChild('rodzaj');
		$rodzaj->addChild('id', $this->generujIdRodzaju());
		$rodzaj->addChild('nazwa', $dane['nazwa']);

		$this->xmlRodzaje->asXML($this->plikRodzaje);
	}
	
	/**
	 * Pobiera dane książki o podanym ID.
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function pobierzKsiazke($id)
	{
		$ksiazka = $this->xmlKsiazki->xpath("//ksiazka[id=$id]");
		
		return $this->konwertujDoTablicy($ksiazka[0]);
	}

	/**
	 * Pobiera dane autora o podanym ID.
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function pobierzAutora($id)
	{
		$autor = $this->xmlAutorzy->xpath("//autor[id=$id]");
		
		return $this->konwertujDoTablicy($autor[0]);
	}

	/**
	 * Pobiera dane autora o podanym ID.
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function pobierzRodzaj($id)
	{
		$rodzaj = $this->xmlRodzaje->xpath("//rodzaj[id=$id]");
		
		return $this->konwertujDoTablicy($rodzaj[0]);
	}
	
	/**
	 * Edytuje dane książki.
	 * 
	 * @param integer $id
	 * @param array $dane
	 */
	public function zapiszKsiazke($id, $dane)
	{
		$ksiazka = $this->xmlKsiazki->xpath("//ksiazka[id=$id]")[0];
		$ksiazka->id_autora = $dane['id_autora'];
		$ksiazka->tytul = $dane['tytul'];
		$ksiazka->strony = $dane['strony'];
		$ksiazka->id_rodzaju = $dane['id_rodzaju'];
		
		$this->xmlKsiazki->asXML($this->plikKsiazki);
	}

	/**
	 * Edytuje dane autora.
	 * 
	 * @param integer $id
	 * @param array $dane
	 */
	public function zapiszAutora($id, $dane)
	{
		$autor = $this->xmlAutorzy->xpath("//autor[id=$id]")[0];
		$autor->imie = $dane['imie'];
		$autor->nazwisko = $dane['nazwisko'];

		$this->xmlAutorzy->asXML($this->plikAutorzy);
	}

	/**
	 * Edytuje dane książki.
	 * 
	 * @param integer $id
	 * @param array $dane
	 */
	public function zapiszRodzaj($id, $dane)
	{
		$rodzaj = $this->xmlRodzaje->xpath("//rodzaj[id=$id]")[0];
		$rodzaj->nazwa = $dane['nazwa'];
		
		$this->xmlRodzaje->asXML($this->plikRodzaje);
	}
	
	/**
	 * Usuwa książkę o podanym ID.
	 * 
	 * @param integer $id
	 */
	public function usunKsiazke($id)
	{
		$ksiazka = $this->xmlKsiazki->xpath("//ksiazka[id=$id]")[0];
		unset($ksiazka[0]);
		
		$this->xmlKsiazki->asXML($this->plikKsiazki);
	}

	/**
	 * Usuwa autora o podanym ID.
	 * 
	 * @param integer $id
	 */
	public function usunAutora($id)
	{
		$autor = $this->xmlAutorzy->xpath("//autor[id=$id]")[0];
		unset($autor[0]);
		
		$this->xmlAutorzy->asXML($this->plikAutorzy);
	}

	/**
	 * Usuwa autora o podanym ID.
	 * 
	 * @param integer $id
	 */
	public function usunRodzaj($id)
	{
		$rodzaj = $this->xmlRodzaje->xpath("//rodzaj[id=$id]")[0];
		unset($rodzaj[0]);
		
		$this->xmlRodzaje->asXML($this->plikRodzaje);
	}
}