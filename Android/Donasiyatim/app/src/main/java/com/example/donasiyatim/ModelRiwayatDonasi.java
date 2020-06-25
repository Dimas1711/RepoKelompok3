package com.example.donasiyatim;

public class ModelRiwayatDonasi {
    String id_donasi , id_user , id_kasus , jumlah_donasi , tanggal , status, judul;

    public ModelRiwayatDonasi() {
        this.id_donasi = id_donasi;
        this.id_user = id_user;
        this.id_kasus = id_kasus;
        this.jumlah_donasi = jumlah_donasi;
        this.tanggal = tanggal;
        this.status = status;
        this.judul = judul;
    }

    public String getJudul()
    {
        return judul;
    }

    public void setJudul(String judul)
    {
        this.judul = judul;
    }

    public String getId_donasi() {
        return id_donasi;
    }

    public void setId_donasi(String id_donasi) {
        this.id_donasi = id_donasi;
    }

    public String getId_user() {
        return id_user;
    }

    public void setId_user(String id_user) {
        this.id_user = id_user;
    }

    public String getId_kasus() {
        return id_kasus;
    }

    public void setId_kasus(String id_kasus) {
        this.id_kasus = id_kasus;
    }

    public String getJumlah_donasi() {
        return jumlah_donasi;
    }

    public void setJumlah_donasi(String jumlah_donasi) {
        this.jumlah_donasi = jumlah_donasi;
    }

    public String getTanggal() {
        return tanggal;
    }

    public void setTanggal(String tanggal) {
        this.tanggal = tanggal;
    }


    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
