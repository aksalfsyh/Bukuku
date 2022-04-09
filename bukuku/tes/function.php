<?php

function koneksi(){
	$conn = mysqli_connect('localhost','root','','pw') or die('Koneksi ke database GAGAL !');

	return $conn;
}

function query($query){
	$conn = koneksi();
	$result = mysqli_query($conn, $query) or die('Query Gagal' . mysqli_error($conn));

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	$conn = koneksi();
	$judul = mysqli_real_escape_string($conn, htmlspecialchars($data['judul']));
	$penulis = mysqli_real_escape_string($conn, htmlspecialchars($data['penulis']));
	$penerbit = mysqli_real_escape_string($conn, htmlspecialchars($data['penerbit']));
	$kategori = mysqli_real_escape_string($conn, htmlspecialchars($data['kategori']));
	$gambar = mysqli_real_escape_string($conn, htmlspecialchars($data['gambar']));

	$query = "INSERT INTO buku VALUES(
				null,
				'$judul',
				'$penulis',
				'$penerbit',
				'$kategori',
				'$gambar'
			)";

	mysqli_query($conn, $query) or die('Query Gagal' . mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function ubah($data){
	$conn = koneksi();

	$id = $data['id'];
	$judul = mysqli_real_escape_string($conn, htmlspecialchars($data['judul']));
	$penulis = mysqli_real_escape_string($conn, htmlspecialchars($data['penulis']));
	$penerbit = mysqli_real_escape_string($conn, htmlspecialchars($data['penerbit']));
	$kategori = mysqli_real_escape_string($conn, htmlspecialchars($data['kategori']));
	$gambar = mysqli_real_escape_string($conn, htmlspecialchars($data['gambar']));

	$query = "UPDATE buku SET
				judul = '$judul',
				penulis = '$penulis',
				penerbit = '$penerbit',
				kategori = '$kategori',
				gambar = '$gambar'
					WHERE id = $id
				";

	mysqli_query($conn, $query) or die('Query Gagal' . mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function hapus($id){
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die('Query Gagal' . mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$tipeFile = $_FILES['gambar']['type'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	$ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);

	if($error === 4){
		return 'img/conan.jpg';
	}

	$tipeGambarValid = ['image/jpg','image/jpeg','image/png'];
	if(!in_array($tipeFile, $tipeGambarValid)){
      echo "<script>
              alert('Tipe Gambar Tidak Sesuai');
              document.location.href = 'index.php';
            </script>";
      return false;
	}
}

?>