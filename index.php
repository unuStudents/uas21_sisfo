<!DOCTYPE html>
<html>
<head>
	<title>Nomer 4</title>
</head>
<body>

<?php

// --- koneksi ke database
$koneksi = mysqli_connect("localhost","root","password","namadatabase") or die(mysqli_error());

// --- Fngsi tambah data (Create)
function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		
		if(!empty($nim) && !empty($nama) && !empty($alamat)){
			$sql = "INSERT INTO tabel_panen (nim, nama, alamat) VALUES(".$nim.",'".$nama."','".$almat."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}

	?> 
		<form action="" method="POST">
			<fieldset>
				<legend><h2>Tambah data</h2></legend>
				<label>NIM<input type="text" name="nim" /></label> <br>
				<label>Nama<input type="text" name="nama" /></label><br>
				<label>Alamat<input type="text" name="alamat" /></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_simpan" value="Simpan"/>
					<input type="reset" name="reset" value="Besihkan"/>
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</fieldset>
		</form>
	<?php

}
// --- Tutup Fngsi tambah data

// ===================================================================

// --- Program Utama
if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="index.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>
</body>
</html>