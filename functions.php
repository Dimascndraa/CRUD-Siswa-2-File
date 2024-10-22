<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "crud_siswa");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi ambil semua siswa
function getAllSiswa()
{
    global $conn;
    return mysqli_query($conn, "SELECT * FROM siswa");
}

// Fungsi tambah siswa
function tambahSiswa($nama, $kelas, $alamat)
{
    global $conn;
    $query = "INSERT INTO siswa (nama, kelas, alamat) VALUES ('$nama', '$kelas', '$alamat')";
    return mysqli_query($conn, $query);
}

// Fungsi hapus siswa
function hapusSiswa($id)
{
    global $conn;
    return mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
}

// Fungsi edit siswa
function editSiswa($id, $nama, $kelas, $alamat)
{
    global $conn;
    $query = "UPDATE siswa SET nama='$nama', kelas='$kelas', alamat='$alamat' WHERE id=$id";
    return mysqli_query($conn, $query);
}

// Fungsi ambil 1 siswa berdasarkan ID
function getSiswaById($id)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM siswa WHERE id = $id"));
}
