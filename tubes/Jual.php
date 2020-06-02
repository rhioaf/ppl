<?php 
    class Jual {
        private $id;
        private $kode;
        private $harga;
        private $jml;

        function __construct($id, $kode, $harga, $jml){
            $this->id = $id;
            $this->kode = $kode;
            $this->harga = $harga;
            $this->jml = $jml;
        }

        function getId(){
            return $this->id;
        }
        function getKode(){
            return $this->kode;
        }
        function getHarga(){
            return $this->harga;
        }
        function getJml(){
            return $this->jml;
        }
    }
?>