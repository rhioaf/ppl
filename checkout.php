<?php
    /**
     *   Get data diri user dari form
     *   Insert ke data base data diri user
     *   Get barang  pilihan user dari session -> $_SESSION['cart]
     *   Insert ke tabel Jual dengan data id penjual serta kode, harga, dan jumlah barang di setiap data pada session
     *   Save data tiap jumlah pembelian setiap barang, lalu update stok pada tabel Barang
     *   Hitung harga ongkir sesuai alamat pengirim dan penerima
     *   Note = pembulatan kebawah minimal 0,3. Misal 1,3 => 1 dan 1,31 => 2
     */
    include 'connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_POST["submitform"])){
        $id;
        $namaUser = $_POST["nama"];
        $nomorHp = $_POST["nomor"];
        $alamat = $_POST["alamat"];
        $kodepos = $_POST["kodepos"];
        $totalHarga = $_POST["total"];
        $date = date("Y-m-d");
        $insertPenjualan = "INSERT INTO penjualan VALUES ('".$namaUser."', '".$nomorHp."', '".$alamat."', '".$kodepos."', '".$totalHarga."', '".$date."') ";
        $statuePenjualan = $conn->query($insertPenjualan);
        if($statuePenjualan){
            $getCurrentId = "SELECT id FROM penjualan WHERE nama=".$namaUser;
            $result = $conn->query($getCurrentId);
            while($fetch = $result->fetch_array()){
                $id = $fetch['id'];
            }
        }
        if(isset($_SESSION['cart'])){
            echo "test";
            $countLoop = 1;
            $currentCode;
            $initalCode;
            foreach($_SESSION['cart'] as $index => $item){
                if($countLoop == 1){
                    $initalCode = $item['kodebrg'];
                    $query = "INSERT INTO jual VALUES ('".$id."', '".$item['kodebrg']."', '".$item['harga']."', '".$item['jumlah']."')";
                    $statusJual = $conn->query($query);
                    if(!is_null($statusJual)){
                        $getStok = "SELECT stok FROM barang WHERE kodebrg=".$item['kodebrg'];
                        $resultStok = $conn->query($getStok);
                        $currentJumlah = $resultStok['stok'];
                        $newStok = $currentJumlah - $item['jumlah'];
                        $queryUpdateStok = "UPDATE barang SET stok='".$newStok."' WHERE kodebrg='".$item['kodebrg']."'";
                    }
                } else {
                    $currentCode = $item['kodebrg'];
                    if($currentCode != $initalCode){
                        $query = "INSERT INTO jual VALUES ('".$id."', '".$item['kodebrg']."', '".$item['harga']."', '".$item['jumlah']."')";
                        $statusJual = $conn->query($query);
                        if(!is_null($statusJual)){
                            $getStok = "SELECT stok FROM barang WHERE kodebrg=".$item['kodebrg'];
                            $resultStok = $conn->query($getStok);
                            $currentJumlah = $resultStok['stok'];
                            $newStok = $currentJumlah - $item['jumlah'];
                            $queryUpdateStok = "UPDATE barang SET stok='".$newStok."' WHERE kodebrg='".$item['kodebrg']."'";
                        }
                    }
                }
                $countLoop++;
            }
        }
        // header('location:template.php?content=tabel_barang.php');
    }
?>