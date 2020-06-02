<?php
    class Barang{
        private $kode;
        private $nama;
        private $harga;
        private $stok;
        private $berat;
        private $gambar;

        function __construct($kode, $nama, $harga, $stok, $berat, $gambar){
            $this->kode = $kode;
            $this->nama = $nama;
            $this->harga = $harga;
            $this->stok = $stok;
            $this->berat = $berat;
            $this->gambar = $gambar;
        }

        function getKode(){
            return $this->kode;
        }
        function getNama(){
            return $this->nama;
        }
        function getHarga(){
            return $this->harga;
        }
        function getStok(){
            return $this->stok;
        }
        function getBerat(){
            return $this->berat;
        }
        function getGambar(){
            return $this->gambar;
        }
    }
    
?>