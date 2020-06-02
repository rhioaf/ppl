<table border="2" class="table-center add-bg">
                <tr>
                    <th class="tr-barang">Kode</th>
                    <th class="tr-barang">Nama</th>
                    <th class="tr-barang">Harga</th>
                    <th class="tr-barang">Gambar</th>
                    <th class="tr-barang">Tambah</th>
                </tr>
                <?php
                    $result;
                    if(isset($_GET['cari'])){
                        $valueCari = $_GET['cari'];
                        $data = "SELECT * FROM barang where namabrg like '%".$valueCari."%' ";
                        $result = $conn->query($data);
                    } else {
                        $data = "SELECT * FROM barang";
                        $result = $conn->query($data);
                    }
                    $formattedHarga;
                    while($results = $result->fetch_assoc()){
                        switch(strlen($results["harga"])){
                            case 6 : $formattedHarga = substr_replace($results["harga"], ".", 3, 0);
                                     break;
                            case 7 : $formattedHarga = substr_replace($results["harga"], ".", 1, 0);
                                     $formattedHarga = substr_replace($formattedHarga, ".", 5, 0);
                                     break;
                            case 8 : $formattedHarga = substr_replace($results["harga"], ".", 2, 0);
                                     $formattedHarga = substr_replace($formattedHarga, ".", 6, 0);
                                     break;
                            default : $formattedHarga = $results["harga"];
                        }
                        if($results["stok"] > 0) {
                ?>
                <tr>
                    <td class="td-padding"><?php echo $results["kodebrg"]; ?></td>
                    <td class="td-padding"><?php echo $results["namabrg"]; ?></td>
                    <td class="td-padding">Rp. <?php echo $formattedHarga ?></td>
                    <td class="td-padding"><img src=<?php echo '../barang/'.$results["gambar"] ?> class="gambar"></td>
                    <td class="td-padding"><a href=<?php echo '/webpro/tubes/template.php?content=shoppingcart.php&kode='.$results["kodebrg"]?> class="btn btn-primary" style="font-weight:bold">+</a></td>
                    <!-- Button trigger modal -->
                </tr>
                <?php }
                } ?>
            </table>
