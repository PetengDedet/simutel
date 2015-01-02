<?php
//Menampilkan semua pesan warning/error
	ini_set('display_errors',1);  error_reporting(E_ALL);

/**
* Membuat class baru dg nama : SimuTel
* SimuTel
*/
class SimuTel{
	
	private $js, //Jumlah Santri
			$ps, //Jumlah Pesawat Telepon
			$bw, //Buka wartel per hari
			$db, //Durasi bicara per santri
			$hi; //Hari ideal santri menelpon orangtuanya
	function __construct($jumsantri = NULL, $pesawat = NULL, $buka = NULL, $durasi = NULL, $ideal= NULL){
		$this 	-> 	js = $jumsantri;
		$this 	-> 	ps = $pesawat;
		$this 	-> 	bw = $buka * 60;
		$this	-> 	db = $durasi;
		$this 	->  hi = $ideal;
	}

//Setter
	public function setSantri($jums){
		$this -> js = $jums;
	}
	
	public function setPesawat($psw){
		$this -> ps = $psw;
	}
	
	public function setBuka($bk){
		$this -> bw = $bk * 60;
	}
	
	public function setDurasi($drs){
		$this -> db = $drs;
	}
	
	public function setIdeal($idl){
		$this -> hi = $idl;
	}

//Getter
	public function getSantri(){
		return $this -> js;
	}
	public function getPesawat(){
		return $this -> ps;
	}
	public function getBuka(){
		return $this -> bw;
	}
	public function getDurasi(){
		return $this -> db;
	}
	public function getIdeal(){
		return $this -> hi;
	}

//Menghitung jumlah santri yang terlayani wartel dalam satu hari
	public function satuHari(){
		$sh = ($this -> getBuka() / $this -> getDurasi()) * $this -> getPesawat();
		return $sh;
	}
//Menghitung putaran giliran
	public function putarGilir(){
		$pg = $this -> getSantri() / $this -> satuHari();
		return $pg;
	}
//Jumlah pesawat telepon ideal yang mestinya disediakan
	public function pesawatIdeal(){
		$pi = ($this -> getSantri() * $this -> getDurasi()) / ($this -> getIdeal() * $this -> getBuka());
		return $pi;
	}
//Jumlah santri ideal yang harusnya dilayani
	public function idealHari(){
		$ih = ($this -> getBuka() / $this -> getDurasi()) * $this -> pesawatIdeal();
		return $ih;
	}
}

?>